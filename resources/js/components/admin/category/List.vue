<template>
<div class="content-wrapper">  
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
         <router-link to="/admin/add-category" class="btn btn-primary">Thêm danh mục</router-link>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><router-link to="/admin/home">Home</router-link></li>
            <li class="breadcrumb-item active">Danh mục</li>
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
              <h3 class="card-title">Danh sách danh mục <span class="ml-1 badge bg-danger">{{total}}</span></h3> 

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" v-model="cate_keyword" @keyup="searchCate(cate_keyword)" name="cate_keyword" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="button" class="btn btn-default" ><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Danh mục cha</th>
                    <th>Tên danh mục</th>
                    <th>Slug</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in listcate">
                    <td>{{ page > 0 ? (page-1)*per_page+index+1 : index+1 }}</td>
                    <td>{{item.parent_name !== '' ? item.parent_name : '' }}</td>
                    <td>{{item.title}}</td>
                    <td>{{item.slug}}</td>
                    <td>
                      <router-link :to="{name:'edit-category', params:{catid: item.id}}" class="btn btn-primary">Sửa</router-link> 
                      <button class="btn btn-danger" @click="removeCate(item.id)" >Xóa</button>
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
                  <select class="form-control w-50 form-control-sm d-inline-block" v-model="display_row" @click="setPerPage(display_row)" >
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
      cate_keyword: '',
      display_row : 5
    }
  },
  computed : {
    ...mapState({
       listcate : state => state.category.list,
       total : state => state.category.total,
       per_page : state => state.category.per_page,
       page : state => state.category.page
    })
  },
  methods : {
    ...mapActions('category',[
        'removeCate',
        'searchCate',
        'setPage',
        'setPerPage'
      ])
  },
  created(){
    this.$store.dispatch('category/getAllCate')
    this.$store.dispatch('category/getAllCateWithPag')
  } 

}
</script>