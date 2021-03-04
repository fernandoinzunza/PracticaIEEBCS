/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { template } = require('lodash');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('form-component', require('./components/AddStudentFormComponent.vue').default);
Vue.component('student-card', require('./components/StudentCard.vue').default);
Vue.component('student-list', require('./components/StudentListComponent.vue').default);
 Vue.component('form-computer',require('./components/NewComputerFormComponent.vue').default);
  Vue.component('computer-card',require('./components/ComputerCard.vue').default);
  Vue.component('computer-list',require('./components/ComputerListComponent.vue').default);
  Vue.component('form-aula',require('./components/AddAulaFormComponent.vue').default);
  Vue.component('aula-card',require('./components/AulaCard.vue').default);
  Vue.component('aula-list',require('./components/AulaListComponent.vue').default);
  
  // start app

//Vue.component('add-student-form', require('./components/AddStudentFormComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var urlUsers = "/alumnos/getAlumnos";
  const app =  new Vue({
        el:"#main"
    })
