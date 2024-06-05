import './bootstrap';
import '../css/app.css';

import { createApp, h, DefineComponent, reactive } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import LoadingScreen from "@/Components/LoadingScreen.vue";
import { Inertia } from '@inertiajs/inertia';
import { InertiaProgress } from "@inertiajs/progress";
import createServer from '@inertiajs/vue3/server'
import { renderToString } from '@vue/server-renderer'
import { createSSRApp, h } from 'vue'

const appName = import.meta.env.VITE_APP_NAME || 'Göbel Clicker';

const globalState = reactive({
    isLoading: false
});
createServer(page =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title} - ${appName}`,
        resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
        setup({ el, App, props, plugin }) {
            createSSRApp({
                render: () => h(App, props)
            })
                .use(plugin)
                .use(ZiggyVue)
                .component('LoadingScreen', LoadingScreen)
                .provide('globalState', globalState)
                .mount(el);
        },
        progress: {
            color: '#4B5563',
        },
    }),
)

Inertia.on('start', () => {
    globalState.isLoading = true;
});

Inertia.on('finish', (event) => {
    globalState.isLoading = false;
});

InertiaProgress.init({
    delay: 750,
    color: '#4B5563',
    includeCSS: true,
    showSpinner: false,
});



