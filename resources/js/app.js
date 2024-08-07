import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { InertiaProgress } from '@inertiajs/progress'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./components/**/*.vue', { eager: true })
        return pages[`./components/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})

InertiaProgress.init()
