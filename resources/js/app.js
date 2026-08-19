import './bootstrap';
import Sortable from 'sortablejs';

// Register a global Alpine directive: x-sortable
// Usage: <ul x-sortable @sorted="handler($event.detail)">
document.addEventListener('alpine:init', () => {
    Alpine.directive('sortable', (el, { expression }, { evaluate, cleanup }) => {
        // Capture the order BEFORE SortableJS touches the DOM.
        let orderBeforeDrag = [];

        const sortable = Sortable.create(el, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            handle: '.drag-handle',
            onStart() {
                orderBeforeDrag = [...el.querySelectorAll('[data-id]')].map((n) => n.dataset.id);
            },
            onEnd(evt) {
                const { oldIndex, newIndex } = evt;
                if (oldIndex === newIndex) {
                    return;
                }

                // Compute the new order from the snapshot (not from current DOM).
                const reordered = [...orderBeforeDrag];
                const [moved] = reordered.splice(oldIndex, 1);
                reordered.splice(newIndex, 0, moved);

                // Force SortableJS to revert by re-sorting DOM to original order.
                // We do this by putting every data-id element back in the original sequence.
                const nodes = [...el.querySelectorAll('[data-id]')];
                const nodeMap = {};
                nodes.forEach((n) => { nodeMap[n.dataset.id] = n; });
                orderBeforeDrag.forEach((id) => {
                    if (nodeMap[id]) {
                        el.appendChild(nodeMap[id]);
                    }
                });

                el.dispatchEvent(new CustomEvent('sorted', {
                    detail: reordered,
                    bubbles: true,
                }));
            },
        });

        cleanup(() => sortable.destroy());
    });

    Alpine.data('programPreferences', (config = {}) => ({
        search: '',
        programs: config.programs || [],
        activeId: config.activeId || (config.programs?.[0]?.id ?? 0),
        ranked: config.ranked || {},

        key(id) {
            return String(id);
        },

        get active() {
            return this.programs.find((program) => Number(program.id) === Number(this.activeId)) || this.programs[0] || null;
        },

        list(id = null) {
            const key = this.key(id ?? this.activeId);
            const items = this.ranked[key] ?? this.ranked[id ?? this.activeId] ?? [];

            return Array.isArray(items) ? items : [];
        },

        count(id = null) {
            return this.list(id ?? this.activeId).length;
        },

        isSelected(name) {
            return this.list().includes(name);
        },

        get available() {
            const program = this.active;
            if (! program) {
                return [];
            }

            const selected = this.list(program.id);
            const query = this.search.trim().toLowerCase();

            return (program.colleges || []).filter((college) => {
                if (program.mode === 'ranked' && selected.includes(college.name)) {
                    return false;
                }

                return query === '' || college.name.toLowerCase().includes(query);
            });
        },

        get availableTotal() {
            const program = this.active;
            if (! program) {
                return 0;
            }

            if (program.mode === 'single') {
                return (program.colleges || []).length;
            }

            const selected = this.list(program.id);

            return (program.colleges || []).filter((college) => ! selected.includes(college.name)).length;
        },

        ordinal(n) {
            const value = n % 100;
            if (value >= 11 && value <= 13) {
                return `${n}th`;
            }

            switch (n % 10) {
                case 1: return `${n}st`;
                case 2: return `${n}nd`;
                case 3: return `${n}rd`;
                default: return `${n}th`;
            }
        },

        exportRanked() {
            const output = {};

            this.programs.forEach((program) => {
                output[program.id] = this.list(program.id);
            });

            return output;
        },

        sync() {
            this.$wire?.set('preferencesByProgram', this.exportRanked(), false);
        },

        setList(programId, items) {
            this.ranked = { ...this.ranked, [this.key(programId)]: items };
            this.sync();
        },

        switchTo(id) {
            this.activeId = Number(id);
            this.search = '';
        },

        add(name) {
            const program = this.active;
            if (! program || ! name) {
                return;
            }

            let items = [...this.list(program.id)];

            if (program.mode === 'single') {
                items = items[0] === name ? [] : [name];
            } else if (! items.includes(name)) {
                items.push(name);
            }

            this.setList(program.id, items);
        },

        remove(index) {
            const program = this.active;
            if (! program) {
                return;
            }

            const items = [...this.list(program.id)];
            items.splice(index, 1);
            this.setList(program.id, items);
        },

        clear() {
            const program = this.active;
            if (! program) {
                return;
            }

            this.setList(program.id, []);
        },

        moveUp(index) {
            if (index < 1) {
                return;
            }

            const items = [...this.list()];
            [items[index - 1], items[index]] = [items[index], items[index - 1]];
            this.setList(this.activeId, items);
        },

        moveDown(index) {
            const items = [...this.list()];
            if (index >= items.length - 1) {
                return;
            }

            [items[index], items[index + 1]] = [items[index + 1], items[index]];
            this.setList(this.activeId, items);
        },

        applySort(order) {
            const program = this.active;
            if (! program || program.mode !== 'ranked') {
                return;
            }

            if (Array.isArray(order) && order.length) {
                this.setList(program.id, order);
            }
        },
    }));
});
