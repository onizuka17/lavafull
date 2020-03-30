import AdminHome from './components/admin/AdminHome.vue';

import CategoryList from './components/admin/category/List.vue';
import CategoryAdd from './components/admin/category/Add.vue';
import CategoryEdit from './components/admin/category/Edit.vue';

import PostList from './components/admin/post/List.vue';
import PostAdd from './components/admin/post/Add.vue';
import PostEdit from './components/admin/post/Edit.vue';

/*Frontend*/
import PublicHome from './components/public/PublicHome.vue';
import Single from './components/public/Blog/Single.vue';



export const routes = [
  { path: '/admin/home', component: AdminHome },
  { path: '/admin/category', component: CategoryList },
  { path: '/admin/add-category', component: CategoryAdd },
  { path: '/admin/edit-category/:catid',name: 'edit-category', component: CategoryEdit },
  { path: '/admin/posts', component: PostList },
  { path: '/admin/add-post', component: PostAdd },
  { path: '/admin/edit-post/:postid',name: 'edit-post', component: PostEdit },
  /*Route Frontend*/
  //{ path: '/', component: PublicHome },
  { path: '/', component: () => import('./components/public/PublicHome.vue') },
  { path: '/blog/:post_slug',name: 'post', component: Single },
]