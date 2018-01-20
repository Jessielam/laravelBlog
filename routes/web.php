<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//前台路由
Route::group(['middleware' => ['web'], 'namespace'=>'Home'], function() {
    /** 首页 **/
    Route::get('/', 'IndexController@index');
    /** 栏目列表 **/
    Route::get('category/{id}', 'IndexController@category');
    /** 文章内容 **/
    Route::get('article/{id}', 'IndexController@article');
});

Route::group(['middleware' => ['web'], 'prefix'=>'admin', 'namespace'=>'Admin'], function() {
    /** 后台登录 */
    Route::any('login', 'LoginController@login');
    Route::get('code', 'LoginController@code');
});

Route::group(['middleware' => ['web', 'admin.login'], 'prefix'=>'admin', 'namespace'=>'Admin'], function() {
    /** 后台首页 */
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('logout', 'LoginController@logout');
    Route::any('edit', 'IndexController@edit');

    /** 分类 */
    Route::post('cate/sort', 'CategoryController@sort');
    Route::resource('category', 'CategoryController');

    /** 文章 */
    Route::resource('article', 'ArticleController');
    Route::any('upload', 'CommonController@upload');

    /** 标签 */
    Route::resource('tag', 'TagController');

    /** 友情链接 */
    Route::post('link/sort', 'LinksController@sort');
    Route::resource('link', 'LinksController');

    /** 自定义导航 */
    Route::post('navs/sort', 'NavsController@sort');
    Route::resource('navs', 'NavsController');

    /** 网站配置 **/
    Route::post('config/sort', 'ConfigController@sort');
    Route::post('config/saveContent', 'ConfigController@saveContent');
    Route::get('config/generateFile', 'ConfigController@generateFile');
    Route::resource('config', 'ConfigController');

});