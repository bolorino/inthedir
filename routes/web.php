<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/escenarios', [OrganizationController::class, 'list'])
->name('escenarios');

Route::get('/escenario/{slug}', [OrganizationController::class, 'viewBySlug'])
    ->name('frontend.view');

Route::post('/escenarios/buscar', [OrganizationController::class, 'search'])
    ->name('escenarios.search');

Route::get('/escenarios/{field}/{filter}', [OrganizationController::class, 'filter'])
    ->name('escenarios.filter');

/**
 * Registration and verification
 */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', __('Enlace de verificación enviado'));
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/approval', [HomeController::class, 'approve'])->name('approval');

Route::group(['middleware' => ['auth','verified', 'approved']], function ()
{
    Route::get('/dashboard', function () {
        return view('backend.index');
    })->name('dashboard');
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

    Route::resource('/dashboard/user', 'App\Http\Controllers\UserController');
});

require __DIR__.'/auth.php';
