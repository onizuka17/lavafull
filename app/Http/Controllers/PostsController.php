<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;

class PostsController extends Controller
{
    public function all_posts()
    {
    	$posts=Posts::with('user')->get();
    	return response()->json([
    		'list_post' => $posts,
            'total' => count($posts)
    	]);
    }

    public function add_post(Request $request)
    {	
    	$request->validate([
	        'cat_name' => 'required|min:5|max:255',
            'seo_title' => 'required|min:5|max:255',
            'meta_description' => 'required|min:100|max:255'
	    ]);
    	$post = New Posts();
    	$post->title = $request->cat_name;
    	$post->parent_id=$request->parent_id;
    	$post->description=$request->desc; 
    	$post->slug=$request->slug; 
    	$post->type='category'; 
    	$post->seo_title=$request->seo_title; 
    	$post->meta_keyword=$request->meta_keyword; 
    	$post->meta_description=$request->meta_description; 
    	$post->save();
    	return ['message' => 'ok'];
    }

    public function update_post(Request $request,$postid)
    {   
        $request->validate([
            'title' => 'required|min:5|max:255',
        ]);
        $post = New Posts();
        $item=$post::find($postid);

        $item->title = $request->title;
        $item->parent_id=$request->parent_id;
        $item->description=$request->description; 
        $item->slug=$request->slug; 
        $item->type='category'; 
        $item->seo_title=$request->seo_title; 
        $item->meta_keyword=$request->meta_keyword; 
        $item->meta_description=$request->meta_description; 
        
        $item->save();
        return ['message' => 'ok'];
    }

    public function delete_post($postid)
    {
    	$post = New Posts();
    	$item=$post::find($postid);
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
        $all=$post::orderBy('id','desc')->offset($offset)->limit($per_page)->get();
       
        return response()->json([
            'list_post' => $all,
            'per_page' => $per_page,
            'page' => $page,
            'offset' => $offset
        ]);
    }

    public function get_post($postid)
    {
        $post = New Posts();
        $item=$post::find($postid);
        return ['post' => $item];
    }
}
