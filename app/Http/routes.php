<?php
Route::get('/', 'View\NewsController@show');
Route::get('/welcome',function(){
   return view('welcome') ;
});
Route::get('cangxi_news','View\NewsController@show');
Route::get('about_gy','View\NewsController@aboutgy');


/*Route::get('/category', 'View\BookController@toCategory');*/
Route::get('/product/category_id/{category_id}', 'View\BookController@toProduct');
Route::get('/product/{product_id}', 'View\BookController@toPdtContent');


Route::group(['prefix' => 'service'], function () {
  Route::post('upload/{type}', 'Service\UploadController@uploadFile');
});
/***********************************后台相关***********************************/
Route::group(['prefix' => 'admin'], function () {
  Route::get('login', 'Admin\IndexController@toLogin');
  Route::get('exit', 'Admin\IndexController@toExit');
  Route::post('service/login', 'Admin\IndexController@login');
  Route::group(['middleware' => 'check.admin.login'], function () {
      Route::group(['prefix' => 'service'], function () {
          Route::post('category/add', 'Admin\CategoryController@categoryAdd');
          Route::post('category/del', 'Admin\CategoryController@categoryDel');
          Route::post('category/edit', 'Admin\CategoryController@categoryEdit');
          Route::post('product/add', 'Admin\ProductController@productAdd');
          Route::post('product/del', 'Admin\ProductController@productDel');
          Route::post('product/edit', 'Admin\ProductController@productEdit');
      });
      Route::get('index', 'Admin\IndexController@toIndex');
      Route::get('category', 'Admin\CategoryController@toCategory');
      Route::get('category_add', 'Admin\CategoryController@toCategoryAdd');
      Route::get('category_edit', 'Admin\CategoryController@toCategoryEdit');
      Route::get('product', 'Admin\ProductController@toProduct');
      Route::get('gk', 'Admin\ProductController@togk');
      Route::get('product_info', 'Admin\ProductController@toProductInfo');
      Route::get('product_add', 'Admin\ProductController@toProductAdd');
      Route::get('gk_add', 'Admin\ProductController@togkAdd');
      Route::get('product_edit', 'Admin\ProductController@toProductEdit');
  });
});
