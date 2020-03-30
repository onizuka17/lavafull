<template>
<div class="content-wrapper">  
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
         <router-link to="/admin/add-post" class="btn btn-primary">Thêm bài viết</router-link>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><router-link to="/admin/home">Home</router-link></li>
            <li class="breadcrumb-item active">Bài viết</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách bài viết <span class="ml-1 badge bg-danger">{{total}}</span></h3> 

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" v-model="post_keyword" @keyup="searchPost(post_keyword)" name="cate_keyword" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="button" class="btn btn-default" ><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-striped text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Hình</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in listpost">
                    <td>{{ page > 0 ? (page-1)*per_page+index+1 : index+1 }}</td>
                    <td><img :src="item.feature_img_fullpath !== '' ? item.feature_img_fullpath : ''" style="max-height: 50px"></td>
                    <td>
                      {{item.title}}
                      <small class="text-success m-1 d-block"><i class="fa fa-globe"></i> {{rootUrl}}{{item.slug}}</small>
                      <small class="text m-1 d-block" >{{item.created_at}}</small>
                    </td>
                    <td>
                      <ul class="m-0 p-0">
                        <li v-if="item.post_taxonomy.length > 0" v-for="cat in item.post_taxonomy">
                           <span class="badge bg-warning small"  >{{cat.title}}</span>
                        </li>
                      </ul>
                     
                    </td>
                    <td>
                        <span class="badge bg-success small" v-if="item.active > 0"  >Hiển thị</span>
                        <span class="badge bg-danger small" v-if="item.feature > 0"  >Nổi bật</span>
                    </td>
                    <td>
                      <router-link :to="{name:'edit-post', params:{postid: item.id}}" class="btn btn-primary">Sửa</router-link> 
                      <button class="btn btn-danger" @click="removePost(item.id)" >Xóa</button>
                    </td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-1 float-right" v-if="page > 0" >
                  <li class="page-item" v-for="(item,index) in Math.ceil(total/per_page)" v-bind:class="{ active: item === page ? true : false }"><a class="page-link" @click.prevent="setPage(item)">{{item}}</a></li> 
                </ul>
                <div class="col-2 m-1 float-right">
                  <label class="d-inline-block">Hiển thị:</label>
                  <select class="form-control w-50 form-control-sm d-inline-block" v-model="display_row" @change="setPerPage(display_row)" >
                      <option>5</option>
                      <option>10</option>
                      <option>50</option>
                      <option>100</option>
                  </select>
                </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>    
</template>


<script type="text/javascript">
import { mapState, mapActions } from 'vuex'
export default {
  name : 'List',
  data() {
    return {
      rootUrl: location.protocol+'//'+location.host+'/',
      post_keyword: '',
      display_row : 5
    }
  },
  computed : {
    ...mapState({
       listpost : state => state.post.list,
       total : state => state.post.total,
       per_page : state => state.post.per_page,
       page : state => state.post.page
    })
  },
  methods : {
    ...mapActions('post',[
        'removePost',
        'searchPost',
        'setPage',
        'setPerPage'
      ])
  },
  created(){
    //this.$store.dispatch('post/getAllPost')
    this.$store.dispatch('post/getAllPostWithPag')
  } 

}
</script>