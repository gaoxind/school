<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('student','UserController');
    $router->resource('instructor','InstructorController');
    $router->resource('class','ClassController');
    $router->resource('scholarship','ScholarshipController');
    $router->resource('user_scholarship','UserScholarshipController');
    $router->resource('web_inform','WebInformController');
    $router->resource('web_content','WebContentController');
    $router->resource('course','CourseController');
    $router->resource('award','AwardController');
    $router->resource('course_all','CourseAllController');
});
