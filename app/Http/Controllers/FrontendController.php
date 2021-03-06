<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FrontendController extends Controller
{
    private function render() {
	    $renderer_source = File::get(base_path('node_modules/vue-server-renderer/basic.js'));
	    $app_source = File::get(public_path('js/entry-server.js'));

	    $v8 = new \V8Js();

	    ob_start();

	   	$v8->executeString('var process = { env: { VUE_ENV: "server", NODE_ENV: "production" }}; this.global = { process: process };');
	    $v8->executeString($renderer_source);
	    $v8->executeString($app_source);

	    return ob_get_clean();
	}

  	public function index() {
   	 	$ssr = $this->render();
    	return view('public.index', ['ssr' => $ssr]);
  	}
}
