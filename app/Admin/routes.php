<?php

use App\Admin\Controllers\DoctorController;
use App\Admin\Controllers\FileController;
use App\Admin\Controllers\HomeController;
use App\Admin\Controllers\HospitalController;
use App\Admin\Controllers\PageFileController;
use App\Admin\Controllers\RegionController;
use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

$defaultGroupAttributes = [
    'prefix' => \config('admin.route.prefix'),
    'middleware' => \config('admin.route.middleware'),
    'as' => \config('admin.route.prefix') . '.',
];

Route::group(\array_merge($defaultGroupAttributes, [
    'namespace' => \config('admin.route.namespace'),
]), function (Router $router) {

    $router->get('/', [HomeController::class, 'index'])->name('home');
    $router->resource('regions', RegionController::class);
    $router->resource('hospital', HospitalController::class);
    $router->resource('doctor', DoctorController::class);
    $router->resource('file', FileController::class);
    $router->resource('page', PageFileController::class);
});
