<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\UserManagement\Users\UserView;
use App\Http\Livewire\UserManagement\Users\UserAdd;
use App\Http\Livewire\UserManagement\Users\UserEdit;

use App\Http\Livewire\UserManagement\Roles\RoleView;
use App\Http\Livewire\UserManagement\Roles\RoleAdd;
use App\Http\Livewire\UserManagement\Roles\RoleEdit;

use App\Http\Livewire\UserManagement\AuditTrail;

use App\Http\Livewire\DepManagement\DepView;
use App\Http\Livewire\DepManagement\DepAdd;
use App\Http\Livewire\DepManagement\DepEdit;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Profile;

use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\LaravelExamples\UserManagement;

use Illuminate\Http\Request;

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

Route::get('/', function() {
    return redirect('/login');
});

Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/audit-trail', AuditTrail::class)->name('audit-trail');
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    Route::get('/laravel-user-management', UserManagement::class)->name('user-management');
    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'users'], function(){
        Route::get('/', UserView::class)->name('users');
        Route::get('/add', UserAdd::class)->name('add-user');
        Route::get('/edit/{id}', UserEdit::class)->name('edit-user');
    });
    /*
    |--------------------------------------------------------------------------
    | Role Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'roles'], function(){
        Route::get('/', RoleView::class)->name('roles');
        Route::get('/add', RoleAdd::class)->name('add-role');
        Route::get('/edit/{id}', RoleEdit::class)->name('edit-role');
    });
    /*
    |--------------------------------------------------------------------------
    | Department Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'departments'], function(){
        Route::get('/', DepView::class)->name('departments');
        Route::get('/add', DepAdd::class)->name('add-departments');
        Route::get('/edit/{id}', DepEdit::class)->name('edit-departments');
    });
});

