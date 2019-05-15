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
    return redirect('login');
});

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login', 'Auth\LoginController@loginPage');
Auth::routes();


Route::middleware(['is_authenticated', 'is_dosen'])->group(function () {
    Route::prefix('dosen')->group(function () {
        Route::get('/mala', function(){
            return view('coba.coba1');
        });
        Route::get('/', 'DosenController@index');
        Route::get('/users', 'DosenController@listOfUsers');
        Route::get('/agenda', 'DosenController@listOfAgenda');
        Route::get('agenda/{agenda_id}/jadwals', 'DosenController@getAgendaJadwals');
        Route::get('agenda/{jadwal_id}/waktus', 'DosenController@getAgendaWaktu');

        Route::resource('questions', 'QuestionsController');
        Route::get('quiz/{id}/questions/create', 'QuestionsController@create')->name('createquestion');
        Route::get('quiz/{quiz_id}/questions/{question_id}/edit', 'QuestionsController@edit')->name('editquestion');
        
        Route::resource('quiz', 'QuizController');
        Route::get('quiz/{id}/generate', 'QuizController@generatePacket')->name('generatepacket');

        Route::post('quiz/{id}/import', 'QuestionsController@importQuestion')->name('import.question');
    });
});

Route::middleware(['is_authenticated', 'is_mahasiswa'])->group(function () {
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', 'MahasiswaController@dashboard');
        Route::get('kelas/', 'MahasiswaController@myClass');
        Route::get('/quizzes', 'MahasiswaController@myQuizzes');
        Route::get('/quiz/{id}/questions', 'MahasiswaController@myQuestions');

        Route::get('/test', function () {
            return view('mahasiswa.test');
        });

        Route::get('quiz/{id}/result', 'MahasiswaController@quizResult');

        Route::match(['put', 'patch'], '/quiz/submit', 'MahasiswaController@submitQuiz')->name('submit.quiz');
        Route::match(['put', 'patch'], '/quiz/submit/ajax', 'MahasiswaController@submitQuizAjax')->name('submit.quiz.ajax');

    });
});

Route::post('upload/image', 'QuizController@uploadImage');
Route::post('upload/image/question', 'QuestionsController@uploadImage');