<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\View;
use App\Http\Controllers\singup;
use App\Http\Controllers\tasks;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('welcome');})->name('home_page');
Route::get('/SignUp', [singup::class, 'index'])->name('signup_page');
Route::get('/Tasks', [tasks::class, 'index'])->name('tasks_page');
Route::post('/CreateTask',[tasks::class, 'create'])->name('createTasks_page');
Route::delete('/Tasks/{taskId}', [tasks::class, 'delete']);
Route::post('/Tasks/pin/{taskId}', [tasks::class, 'pinTask'])->name('pin_task');
Route::post('/Tasks/pin/{taskId}/update', [tasks::class, 'updatePinStatus'])->name('update_pin_status');
Route::get('/Tasks/pined', [tasks::class, 'pined'])->name('pined_tasks');


Route::post('/Create',[singup::class, 'create'])->name('Create_page');
Route::post('/SingIn',[singup::class, 'singin'])->name('singin_page');
Route::get('/Logout',[singup::class, 'logout'])->name('logout_page');

