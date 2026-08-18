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
            onEnd(evt) {
                // Dispatch a custom event with the new sorted order
                const items = [...el.querySelectorAll('[data-id]')].map(el => el.dataset.id);
                el.dispatchEvent(new CustomEvent('sorted', { detail: items, bubbles: true }));
            },
        });

        cleanup(() => sortable.destroy());
    });
});
