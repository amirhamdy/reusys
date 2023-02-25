<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CustomerProductlinesController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\JobTasksController;
use App\Http\Controllers\Api\OpportunityController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PortalController;
use App\Http\Controllers\Api\PricebookController;
use App\Http\Controllers\Api\PricebookPricelistsController;
use App\Http\Controllers\Api\PricebookProductlinesController;
use App\Http\Controllers\Api\ProductlineController;
use App\Http\Controllers\Api\ProductlineOpportunitiesController;
use App\Http\Controllers\Api\ProductlineProjectsController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProjectJobsController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TranslatorContactsController;
use App\Http\Controllers\Api\TranslatorController;
use App\Http\Controllers\Api\TranslatorPriceListController;
use App\Http\Controllers\Api\TranslatorTasksController;
use App\Http\Controllers\Api\TranslatorTranslatorPriceListsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('customers', CustomerController::class);

        // Customer Productlines
        Route::get('/customers/{customer}/productlines', [
            CustomerProductlinesController::class,
            'index',
        ])->name('customers.productlines.index');
        Route::post('/customers/{customer}/productlines', [
            CustomerProductlinesController::class,
            'store',
        ])->name('customers.productlines.store');

        Route::apiResource('productlines', ProductlineController::class);

        // Productline Projects
        Route::get('/productlines/{productline}/projects', [
            ProductlineProjectsController::class,
            'index',
        ])->name('productlines.projects.index');
        Route::post('/productlines/{productline}/projects', [
            ProductlineProjectsController::class,
            'store',
        ])->name('productlines.projects.store');

        // Productline Opportunities
        Route::get('/productlines/{productline}/opportunities', [
            ProductlineOpportunitiesController::class,
            'index',
        ])->name('productlines.opportunities.index');
        Route::post('/productlines/{productline}/opportunities', [
            ProductlineOpportunitiesController::class,
            'store',
        ])->name('productlines.opportunities.store');

        Route::apiResource('pricebooks', PricebookController::class);

        // Pricebook Productlines
        Route::get('/pricebooks/{pricebook}/productlines', [
            PricebookProductlinesController::class,
            'index',
        ])->name('pricebooks.productlines.index');
        Route::post('/pricebooks/{pricebook}/productlines', [
            PricebookProductlinesController::class,
            'store',
        ])->name('pricebooks.productlines.store');

        // Pricebook Pricelists
        Route::get('/pricebooks/{pricebook}/pricelists', [
            PricebookPricelistsController::class,
            'index',
        ])->name('pricebooks.pricelists.index');
        Route::post('/pricebooks/{pricebook}/pricelists', [
            PricebookPricelistsController::class,
            'store',
        ])->name('pricebooks.pricelists.store');

        Route::apiResource('projects', ProjectController::class);

        // Project Jobs
        Route::get('/projects/{project}/jobs', [
            ProjectJobsController::class,
            'index',
        ])->name('projects.jobs.index');
        Route::post('/projects/{project}/jobs', [
            ProjectJobsController::class,
            'store',
        ])->name('projects.jobs.store');

        Route::apiResource('jobs', JobController::class);

        // Job Tasks
        Route::get('/jobs/{job}/task', [
            JobTasksController::class,
            'index',
        ])->name('jobs.task.index');
        Route::post('/jobs/{job}/task', [
            JobTasksController::class,
            'store',
        ])->name('jobs.task.store');

        Route::apiResource('task', TaskController::class);

        Route::apiResource('portals', PortalController::class);

        Route::apiResource('opportunities', OpportunityController::class);

        Route::apiResource('resources', TranslatorController::class);

        // Translator Tasks
        Route::get('/translators/{translator}/task', [
            TranslatorTasksController::class,
            'index',
        ])->name('translators.task.index');
        Route::post('/translators/{translator}/task', [
            TranslatorTasksController::class,
            'store',
        ])->name('translators.task.store');

        // Translator Translator Price Lists
        Route::get('/translators/{translator}/translator-price-lists', [
            TranslatorTranslatorPriceListsController::class,
            'index',
        ])->name('translators.translator-price-lists.index');
        Route::post('/translators/{translator}/translator-price-lists', [
            TranslatorTranslatorPriceListsController::class,
            'store',
        ])->name('translators.translator-price-lists.store');

        // Translator Contacts
        Route::get('/translators/{translator}/contacts', [
            TranslatorContactsController::class,
            'index',
        ])->name('translators.contacts.index');
        Route::post('/translators/{translator}/contacts', [
            TranslatorContactsController::class,
            'store',
        ])->name('translators.contacts.store');

        // Banks
        Route::apiResource('banks', BankController::class);
    });
