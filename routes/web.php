<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ApiController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
//Training
Route::get('/training', [TrainingController::class, 'index'])->name('training');
Route::post('/training', [TrainingController::class, 'addTraining'])->name('add_training');
Route::post('/training/{id}', [TrainingController::class, 'editTraining'])->name('edit_training');
Route::delete('/training/{id}', [TrainingController::class, 'deleteTraining'])->name('delete_training');
Route::get('/datatraining',[TrainingController::class, 'dataTraining'])->name('data-training');
//Schedule
Route::get('/scheduletraining',[TrainingController::class,'ScheduleTraining'])->name('schedule');
Route::post('/scheduletraining',[TrainingController::class,'addSchtraining'])->name('add-schedule');
//User
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::post('/user', [UserController::class, 'addUser'])->name('add_user');
Route::post('/user/{id}', [UserController::class, 'editUser'])->name('edit_user');
Route::delete('/user/{id}', [UserController::class, 'deleteUser'])->name('delete_user');
//Score
Route::get('/score', [ScoreController::class, 'index'])->name('score');
Route::post('/score', [ScoreController::class, 'addScore'])->name('add_score');
Route::post('/score/{id}', [ScoreController::class, 'editScore'])->name('edit_score');
Route::delete('/score/{id}', [ScoreController::class, 'deleteScore'])->name('delete_score');
//API
Route::post('/dataapinama', [ApiController::class, 'DataApiNama'])->name('DataApi');
Route::post('/dataapisect', [ApiController::class, 'DataApiSect'])->name('DataApiSection');