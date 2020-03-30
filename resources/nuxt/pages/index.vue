<template>
    <div id="app">
    <Header></Header>	
    <!-- banner post start-->
    <section class="banner_post">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="banner_post_1 banner_post_bg_1" v-for="feat_item in allfeaturepost" :style="{'background': 'url('+feat_item.feature_img_fullpath+')' }">
                    <div class="banner_post_iner text-center">
                        <a href="category.html" v-if="feat_item.post_taxonomy.length > 0"><h5>{{feat_item.post_taxonomy[0].title}}</h5></a> 
                        <a href="single-blog.html"><h2> {{feat_item.title}} </h2></a> 
                        <p>Posted on {{feat_item.created_at}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner post end-->

    <!-- feature_post start-->
    <section class="all_post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12" v-for="(item,index) in listpost">
                            <div class="single_post post_1 feature_post">
                                <div class="single_post_img">
                                    <img :src="!item.feature_img_fullpath ? 'https://via.placeholder.com/400x300.png?text=Thumbnail' : item.feature_img_fullpath" alt="">
                                </div>
                                <div class="single_post_text text-center">
                                    <a href="category.html" v-if="item.post_taxonomy.length > 0"><h5>{{item.post_taxonomy[0].title}}</h5></a> 
                                    <nuxt-link :to="{name:'postid' , params:{postid: item.slug} }"><h2> {{item.title}} </h2></nuxt-link>
                                    <p>Posted on {{item.created_at}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page_pageniation">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item" v-if="page > 1">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true"  @click.prevent="setPage(1)">Previous</a>
                                </li>
                                <li class="page-item" v-for="(item,index) in Math.ceil(total/per_page)" v-bind:class="{ active: item === page ? true : false }"><a class="page-link" @click.prevent="setPage(item)">{{item}}</a></li>
                                <li class="page-item" v-if="page < Math.ceil(total/per_page)">
                                  <a class="page-link" @click.prevent="setPage(page+1)">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature_post end-->

	<Footer></Footer>
  </div>
</template>
<script>

import { mapState, mapActions } from 'vuex';
import SidebarRight from '~/components/Sidebar-Right';
import Header from '~/components/Header'
import Footer from '~/components/Footer'

export default {
	components: {
	    SidebarRight,
	    Header,
	    Footer
	},
    head: {
	    title: 'Home page 🚀',
	    meta: [
	      { hid: 'description', name: 'description', content: 'Home page description' }
	    ],
	    noscript: [
	      { innerHTML: 'Body No Scripts', body: true }
	    ],
	    link: [
	      { rel: 'icon', type: 'image/x-icon', href: 'img/favicon.png' },
	      { rel: 'stylesheet', type: 'text/css', href: 'css/bootstrap.min.css' },
	      { rel: 'stylesheet', type: 'text/css', href: 'css/animate.css' },
	      { rel: 'stylesheet', type: 'text/css', href: 'css/owl.carousel.min.css' },
	      { rel: 'stylesheet', type: 'text/css', href: 'css/themify-icons.css' },
	      { rel: 'stylesheet', type: 'text/css', href: 'css/search.css' },
	      { rel: 'stylesheet', type: 'text/css', href: 'css/style.css' }
	    ],
	    script: [
	      { src: 'js/jquery-1.12.1.min.js', async: false, defer: false },
	      { src: 'js/popper.min.js', async: false, defer: false },
	      { src: 'js/bootstrap.min.js', async: false, defer: false },
	      { src: 'js/custom.js', async: false, defer: false }
	    ],
	  },
	   data() {
	    return {
	      rootUrl: location.protocol+'//'+location.host+'/',
	      post_keyword: '',
	      display_row : 5
	    }
	  },
	  computed : {
	    ...mapState({
	       listpost : state => state.blog.list,
	       allfeaturepost : state => state.blog.allfeaturepost,
	       total : state => state.blog.total,
	       per_page : state => state.blog.per_page,
	       page : state => state.blog.page
	    })
	  },
	  methods : {
	    ...mapActions('blog',[
	        'setPage',
	      ])
	  },
	  
	  mounted(){
	    this.$store.dispatch('blog/setPerPage',6);
	    this.$store.dispatch('blog/getAllPostWithPag');
	    this.$store.dispatch('blog/getAllFeatPost')
	  } 
	};

</script>
