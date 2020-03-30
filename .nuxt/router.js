import Vue from 'vue'
import Router from 'vue-router'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _83cfb1bc = () => interopDefault(import('..\\resources\\nuxt\\pages\\blog\\category.vue' /* webpackChunkName: "pages_blog_category" */))
const _4f5c4866 = () => interopDefault(import('..\\resources\\nuxt\\pages\\blog\\_postid.vue' /* webpackChunkName: "pages_blog__postid" */))
const _48053780 = () => interopDefault(import('..\\resources\\nuxt\\pages\\index.vue' /* webpackChunkName: "pages_index" */))

// TODO: remove in Nuxt 3
const emptyFn = () => {}
const originalPush = Router.prototype.push
Router.prototype.push = function push (location, onComplete = emptyFn, onAbort) {
  return originalPush.call(this, location, onComplete, onAbort)
}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: decodeURI('/'),
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/blog/category",
    component: _83cfb1bc,
    name: "blog-category"
  }, {
    path: "/blog/:postid?",
    component: _4f5c4866,
    name: "blog-postid"
  }, {
    path: "/",
    component: _48053780,
    name: "index"
  }, {
    path: "/__laravel_nuxt__",
    component: _48053780,
    name: "__laravel_nuxt__"
  }],

  fallback: false
}

export function createRouter () {
  return new Router(routerOptions)
}
