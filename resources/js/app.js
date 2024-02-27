import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import '../css/app.css';

createInertiaApp({
  resolve: name => {
    const page = import(`./pages/${name}.vue`)
      .then(module => module.default)
      .catch(() => {
        return import(`./components/${name}.vue`).then(module => module.default);
      });

    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el);
  },
});