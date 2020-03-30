<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Bài viết</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
                            <li class="breadcrumb-item active">Chỉnh sửa bài viết</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form @submit.prevent="updatePost" enctype="multipart/form-data">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-9">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Chỉnh sửa bài viết</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input :onchange="makeSlug(form.title)" v-model="form.title" name="title" type="text" class="form-control" placeholder="Nhập tên danh mục" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input v-model="form.slug" name="slug" type="text" class="form-control input-small" placeholder="" :class="{ 'is-invalid': form.errors.has('slug') }">
                                        <has-error :form="form" field="slug"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả ngắn</label>
                                        <textarea class="textarea form-control" v-model="form.short_description" name="short_description" placeholder="Nhập nội dung"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <div id="editor1"></div>
                                        <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-default">
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
                                        <input v-model="form.seo_title" name="seo_title" type="text" class="form-control" placeholder="Nhập tiêu đề" :class="{ 'is-invalid': form.errors.has('seo_title') }">
                                        <has-error :form="form" field="seo_title"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea class="textarea form-control" :class="{'is-invalid':form.errors.has('meta_description')}" v-model="form.meta_description" name="meta_description" placeholder="Nhập nội dung"></textarea>
                                        <has-error :form="form" field="meta_description"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta keyword</label>
                                        <input v-model="form.meta_keyword" name="meta_keyword" type="text" class="form-control" placeholder="Nhập từ khóa" :class="{ 'is-invalid': form.errors.has('meta_keyword') }">
                                        <has-error :form="form" field="meta_keyword"></has-error>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        <!-- left column -->
                        <div class="col-md-3">
                            <!-- general form elements -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Danh mục</h3>
                                </div>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="form-group" style=" height: 300px; overflow-y: scroll; ">
                                        <ul style=" margin: 0; padding: 5px;font-size: 14px; ">
                                            <li v-for="item in list_has_child">
                                                <input type="checkbox" name="" :value=item.id v-model="form.cat_list_id"> {{ item.title }}
                                                <ul>
                                                    <showSubCategory  v-for="hasChild in item.hasChild" :node="hasChild" :checkedID="form.cat_list_id"  :setCatID="setCatID" v-bind:key="item.id"></showSubCategory>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Hình đại diện</h3>
                                </div>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="form-group mt-2">
                                        <div class="custom-file mb-2">
                                            <input type="file" name="new_feature_image" @change="getFeatImage" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        
                                        <img v-if="!previewImg && form.feature_image != null" :src="rootUrl+'storage/upload/'+form.feature_image" style="max-width: 100%">
                                        <img v-else="previewImg" :src="previewImg" style="max-width: 100%">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body" style="padding: 5px;">
                                    <div class="form-group mb-1">
                                        <input type="checkbox" name="active" v-model="form.active"> Ẩn/Hiện
                                    </div>
                                    <div class="form-group mb-1">
                                        <input type="checkbox" name="feature" v-model="form.feature"> Nổi bật
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary w-100 d-block">SAVE</button>
                                </div>
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import showSubCategory from "./showSubCategory";


export default {
    name: 'Edit',
    components: {
        showSubCategory
    },
    data() {
        return {
            rootUrl: location.protocol + '//' + location.host + '/',
            previewImg: '',
            form: new Form({
                title: '',
                slug: '',
                short_description: '',
                description: '',
                seo_title: '',
                meta_description: '',
                meta_keyword: '',
                cat_list_id: [],
                active: false,
                feature: false,
                feature_image: null,
                new_feature_image: null
            }),
            editor: ClassicEditor,
            editorData: '<p>Content of the editor.</p>',
            editorConfig: {
                toolbar: { items: ['ckfinder', 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'indent', 'outdent', '|', 'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo', ] },
                image: {
                    toolbar: [
                        'imageStyle:full',
                        'imageStyle:side',
                        '|',
                        'imageTextAlternative'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
                ckfinder: {
                    // Upload the images to the server using the CKFinder QuickUpload command.
                    uploadUrl: '/ckfinder/connector/?command=QuickUpload&type=Files',
                    openerMethod: 'popup',
                    options: {
                        resourceType: 'Images'
                    }
                },
                // This value must be kept in sync with the language defined in webpack.config.js.
                language: 'en'
            }
        }
    },
    computed: {
        ...mapState({
            list_has_child: state => state.category.list_has_child,
            single_item: state => state.post.single_item
        }),

    },
    methods: {

        getFeatImage(event){
          //console.log(event);
          var fileReader = new FileReader();
          let file = event.target.files[0];

          fileReader.onload = (evt) =>  {
            this.previewImg = evt.target.result;
          };
          fileReader.readAsDataURL(file)

          this.form.new_feature_image=file;

          //console.log(event.target.files[0]);
          //console.log(this.previewImg);
        },

        setCatID(event) {
            //console.log(event.target);
            //console.log(event.target.value);
            var ItemVal = event.target.value;
            var checked = event.target.checked;
            //console.log(ItemVal);

            if (checked) {
                this.form.cat_list_id.push(ItemVal);
            } else {
                let pos = null;
                for (var i = 0; i < this.form.cat_list_id.length; i++) {
                    if (ItemVal == this.form.cat_list_id[i]) {
                        this.form.cat_list_id.splice(i, 1);
                        return;

                    }
                }

            }
        },

        updatePost() {
          
            this.form.submit('post','/api/admin/update-post/' + this.$route.params.postid,{
                  // Transform form data to FormData
                  transformRequest: [function (data, headers) {
                    return objectToFormData(data)
                  }],

                  onUploadProgress: e => {
                    // Do whatever you want with the progress event
                    // console.log(e)
                  }
                })
                .then((res) => {
                    //this.$router.push('/admin/category'); 
                    console.log(res);   
                    Toast.fire({
                        icon: 'success',
                        title: 'Bài viết đã cập nhật'
                    })
                })
                .catch((errors) => {
                    console.log(errors)
                    Toast.fire({
                        icon: 'error',
                        title: errors
                    })
                })

        },
        makeSlug(title) {
            if (title) {
                let slug_txt = string_to_slug(title);
                this.form.slug = slug_txt;
            }

        }
    },
    created() {
        this.$store.dispatch('category/getAllCateHasChild')
        var form_fill = this.form;
        axios.get('/api/admin/get-post/' + this.$route.params.postid)
            .then(function(response) {
                //var cate={
                //title : response.data.category.title
                //};
                console.log(response);
                var data = {
                  title: response.data.post.title,
                  slug: response.data.post.slug,
                  short_description: response.data.post.short_description,
                  description: response.data.post.description,
                  seo_title: response.data.post.seo_title,
                  meta_description: response.data.post.meta_description,
                  meta_keyword: response.data.post.meta_keyword,
                  cat_list_id: response.data.post.cat_list_id,
                  active: response.data.post.active,
                  feature: response.data.post.feature,
                  feature_image: response.data.post.feature_image,
                  new_feature_image: '',
                }
                form_fill.fill(data);
            });
    },
}

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

</script>
