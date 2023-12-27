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
Route::get('/login',[UserController::class, 'showLogin'])->name('formlogin');
Route::post('/login',[UserController::class, 'onLogin'])->name('login');
Route::middleware(['auth'])->group(function () {
    Route::post('/logout',[UserController::class, 'logOut'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::middleware(['role:Administrator,Group Leader,'])->group(function () {
        //Training
        Route::get('/employee',[HomeController::class,'employee'])->name('employee');
        Route::get('/training', [TrainingController::class, 'index'])->name('training');
        Route::post('/training', [TrainingController::class, 'addTraining'])->name('add_training');
        Route::post('/training/{id}', [TrainingController::class, 'editTraining'])->name('edit_training');
        Route::delete('/training/{id}', [TrainingController::class, 'deleteTraining'])->name('delete_training');
        Route::get('/history',[TrainingController::class, 'historyTraining'])->name('history-training');
        Route::get('/history/{id}',[TrainingController::class, 'history'])->name('history');
        
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

        //Nilai
        Route::post('/score_a',[ScoreController::class, 'inputScoreA'])->name('input-scoreA');
        Route::post('/score_b',[ScoreController::class, 'inputScoreB'])->name('input-scoreB');
        Route::get('/finalscore/{id}',[ScoreController::class, 'finalScore'])->name('final-score');
        Route::get('/formupdatescore/{id}',[ScoreController::class, 'formupdateScore'])->name('form-updatescore');
        Route::post('/updatescore/{id}',[ScoreController::class, 'updateScore'])->name('update-score');
        Route::get('/pdfscore/{id}',[ScoreController::class, 'PdfScore'])->name('pdf-score');
        Route::get('/testpdf',[ScoreController::class, 'test'])->name('test');

        //API
        Route::post('/dataapinama', [ApiController::class, 'DataApiNama'])->name('DataApi');
        Route::post('/dataapisect', [ApiController::class, 'DataApiSect'])->name('DataApiSection'); 
    });
    Route::middleware(['role:Staff'])->group(function () {
        
    });
    Route::get('/datatraining',[TrainingController::class, 'dataTraining'])->name('data-training');
    Route::get('/penilaiantraining',[TrainingController::class, 'nilaiTraining'])->name('nilai-training');
    //Schedule
    Route::get('/scheduletraining',[TrainingController::class,'ScheduleTraining'])->name('schedule');
    Route::post('/scheduletraining',[TrainingController::class,'addSchtraining'])->name('add-schedule');
    Route::post('/scheduletraining/{id}',[TrainingController::class,'editSchtraining'])->name('edit-schedule');
    Route::delete('/scheduletraining/{id}',[TrainingController::class,'deleteSchtraining'])->name('delete-schedule');
    Route::get('/participants/{id}',[TrainingController::class,'formSchtraining'])->name('form-participants');
    Route::post('/participants/{id}',[TrainingController::class,'addParticipants'])->name('add-participants');
    Route::get('/viewparticipants/{id}',[TrainingController::class,'viewParticipants'])->name('view-participants');
    Route::put('/viewparticipants/{id}',[TrainingController::class, 'editParticipants'])->name('edit-participants');
    Route::delete('/viewparticipants/{id}',[TrainingController::class, 'deleteParticipants'])->name('delete-participants');
});