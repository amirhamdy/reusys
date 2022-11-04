<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\PricebookController;
use App\Http\Controllers\ProductlineController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TranslatorController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/dashboard');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('customers', CustomerController::class);
        Route::resource('productlines', ProductlineController::class);
        Route::resource('pricebooks', PricebookController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('jobs', JobController::class);
        Route::resource('tasks', TaskController::class);
        Route::resource('portals', PortalController::class);
        Route::resource('opportunities', OpportunityController::class);
        Route::resource('resources', TranslatorController::class);
    });

Route::get('db_backup', function () {
    Artisan::call('backup:run --only-db');
    dd("DB Backup done!");
});

Route::get('full_backup', function () {
    Artisan::call('backup:run');
    dd("DB Backup done!");
});
