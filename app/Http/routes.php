<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/admin' , ['as' => 'admin.index' ,function(){
	return view('admin.index');
}]);




Route::group(['middleware'=>'admin'] , function(){
	Route::resource('admin/users' , 'AdminUsersController');
	Route::resource('admin/posts' , 'AdminPostsController');
});


