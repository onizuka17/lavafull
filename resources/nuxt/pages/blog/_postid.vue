<template>
    <div id="app">
        <Header></Header>
        <div>dasdsad2 {{this.$route.params.postid}}</div> {{single_item}}
        <!-- breadcrumb start-->
        <section class="breadcrumb breadcrumb_bg align-items-center">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-6">
                        <div class="breadcrumb_tittle text-left">
                            <h2>{{single_item.title}}</h2>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="breadcrumb_content text-right">
                            <p>Home<span>/</span>blog details</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb start-->
        <!--================Blog Area =================-->
        <section class="blog_area single-post-area all_post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 posts-list">
                        <div class="single-post">
                            <div class="feature-img">
                                <img class="img-fluid" :src="!single_item.feature_img_fullpath ? 'https://via.placeholder.com/400x300.png?text=Thumbnail' : single_item.feature_img_fullpath" alt="">
                            </div>
                            <div class="blog_details">
                                <h2>{{single_item.title}}
                                </h2>
                                <ul class="blog-info-link mt-3 mb-4">
                                    <li v-if="single_item.post_taxonomy.length > 0"><a href="#"><i class="far fa-user"></i> {{single_item.post_taxonomy[0].title}}</a></li>
                                    
                                </ul>
                                <p class="excert" v-html="single_item.description"> </p>
                            </div>
                        </div>
                        <div class="navigation-top">
                            <div class="d-sm-flex justify-content-between text-center">
                                <div class="col-sm-4 text-center my-2 my-sm-0">
                                    <!-- <p class="comment-count"><span class="align-middle"><i class="far fa-comment"></i></span> 06 Comments</p> -->
                                </div>
                                <ul class="social-icons">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                </ul>
                            </div>
                            <div class="navigation-area">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                        <div class="thumb">
                                            <a href="#">
                                                <img class="img-fluid" src="img/post/preview.png" alt="">
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="#">
                                                <span class="text-white ti-arrow-left"></span>
                                            </a>
                                        </div>
                                        <div class="detials">
                                            <p>Prev Post</p>
                                            <a href="#">
                                                <h4>Space The Final Frontier</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                        <div class="detials">
                                            <p>Next Post</p>
                                            <a href="#">
                                                <h4>Telescopes 101</h4>
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="#">
                                                <span class="text-white ti-arrow-right"></span>
                                            </a>
                                        </div>
                                        <div class="thumb">
                                            <a href="#">
                                                <img class="img-fluid" src="img/post/next.png" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar_widget">
                            <div class="single_sidebar_wiget search_form_widget">
                                <form action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder='Search Keyword' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="btn_1">search</div>
                                    </div>
                                </form>
                            </div>
                            <div class="single_sidebar_wiget">
                                <div class="sidebar_tittle">
                                    <h3>Categories</h3>
                                </div>
                                <div class="single_catagory_item category">
                                    <ul class="list-unstyled">
                                        <li><a href="single-blog.html">Culture</a> <span>(15)</span> </li>
                                        <li><a href="single-blog.html">Creative Design</a> <span>(15)</span> </li>
                                        <li><a href="single-blog.html">Illustration</a> <span>(15)</span> </li>
                                        <li><a href="single-blog.html">Production</a> <span>(15)</span> </li>
                                        <li><a href="single-blog.html">Mangement</a> <span>(15)</span> </li>
                                        <li><a href="single-blog.html">Branding</a> <span>(15)</span> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single_sidebar_wiget">
                                <div class="sidebar_tittle">
                                    <h3>Popular Feeds</h3>
                                </div>
                                <div class="single_catagory_post post_2 ">
                                    <div class="category_post_img">
                                        <img src="img/sidebar/sidebar_1.png" alt="">
                                    </div>
                                    <div class="post_text_1 pr_30">
                                        <a href="single-blog.html">
                                            <h3>Subdue lesser beast winged
                                                bearing meat tree one</h3>
                                        </a>
                                        <p><span> By Michal</span> / March 30</p>
                                    </div>
                                </div>
                                <div class="single_catagory_post post_2 ">
                                    <div class="category_post_img">
                                        <img src="img/sidebar/sidebar_2.png" alt="">
                                    </div>
                                    <div class="post_text_1 pr_30">
                                        <a href="single-blog.html">
                                            <h3>Subdue lesser beast winged
                                                bearing meat tree one</h3>
                                        </a>
                                        <p><span> By Michal</span> / March 30</p>
                                    </div>
                                </div>
                                <div class="single_catagory_post post_2">
                                    <div class="category_post_img">
                                        <img src="img/sidebar/sidebar_3.png" alt="">
                                    </div>
                                    <div class="post_text_1 pr_30">
                                        <a href="single-blog.html">
                                            <h3>Subdue lesser beast winged
                                                bearing meat tree one</h3>
                                        </a>
                                        <p><span> By Michal</span> / March 30</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single_sidebar_wiget">
                                <div class="sidebar_tittle">
                                    <h3>Share this post</h3>
                                </div>
                                <div class="social_share_icon tags">
                                    <ul class="list-unstyled">
                                        <li><a href="#"><i class="ti-facebook"></i></a></li>
                                        <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                        <li><a href="#"><i class="ti-pinterest"></i></a></li>
                                        <li><a href="#"><i class="ti-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Area end =================-->
        <Footer></Footer>
    </div>
</template>
<script type="text/javascript">
import { mapState, mapActions } from 'vuex';
import axios from 'axios'
import SidebarRight from '~/components/Sidebar-Right';
import Header from '~/components/Header'
import Footer from '~/components/Footer'

export default {
    components: {
        SidebarRight,
        Header,
        Footer
    },
    head() {
      return{
        title: this.single_item.seo_title,
        meta: [
            { hid: 'description', name: 'description', content: this.single_item.meta_description },
            { hid: 'keyword', name: 'keyword', content: this.single_item.meta_keyword }
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
    }},
    data() {
        return {
            single_item: '',
            rootUrl: location.protocol + '//' + location.host + '/',
            post_keyword: '',
            display_row: 5
        }
    },
    asyncData ({ params }) {

       return axios.get('/api/get-post/'+params.postid)
        .then(function (res) { 
            console.log(res.data.post[0].id);  
            return { 
               single_item:   res.data.post[0]
            }
         
        })
     },
    computed: {
        ...mapState({
            allfeaturepost: state => state.blog.allfeaturepost,
        }),
    },
    methods: { },
    beforeCreate(){
      this.$store.dispatch('blog/getAllFeatPost')
    },
   
};

</script>
