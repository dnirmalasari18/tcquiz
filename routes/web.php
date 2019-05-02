<?php

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

Route::get('/dosen/quiz/1/questions/addquestions', function () {
    return view('dosen.addquestions'); 
});

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login', 'Auth\LoginController@loginPage');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['is_authenticated', 'is_dosen'])->group(function () {
    Route::prefix('dosen')->group(function () {
        Route::get('/', function () {
            return view('dosen.dashboard');
        });
        Route::resource('users', 'UserController');
        Route::resource('agenda', 'AgendaController');
        Route::get('agenda/{id}/detail', 'AgendaController@detailkelas');
        Route::get('agenda/{id}/addmahasiswa', 'AgendaController@addmahasiswa');
        Route::resource('quiz', 'QuizController');
        Route::get('agenda/{agenda_id}/jadwals', 'AgendaController@getAgendaJadwals');
        Route::get('quiz/{id}/questions', 'QuizController@questionslist')->name('listofquestions');
    });
});

Route::get('/login2', function () {
    return view('auth.login_temp');
});

Route::middleware(['is_authenticated', 'is_mahasiswa'])->group(function () {
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', function () {
            return view('mahasiswa.dashboard');
        });
        Route::get('/kelas', function () {
            return view('mahasiswa.classes');
        });
        Route::get('/quizzes', function () {
            return view('mahasiswa.quizzes');
        });

        Route::get('/test', function () {
            return view('mahasiswa.test');
        });

        Route::get('/test2', function () {
            return view('mahasiswa.test2');
        });

        Route::get('/test3', function () {
            return view('mahasiswa.test3');
        });
    });
});

Route::post('upload/image', 'QuizController@uploadImage');
