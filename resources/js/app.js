import Vue from 'vue'
import router from './router.js'
import App from './App.vue'
import vuetify from './plugins/vuetify.js'
import './bootstrap.js'
import store from './store.js'
import axios from 'axios'

const app = new Vue({
    el: 'app',
    store,
    axios,
    router,
    vuetify,
    components: {
        App
    }
})

// Vue.component('campaign-component',{
//     props: ['campaign'],
//     template: `
//     <v-card :to="'/campaign/' + campaign.id">
         
//         <v-img :src="campaign.image" class="black--text" width="50%">
//             <v-card-title class="fill-height align-end" v-text="campaign.title">   
//             </v-card-title>
//         </v-img>

//     </v-card>
//     `
// })


// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */

// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// const app = new Vue({
//     el: '#app',
// });

// import axios from 'axios'

// Vue.prototype.$http = axios
