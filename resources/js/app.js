require('./bootstrap');

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import moment from "moment";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({el, app, props, plugin}) {
        const _app = createApp({render: () => h(app, props)})
            .use(plugin)
            .mixin({
                methods: {
                    route,
                    goto(link) {
                        window.location.href = link
                    },
                    moment: function (date) {
                        return moment(String(date)).format('DD/MM/YYYY')
                    }
                }
            });
        _app.use(VueSweetalert2);
        _app.mount(el);

        return _app;
    },
});

InertiaProgress.init({color: '#4B5563'});
