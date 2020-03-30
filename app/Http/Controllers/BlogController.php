<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\PostTaxonomyRelation;

class BlogController extends Controller
{	


	public function all_feature_posts()
    {
    	$posts=Posts::where('feature','=',1)->where('active','=',1)->with('post_taxonomy')->limit(3)->get();
    	foreach ($posts as $key => $value) {
            if ($value->feature_image) {
               $posts[$key]->feature_img_fullpath=asset('storage/upload/'.$value->feature_image);
            }
           
        }
    	return response()->json([
    		'list_post' => $posts
    	]);
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
        $item=$post::where('slug','=',$postid)->with('post_taxonomy')->get();
        foreach ($item as $key => $value) {
            if ($value->feature_image) {
               $item[$key]->feature_img_fullpath=asset('storage/upload/'.$value->feature_image);
            }
           
        }
       
        return ['post' => $item];
    }
}
