import './bootstrap';

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.data('likes_count_popup', () => ({
    open: false,

    toggle() {

    }
}))

Alpine.start()