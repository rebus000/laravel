<?php
 use Illuminate\Http\Request;
Route::get('/', function () {
    $categ=App\Category::all();
    return view('welcome',["results"=>$categ]);
});
Route::get("/test",function(){
     App\Category::create(["name"=>"Что-то не так"]);
});
Route::get("/posts/{num}", function($num){
    $posts= App\Post::where("category_id",$num)->get();
    $categ=App\Category::all();
    return view("posts",["posts"=>$posts,"results"=>$categ]); 
});
Route::get("/ajax", function(Request $req){
	header("Access-Control-Allow-Origin:*");
	$b=App\Post::where("id",$req->test)->get();
	return $b;
});
Route::get("/getAll",function(){
	header("Access-Control-Allow-Origin:*");
	$req=App\Item::all();
	return $req;
});
Route::get("/found",function(){
	header("Access-Control-Allow-Origin:*");
	
	$c=App\Item::where("solution",1)->get();
	return $c;
});
Route::get("/lost",function(){
	header("Access-Control-Allow-Origin:*");
	
	$d=App\Item::where("solution",0)->get();
	return $d;
});
Route::get("/search",function(Request $req){
	header("Access-Control-Allow-Origin:*");
	$req=App\Item::where('title',"like", "%" .$req->search. "%")->orWhere("description", 'like','%' . $req->search . '%')->get();
	return $req;
});
