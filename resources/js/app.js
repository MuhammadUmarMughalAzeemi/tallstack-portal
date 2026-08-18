import './bootstrap';
import Sortable from 'sortablejs';

// Register a global Alpine directive: x-sortable
// Usage: <ul x-sortable @sorted="handler($event.detail)">
document.addEventListener('alpine:init', () => {
    Alpine.directive('sortable', (el, { expression }, { evaluate, cleanup }) => {
        const sortable = Sortable.create(el, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            handle: '.drag-handle',
            onEnd() {
                const items = [...el.querySelectorAll('[data-id]')].map((item) => item.dataset.id);
                el.dispatchEvent(new CustomEvent('sorted', { detail: items, bubbles: true }));
            },
        });

        cleanup(() => sortable.destroy());
    });

    Alpine.data('preferencePicker', (colleges = [], ranked = []) => ({
        search: '',
        colleges,
        ranked: Array.isArray(ranked) ? [...ranked] : [],

        get available() {
            const query = this.search.trim().toLowerCase();

            return this.colleges.filter((college) => {
                if (this.ranked.includes(college.name)) {
                    return false;
                }

                return query === '' || college.name.toLowerCase().includes(query);
            });
        },

        get availableTotal() {
            return this.colleges.filter((college) => ! this.ranked.includes(college.name)).length;
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

        sync() {
            const wire = this.$wire;
            if (wire) {
                wire.set('selectMphilSubject', [...this.ranked], false);
            }
        },

        add(name) {
            if (! name || this.ranked.includes(name)) {
                return;
            }

            this.ranked.push(name);
            this.sync();
        },

        remove(index) {
            this.ranked.splice(index, 1);
            this.sync();
        },

        clear() {
            this.ranked = [];
            this.sync();
        },

        moveUp(index) {
            if (index < 1) {
                return;
            }

            const items = this.ranked;
            [items[index - 1], items[index]] = [items[index], items[index - 1]];
            this.sync();
        },

        moveDown(index) {
            if (index >= this.ranked.length - 1) {
                return;
            }

            const items = this.ranked;
            [items[index], items[index + 1]] = [items[index + 1], items[index]];
            this.sync();
        },

        applySort(order) {
            const next = (order || []).filter((name) => this.ranked.includes(name));
            if (next.length) {
                this.ranked = next;
                this.sync();
            }
        },
    }));
});
