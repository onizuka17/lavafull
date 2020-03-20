<template>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh mục</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
              <li class="breadcrumb-item active">Thêm danh mục</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form  @submit.prevent="addCate">
        <div class="row">
          
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm danh mục</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
                <div class="card-body">

                  <div class="form-group">
                    <label>Tên</label>
                    <input :onchange="makeSlug(form.cat_name)" v-model="form.cat_name" name="cat_name" type="text" class="form-control"  placeholder="Nhập tên danh mục" :class="{ 'is-invalid': form.errors.has('cat_name') }">
                    <has-error :form="form" field="cat_name"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Slug</label>
                    <input  v-model="form.slug" name="slug" type="text" class="form-control"  placeholder="" :class="{ 'is-invalid': form.errors.has('slug') }">
                    <has-error :form="form" field="slug"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Nội dung</label>
                    <textarea  class="textarea form-control" :class="{'is-invalid':form.errors.has('desc')}" v-model="form.desc" name="desc" placeholder="Nhập nội dung"></textarea>
                    <has-error :form="form" field="desc"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Danh mục cha</label>                
                    <select class="form-control" name="parent_id" v-model="form.parent_id" :class="{ 'is-invalid': form.errors.has('parent_id') }">
                       <option value="0" selected="selected">Chọn</option>
                       <option v-for="item in listcate" :value="item.id" >{{item.title}}</option>
                    </select>
                    <has-error :form="form" field="parent_id"></has-error>
                  </div>  

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Seo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  
                  <div class="callout callout-info">
                    <h6 class="text-primary m-0">{{form.seo_title === '' ? 'Tiêu đề' : form.seo_title}}</h6>
                    <small class="text-success m-1"><i class="fa fa-globe"></i> {{rootUrl}}{{form.slug}}</small>
                    <p><i class="fa fa-time"></i>{{form.meta_description === '' ? 'Nội dung' : form.meta_description}}</p>
                  </div>  

                  <div class="form-group">
                    <label>Seo title</label>
                    <input v-model="form.seo_title" name="seo_title" type="text" class="form-control"  placeholder="Nhập tiêu đề" :class="{ 'is-invalid': form.errors.has('seo_title') }">
                    <has-error :form="form" field="seo_title"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Meta description</label>
                    <textarea  class="textarea form-control" :class="{'is-invalid':form.errors.has('meta_description')}" v-model="form.meta_description" name="meta_description" placeholder="Nhập nội dung"></textarea>
                    <has-error :form="form" field="meta_description"></has-error>
                  </div>
                  
                  <div class="form-group">
                    <label>Meta keyword</label>
                    <input v-model="form.meta_keyword" name="meta_keyword" type="text" class="form-control"  placeholder="Nhập từ khóa" :class="{ 'is-invalid': form.errors.has('meta_keyword') }">
                    <has-error :form="form" field="meta_keyword"></has-error>
                  </div>
                 

                </div>
                <!-- /.card-body -->

                
              
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
         
        </div>
         </form>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>
<script type="text/javascript">
  import { mapState } from 'vuex'

  function string_to_slug(str) {
    str = str.replace(/^\s+|\s+$/g, ""); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "åàáãäâèếéëêìíïîòóöôùúüûñç·/_,:;";
    var to = "aaaaaaeeeeiiiioooouuuunc------";

    for (var i = 0, l = from.length; i < l; i++) {
      str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
    }

    str = str
      .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
      .replace(/\s+/g, "-") // collapse whitespace and replace by -
      .replace(/-+/g, "-") // collapse dashes
      .replace(/^-+/, "") // trim - from start of text
      .replace(/-+$/, ""); // trim - from end of text

    return str;
  }

	export default {
		name: 'Add',
    created(){
      this.$store.dispatch('category/getAllCate')
    },
		data () {
			return {
        rootUrl: location.protocol+'//'+location.host+'/',
				form: new Form({
			        cat_name: '',
              slug: '',
              desc:'',
              parent_id: 0,
              seo_title: '',
              meta_description: '',
              meta_keyword: ''

			    })
			}
		},
    computed : {
      ...mapState({
         listcate : state => state.category.all,
      })
    },
		methods : {
			addCate(){
				this.form.post('/api/admin/add-category')
				 	.then((res) => { 
				 		this.$router.push('/admin/category'); 
            console.log(res);
				 		Toast.fire({
						  icon: 'success',
						  title: 'Danh mục mới đã thêm'
						})
				 	})
				 	.catch((errors) => { 
            //console.log(errors)
            Toast.fire({
              icon: 'error',
              title: errors
            })
          })
					 
			},
      makeSlug(title){
        if (title) {
          let slug_txt = string_to_slug(title); 
          this.form.slug = slug_txt; 
        }
         
      }
		}
	}
</script>