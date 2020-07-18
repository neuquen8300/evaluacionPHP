
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
// Registro de Componentes
import VueNavbar from './components/vueNavbar';
import VueButton from './components/vueButton';
import VueTextInput from './components/vueTextInput';
import VuePasswordInput from './components/vuePasswordInput';

Vue.component('vue-navbar', VueNavbar);
Vue.component('vue-button', VueButton);
Vue.component('vue-text-input', VueTextInput);
Vue.component('vue-password-input', VuePasswordInput);  
// Vistas
import home from './views/home';
import login from './views/login';
import profile from './views/profile';

// Router
Vue.use(VueRouter);
const router = new VueRouter({
    // mode: "history", Para remover el hashtag de la URL
    mode: 'history',
    routes: [
        {
            path: '/',
            component: home,
            name: 'Home'
        },
        {
            path: '/login',
            component: login,
            name: 'Login'
        },
        {
            path: '/profile',
            component: profile,
            name: 'Perfil'
        }
    ]
})

// Componentes
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);






const app = new Vue({
    el: '#app',
    router: router,
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
