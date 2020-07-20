
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

// Registro de Componentes
import VueNavbar from './components/vueNavbar';
import VueButton from './components/vueButton';
import VueTextInput from './components/vueTextInput';
import VuePasswordInput from './components/vuePasswordInput';
import VueNumberInput from './components/vueNumberInput';
import VueGoogleMap from './components/vueGoogleMap';
import VueGoogleMapSearch from './components/vueGoogleMapSearch';

Vue.component('vue-navbar', VueNavbar);
Vue.component('vue-button', VueButton);
Vue.component('vue-text-input', VueTextInput);
Vue.component('vue-password-input', VuePasswordInput);  
Vue.component('vue-number-input', VueNumberInput);
Vue.component('vue-google-map', VueGoogleMap);
Vue.component('vue-google-map-search', VueGoogleMapSearch);

// Vistas
import home from './views/home';
import login from './views/login';
import profile from './views/profile';
// Event Bus
import eventBus from './eventBus';
Vue.use(eventBus);
// Router
Vue.use(VueRouter);
const router = new VueRouter({
    // mode: "history", Para remover el hashtag de la URL
    mode: 'hash',
    routes: [
        {  
            path: '/',
            component: home,
            name: 'Home'
        },
        {
            path: '/login',
            component: login,
            name: 'Login',
            beforeEnter: (to, from, next) => {
                if (sessionStorage.getItem('access_token')){
                    next('/');
                }
                next();
            }
        },
        {
            path: '/profile',
            component: profile,
            name: 'Perfil',
            beforeEnter: (to, from, next) => {
                let username = sessionStorage.getItem('username')
                let form = new FormData;
                form.append('username', username);
                fetch(process.env.MIX_APP_URL + '/api/authCheck',{
                    method: 'POST',
                    body: form,
                    headers: {
                       'Authorization': 'Bearer ' + sessionStorage.getItem('access_token') 
                    }
                })
                .then(res => {
                    return res.json();
                })
                .then(data => {
                    if (data.email === username || data.username === username) {
                        next();
                    } else { 
                        next({name: 'Home'})
                    };
                })
                .catch(e => {
                    return e;
                })
                next();
            }
        }
    ],
    
})

// Route Guard
//
// A expensas de trafico de datos, es más seguro checkear en cada cambio de ruta
// si el usuario con el username dado por el login está efectivamente autenticado.
// Devuelve true o false.

router.beforeEach((to, from, next)  => {
    eventBus.$emit('isLogged'); // $emit para la navbar
    next();
})

const app = new Vue({
    el: '#app',
    router: router,
});
