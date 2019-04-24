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



Route::get('/admin/classes', function () {
    return view('admin.classes');
});

Route::get('/admin/add-class', function () {
    return view('admin.createclass');
});

Route::get('/admin/edit-class/1', function () {
    return view('admin.editclass');
});

Route::get('/admin/create-quiz', function () {
    return view('admin.createquiz');
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

Route::get('/mahasiswa/classes', function () {
    return view('mahasiswa.classes');
});

Route::get('/mahasiswa/quizzes', function () {
    return view('mahasiswa.quizzes');
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
        Route::get('admin/users', 'UserController@index');
    });
});

