<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
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
    return view('welcome');
});

// aku try bawah
Route::any('/admin', [AdminController::class, 'index'])->name('admin');
// Route::any('admin/dashboard/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::any('/logout', [AdminController::class, 'logout'])->name('logout');

// aku try atas


// Route::prefix('admin') -> group(function(){
//     Route::any('/', [AdminController::class, 'index']);
//     Route::any('/dashboard/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });

// Route::any('/admin/job', [DashboardController::class, 'jobManagement'])
//     ->name('management.job');



// Route::any('/admin/user', [DashboardController::class, 'userManagement'])
//     ->name('management.user');

// Route::any('/admin/edit/{id}', [DashboardController::class, 'jobEdit'])
//     ->name('admin.edit'); // need to change to jobEdit in the name

// Route::any('/admin/delete/{id}', [DashboardController::class, 'delete'])
//     ->name('admin.delete');

// // for department
// Route::any('/admin/department', [DashboardController::class, 'departmentManagement'])
//     ->name('management.department');
// Route::any('/admin/departmentEdit/{id}', [DashboardController::class, 'departmentEdit'])
//     ->name('admin.departmentEdit');
// Route::any('/admin/departmentDelete/{id}', [DashboardController::class, 'departmentDelete'])
//     ->name('admin.departmentDelete');

// // for user
// Route::any('/admin/user', [DashboardController::class, 'userManagement'])
// ->name('management.user');
// Route::any('/admin/userEdit/{id}', [DashboardController::class, 'userEdit'])
// ->name('admin.userEdit');
// Route::any('/admin/userDelete/{id}', [DashboardController::class, 'userDelete'])
// ->name('admin.userDelete');


// cara dia
// Route::prefix('department') -> group(function(){
//     Route::any('/edit', [AdminController::class, 'index']);
//     Route::any('/delete', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });


// aku try

Route::middleware(['auth'])->group(function () {
    //
    Route::any('admin/dashboard/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::any('/admin/job', [DashboardController::class, 'jobManagement'])
    ->name('management.job');

    Route::any('/admin/user', [DashboardController::class, 'userManagement'])
        ->name('management.user');

    Route::any('/admin/edit/{id}', [DashboardController::class, 'jobEdit'])
        ->name('admin.edit'); // need to change to jobEdit in the name

    Route::any('/admin/delete/{id}', [DashboardController::class, 'delete'])
        ->name('admin.delete');

    // for department
    Route::any('/admin/department', [DashboardController::class, 'departmentManagement'])
        ->name('management.department');
    Route::any('/admin/departmentEdit/{id}', [DashboardController::class, 'departmentEdit'])
        ->name('admin.departmentEdit');
    Route::any('/admin/departmentDelete/{id}', [DashboardController::class, 'departmentDelete'])
        ->name('admin.departmentDelete');

    // for user
    Route::any('/admin/user', [DashboardController::class, 'userManagement'])
    ->name('management.user');
    Route::any('/admin/userEdit/{id}', [DashboardController::class, 'userEdit'])
    ->name('admin.userEdit');
    Route::any('/admin/userDelete/{id}', [DashboardController::class, 'userDelete'])
    ->name('admin.userDelete');
    
});

Route::get('queue-email', function(){

    $email_list['email'] = 'ahmadfikri.anwarfadzil@gmail.com';   
    // $user = User::whereId(2)->first();
    // $email_list['user'] = $user;

    $user = User::whereId(1)->first();
    $email_list['user'] = $user;

    dispatch(new \App\Jobs\QueueJob($email_list));
    
    // return response()->json($email_list['email']);
    dd('Send Email Successfully');
});

Route::get('create-user', function(){
    $user = new User();
    // $email_list['email'] = 'ahmadfikri.anwarfadzil@gmail.com';
    $user->name = "azizi345";
    $user->email = 'azizi345@gmail.com';
    $user -> password = bcrypt('password');
    $user->save();

    
    
    // $user = User::whereId(2)->first();
    // $email_list['user'] = $user;

    // dispatch(new \App\Jobs\QueueJob($email_list));
    
    return response()->json('user_created');
    // dd('Send Email Successfully');
});

