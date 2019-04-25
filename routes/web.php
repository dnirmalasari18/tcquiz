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

Route::get('/admin/quiz-list', function () {
    return view('admin.listofquizzes');
});

Route::get('/admin/edit-quiz/1', function () {
    return view('admin.createquiz');
});

Route::get('/admin/quiz/1/questions', function () {
    return view('admin.questions');
});

Route::post('login', 'Auth\LoginController@login');
Route::get('login', 'Auth\LoginController@loginPage');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['is_authenticated', 'is_admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        });
        Route::resource('users', 'UserController');
        Route::resource('kelas', 'KelasController');
    });
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
    });
});

Route::middleware(['is_authenticated', 'is_dosen'])->group(function () {
    Route::prefix('dosen')->group(function () {
        Route::get('/', function () {
            return view('dosen.dashboard');
        });
    });
});