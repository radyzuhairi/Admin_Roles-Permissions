<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



//dd(app()->make(RoleMiddleware::class));

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/check-role', function () {
    $user = Auth::user();

    if (!$user) {
        return '🚫 المستخدم غير مسجل الدخول';
    }

    return $user->hasRole('admin') ? '✅ المستخدم admin' : '❌ المستخدم ليس admin';
});*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','role:admin'])->name('admin.')->prefix('admin')->group(function(){
   Route::get('/',[IndexController::class ,'index'])->name('index');
   Route::resource('/roles', RoleController::class);
   Route::post('/roles/{role}/permissions',[RoleController::class ,'givenPermission'])->name('roles.permissions');
   Route::delete('/roles/{role}/permissions/{permission}',[RoleController::class ,'revokePermission'])->name('roles.permissions.revoke');
   Route::resource('/permissions', PermissionController::class);
   Route::get('/users',[UserController::class,'index'])->name('users.index');
   Route::get('/users/{user}',[UserController::class,'show'])->name('users.show');

   Route::delete('/users/{user}',[UserController::class,'destroy'])->name('users.destroy');
   Route::post('/users/{user}/roles',[UserController::class,'assignRole'])->name('users.roles');
   Route::delete('/users/{user}/roles/{role}',[UserController::class,'removeRole'])->name('users.roles.remove');
     Route::post('/users/{user}/permissions',[UserController::class,'givePermission'])->name('users.permissions');
   Route::delete('/users/{user}/permissions/{permission}',[UserController::class,'revokePermission'])->name('users.permissions.revoke');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
