import AdminHome from './components/admin/AdminHome.vue';

import CategoryList from './components/admin/category/List.vue';
import CategoryAdd from './components/admin/category/Add.vue';
import CategoryEdit from './components/admin/category/Edit.vue';

import PostList from './components/admin/post/List.vue';
import PostAdd from './components/admin/post/Add.vue';
import PostEdit from './components/admin/category/Edit.vue';

export const routes = [
  { path: '/admin/home', component: AdminHome },
  { path: '/admin/category', component: CategoryList },
  { path: '/admin/add-category', component: CategoryAdd },
  { path: '/admin/edit-category/:catid',name: 'edit-category', component: CategoryEdit },
  { path: '/admin/posts', component: PostList },
  { path: '/admin/add-post', component: PostAdd },
  { path: '/admin/edit-post/:postid',name: 'post-category', component: PostEdit },
]