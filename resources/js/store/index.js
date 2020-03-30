import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

import category from './modules/category';
import post from './modules/post';
import blog from './modules/blog';


const store = new Vuex.Store({
  modules: {
    category,
 	post,
 	blog
  }
})

export default store;