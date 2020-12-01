require('./bootstrap');

window.Vue = require('vue'); //Vue.jsの読み込み

import VueRouter from 'vue-router'; // Vue Routerの読み込み


Vue.use(VueRouter); // Vue.jsで、Vue Routerを使うように設定

//vue-routerによるルーティング設定
const router = new VueRouter({
    mode: 'history',
    routes: [
      { path: '/', component: require('./components/Top.vue').default, name: 'top' }, // ルートでアクセスしたら、List.vueを表示
      { path: '/:id', component: require('./components/Time.vue').default, name: 'time' }, // ルートでアクセスしたら、List.vueを表示
      { path: '/admin/list', component: require('./components/admin//list.vue').default, name: 'list' }, // ルートでアクセスしたら、List.vueを表示
      { path: '/admin/create', component: require('./components/admin/Form.vue').default, name: 'create' }, // createにアクセスしたらForm.vueを表示
      { path: '/admin/detail/:id', component: require('./components/admin/Detail.vue').default, name: 'detail' }, // id番号でアクセスしたらDetail.vueを表示
    ]
});

// コンポーネント
Vue.component('navbar', require('./components/admin/Navbar.vue').default);


// Vue.jsの実行
const app = new Vue({
    router
}).$mount('#app');