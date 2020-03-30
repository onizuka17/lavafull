<?php

namespace App\Http\Controllers;

use App\Post_taxonomy;
use Illuminate\Http\Request;

class PostTaxonomyController extends Controller
{   
    public function hasChild($id)
    {
        $cate = New Post_taxonomy();
        $child=$cate::where('parent_id','=',$id)->get();
        foreach ($child as $key => $value) {
            $child[$key]->hasChild=$this->hasChild($value->id);
        }
        return $child;
    }
    public function cate_with_subcate(){
        $cate = New Post_taxonomy();
        $list=$cate::where('parent_id','=',0)->get();
        foreach ($list as $key => $value) {
            $list[$key]->hasChild=$this->hasChild($value->id);

        }

        return response()->json(['list_category' => $list]);
    }
    //
    public function add_category(Request $request)
    {	
    	$request->validate([
	        'cat_name' => 'required|min:5|max:255',
            'seo_title' => 'required|min:5|max:255',
            'meta_description' => 'required|min:100|max:255'
	    ]);
    	$cate = New Post_taxonomy();
    	$cate->title = $request->cat_name;
    	$cate->parent_id=$request->parent_id;
    	$cate->description=$request->desc; 
    	$cate->slug=$request->slug; 
    	$cate->type='category'; 
    	$cate->seo_title=$request->seo_title; 
    	$cate->meta_keyword=$request->meta_keyword; 
    	$cate->meta_description=$request->meta_description; 
    	$cate->save();
    	return ['message' => 'ok'];
    }

    public function update_category(Request $request,$catid)
    {   
        $request->validate([
            'title' => 'required|min:5|max:255',
        ]);
        $cate = New Post_taxonomy();
        $item=$cate::find($catid);

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

    public function all()
    {
    	$cate = New Post_taxonomy();
    	$all=$cate::all();
        foreach ($all as $key => $item) {
            if ($item->parent_id > 0) {
                $single_cat=$cate::find($item->parent_id);
                if ($single_cat->id > 0) {
                    $all[$key]->parent_name=$single_cat->title;
                }
                
            } 
        }
    	return response()->json([
    		'list_category' => $all,
            'total' => count($all)
    	]);
    }

    public function delete_category($id)
    {
    	$cate = New Post_taxonomy();
    	$item=$cate::find($id);
    	$item->delete();
    	return ['message' => 'ok'];
    }

    public function category_with_pagination($per_page,$page)
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

        $cate = New Post_taxonomy();
        $all=$cate::orderBy('id','desc')->offset($offset)->limit($per_page)->get();
        foreach ($all as $key => $item) {
            if ($item->parent_id > 0) {
                $single_cat=$cate::find($item->parent_id);
                if ($single_cat->id > 0) {
                    $all[$key]->parent_name=$single_cat->title;
                }
                
            } 
        }
        return response()->json([
            'list_category' => $all,
            'per_page' => $per_page,
            'page' => $page,
            'offset' => $offset
        ]);
    }

    public function get_category($catid)
    {
        $cate = New Post_taxonomy();
        $item=$cate::find($catid);
        return ['category' => $item];
    }
}
