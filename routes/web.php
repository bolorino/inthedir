<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\BackendOrganizationController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\RoleAssign;
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

Route::get('/', [OrganizationController::class, 'index']);

Route::get('/escenarios', [OrganizationController::class, 'list'])
->name('escenarios');

Route::get('/escenario/{slug}', [OrganizationController::class, 'viewBySlug'])
    ->name('frontend.view');

Route::post('/escenarios/buscar', [OrganizationController::class, 'search'])
    ->name('escenarios.search');

Route::get('/escenarios/{field}/{filter}', [OrganizationController::class, 'filter'])
    ->name('escenarios.filter');

Route::group(['middleware' => ['auth','verified']], function ()
{
    Route::get('/dashboard', function () {
        return view('backend.index');
    })->name('dashboard');
    /*
    Route::get('/dashboard/organizations', [BackendOrganizationController::class, 'list'])
        ->name('organization.list');
    Route::get('/dashboard/organization/{id}', [BackendOrganizationController::class, 'view'])
        ->name('organization.view');

    Route::get('/dashboard/organization-create', [BackendOrganizationController::class, 'create'])
        ->name('organization.create');
    Route::post('/dashboard/organization-store', [BackendOrganizationController::class, 'store'])
        ->name('organization.store');

    Route::get('/dashboard/organization-edit/{organization}', [BackendOrganizationController::class, 'edit'])
        ->name('organization.edit');
    Route::put('/dashboard/organization-update/{organization}', [BackendOrganizationController::class, 'update'])
        ->name('organization.update');
    */

    Route::post('/dashboard/organization-search', [BackendOrganizationController::class, 'search'])
        ->name('organization.search');

    Route::get('/dashboard/organizations-filter/{field}/{filter}', [BackendOrganizationController::class, 'filter'])
        ->name('organizations.filter');

});

Route::group(['middleware' => ['auth', 'role:editor|super-admin']], function ()
{
    Route::get('/dashboard/organizations', [OrganizationController::class, 'list'])
        ->name('organization.list');
    Route::get('/dashboard/organization/{id}', [OrganizationController::class, 'view'])
        ->name('organization.view');

    Route::get('/dashboard/organization-create', [OrganizationController::class, 'create'])
        ->name('organization.create');
    Route::post('/dashboard/organization-store', [OrganizationController::class, 'store'])
        ->name('organization.store');

    Route::get('/dashboard/organization-edit/{organization}', [OrganizationController::class, 'edit'])
        ->name('organization.edit');
    Route::put('/dashboard/organization-update/{organization}', [OrganizationController::class, 'update'])
        ->name('organization.update');
});

Route::group(['middleware' => ['auth', 'role:super-admin']], function ()
{
    Route::get('/dashboard/roles-permissions', [RolePermissionController::class, 'roles'])->name('roles-permissions');
    Route::get('/dashboard/role-create', 'RolePermissionController@createRole')->name('role.create');
    Route::post('/dashboard/role-store', 'RolePermissionController@storeRole')->name('role.store');
    Route::get('/dashboard/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
    Route::put('/dashboard/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');

    Route::get('/dashboard/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
    Route::post('/dashboard/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
    Route::get('/dashboard/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    Route::put('/dashboard/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');

    Route::resource('/dashboard/assignrole', 'App\Http\Controllers\RoleAssign');
});

require __DIR__.'/auth.php';
