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

Route::get('/admin', function () {
    return view('layouts.admin');
});

Route::get('/admin/users', function () {
    return view('admin.users');
});

Route::get('/admin/add-user', function () {
    return view('admin.createuser');
});

Route::get('/admin/edit-user/1', function () {
    return view('admin.edituser');
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
