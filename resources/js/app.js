
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

// Registro de Componentes
import VueNavbar from './components/vueNavbar';
import VueButton from './components/vueButton';
import VueTextInput from './components/vueTextInput';
import VuePasswordInput from './components/vuePasswordInput';
import VueNumberInput from './components/vueNumberInput';

Vue.component('vue-navbar', VueNavbar);
Vue.component('vue-button', VueButton);
Vue.component('vue-text-input', VueTextInput);
Vue.component('vue-password-input', VuePasswordInput);  
Vue.component('vue-number-input', VueNumberInput);

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

const app = new Vue({
    el: '#app',
    router: router,
});
