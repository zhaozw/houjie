<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {
    // 仪表盘
    $router->get('/', 'HomeController@index');
    // 用户管理
    $router->resource('users', 'UserController');
    // 酷站管理
    $router->resource('cool_sites', 'CoolSiteController');
    // 新闻分类管理
    $router->resource('category', 'CategoryController');
    // 新闻管理
    $router->resource('news', 'NewsController');
    // 情书管理
    $router->resource('express', 'ExpressController');
    // 教师在线管理
    $router->resource('teacher', 'TeacherController');
});
