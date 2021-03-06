/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import VueRouter from "vue-router";
import Dashboard from "./components/admin/Dashboard.vue";
import Profile from "./components/admin/Profile.vue";
import Product from "./components/admin/Product.vue";
import Users from "./components/admin/Users.vue";
import ProductType from "./components/admin/ProductType.vue";
import ProductUom from "./components/admin/ProductUom.vue";
import Developer from "./components/admin/Developer.vue";
import TrangChu from "./components/TrangChu.vue";
import PassportClients from "./components/passport/Clients.vue";
import AuthorizedClients from "./components/passport/AuthorizedClients.vue";
import PersonalAccessTokens from "./components/passport/PersonalAccessTokens.vue";

import { Form, HasError, AlertError } from "vform";
import Paginate from "vuejs-paginate";
import Swal from "sweetalert2";
import moment from "moment";

import VueProgressBar from "vue-progressbar";

const options = {
    color: "#bffaf3",
    failedColor: "#874b4b",
    thickness: "5px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300
    },
    autoRevert: true,
    location: "top",
    inverse: false
};

Vue.use(VueProgressBar, options);

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

Vue.filter("upFirst", function(value) {
    if (!value) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});
Vue.filter("myDate", function(value) {
    return moment(value).format("L");
});

Vue.filter("myNumber", function(value) {
    if (!value) return "";
    var a = "";
    var b = "";
    value = value.toString();
    var l = value.length;
    while (l > 3) {
        l = l - 3;
        a = value.slice(-3);
        b == "" ? (b = "," + a) : (b = "," + a + b);
        value = value.slice(0, l);
    }
    return value + b + " đ";
});

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component("paginate", Paginate);
Vue.component("passport-clients", PassportClients);
Vue.component("passport-authorized-clients", AuthorizedClients);
Vue.component("passport-personal-access-tokens", PersonalAccessTokens);

window.Form = Form;
window.Swal = Swal;
window.Toast = Toast;

Vue.use(VueRouter);

let routes = [
    { path: "/admin-dashboard", component: Dashboard },
    { path: "/admin-profile", component: Profile },
    { path: "/admin-users", component: Users },
    { path: "/admin-developer", component: Developer },
    { path: "/admin-product", component: Product },
    { path: "/admin-productUom", component: ProductUom },
    { path: "/admin-productType", component: ProductType },
    { path: "/trangchu", component: TrangChu }
];

const router = new VueRouter({
    mode: "history",
    routes, // short for `routes: routes`
    components: {}
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

// Vue.component(
//     "example-component",
//     require("./components/ExampleComponent.vue").default
// );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router
});