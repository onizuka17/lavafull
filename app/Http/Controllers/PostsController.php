<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Posts;
use App\PostTaxonomyRelation;

class PostsController extends Controller
{
    
    public function all_posts()
    {
    	$posts=Posts::with('user')->with('post_taxonomy')->get();
    	return response()->json([
    		'list_post' => $posts,
            'total' => count($posts)
    	]);
    }

    public function add_post(Request $request)
    {	
       $user_id = Auth::id();

    	$request->validate([
	        'title' => 'required|min:5|max:255',
            'seo_title' => 'required|min:5|max:255',
            'meta_description' => 'required|min:50|max:255',
            'meta_keyword' => 'required'
	    ]);
    	$post = New Posts();
        $post->user_id = $user_id;
    	$post->title = $request->title;
    	$post->short_description=$request->short_description; 
    	$post->description=$request->description; 
    	$post->slug=$request->slug; 
    	$post->type='post'; 
        //$post->active=$request->active == true ? 1 : 0; 
        //$post->feature=$request->feature == true ? 1 : 0;

        if ($request->active) {
            $post->active=1;
        }else{
            $post->active=0;
        }
        if ($request->feature) {
            $post->feature=1;
        }else{
            $post->feature=0;
        }

        if ($request->file('feature_image')->isValid()){
            $path = Storage::putFile('public/upload', $request->file('feature_image'));
            $file_name=$request->file('feature_image')->hashName();
            $post->feature_image=$file_name; 
        }
        

    	$post->seo_title=$request->seo_title; 
    	$post->meta_keyword=$request->meta_keyword; 
    	$post->meta_description=$request->meta_description; 
    	$post->save();

        $item_post=$post::find($post->id);

        foreach ($request->cat_list_id as $key => $value) {
            $saveMany[]=array('tax_id' => $value);
        }

        $item_post->post_taxonomy_relation()->createMany($saveMany);

    	return response()->json(['lastID' => $post->id]);
    }

    public function update_post(Request $request,$postid)
    {   
        
        $request->validate([
            'title' => 'required|min:5|max:255',
            'seo_title' => 'required|min:5|max:255',
            'meta_description' => 'required|min:50|max:255',
            'meta_keyword' => 'required'
        ]);
        $post = New Posts();
        $item=$post::find($postid);

        $item->title = $request->title;
        $item->description=$request->description; 
        $item->slug=$request->slug; 
        $item->type='post'; 
        if ($request->active) {
            $item->active=1;
        }else{
            $item->active=0;
        }
        if ($request->feature) {
            $item->feature=1;
        }else{
            $item->feature=0;
        }
        //$item->active=$request->active === true ? '1' : '0'; 
        //$item->feature=$request->feature === true ? '1' : '0'; 

        if ($request->hasFile('new_feature_image')) {
            if ($request->file('new_feature_image')->isValid()){
                $path = Storage::putFile('public/upload', $request->file('new_feature_image'));
                $file_name=$request->file('new_feature_image')->hashName();
                $item->feature_image=$file_name; 
            }
        }

        $item->seo_title=$request->seo_title; 
        $item->meta_keyword=$request->meta_keyword; 
        $item->meta_description=$request->meta_description; 
        
        $item->save();

        foreach ($request->cat_list_id as $key => $value) {
            $item->post_taxonomy_relation()->updateOrCreate(
                ['tax_id' => $value],
                ['tax_id' =>  $value]
            );
        }
        
        $item->post_taxonomy_relation()->whereNotIn('tax_id',$request->cat_list_id)->delete();
        
        return ['message' => 'ok'];
    }

    public function delete_post($postid)
    {
    	$post = New Posts();
    	$item=$post::find($postid);
        $item->post_taxonomy_relation()->delete();
    	$item->delete();
    	return ['message' => 'ok'];
    }

    public function posts_with_pagination($per_page,$page)
    {
        if (empty($per_page)) {
            $per_page = 10;
        }
        if (empty($page) || $page == 1) {
            $offset=0;
        }

        if ($page > 1) {  
            $offset = ($page - 1)*$per_page;               
        }

        $post = New Posts();
        $total = $post->count();
        $all=$post::with('post_taxonomy')->orderBy('id','desc')->offset($offset)->limit($per_page)->get();
        foreach ($all as $key => $value) {
            if ($value->feature_image) {
               $all[$key]->feature_img_fullpath=asset('storage/upload/'.$value->feature_image);
            }
           
        }
       
        return response()->json([
            'total' => $total,
            'list_post' => $all,
            'per_page' => $per_page,
            'page' => $page,
            'offset' => $offset
        ]);
    }

    public function get_post($postid)
    {
        $post = New Posts();
        $item=$post::with('post_taxonomy_relation')->find($postid);
        $cat_list_id=array();
        foreach ($item->post_taxonomy_relation as $key => $value) {
           $cat_list_id[]=$value->tax_id;
        }
        $item->cat_list_id=$cat_list_id;
        return ['post' => $item];
    }
}
