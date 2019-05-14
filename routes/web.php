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

Route::get('mala',function(){
    return view('coba.coba1');
});
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login', 'Auth\LoginController@loginPage');
Auth::routes();


Route::middleware(['is_authenticated', 'is_dosen'])->group(function () {
    Route::prefix('dosen')->group(function () {
        Route::get('/', 'DosenController@index');
        Route::get('/users', 'DosenController@listOfUsers');
        Route::get('/agenda', 'DosenController@listOfAgenda');
        Route::get('agenda/{agenda_id}/jadwals', 'DosenController@getAgendaJadwals');
        Route::get('agenda/{jadwal_id}/waktus', 'DosenController@getAgendaWaktu');

        Route::resource('questions', 'QuestionsController');
        Route::get('quiz/{id}/questions', 'QuestionsController@questionslist')->name('listofquestions');
        Route::get('quiz/{id}/questions/create', 'QuestionsController@create')->name('createquestion');
        Route::get('quiz/{quiz_id}/questions/{question_id}/edit', 'QuestionsController@edit')->name('editquestion');
        
        Route::resource('quiz', 'QuizController');
        Route::get('quiz/{id}/participants', 'QuizController@participantsList')->name('participantslist');
        Route::get('quiz/{id}/generate', 'QuizController@generatePacket')->name('generatepacket');

       
        
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

        Route::get('/test2', function () {
            return view('mahasiswa.test2');
        });

        Route::get('/test3', function () {
            return view('mahasiswa.test3');
        });

        Route::get('quiz/{id}/result', 'MahasiswaController@quizResult');

        Route::match(['put', 'patch'], '/quiz/submit', 'MahasiswaController@submitQuiz')->name('submit.quiz');
        Route::match(['put', 'patch'], '/quiz/submit/ajax', 'MahasiswaController@submitQuizAjax')->name('submit.quiz.ajax');

        // Route::get('/coba', function () {
        //     return view('mahasiswa.test_coba');
        // });
    });
});

Route::post('upload/image', 'QuizController@uploadImage');
Route::post('upload/image/question', 'QuestionsController@uploadImage');


// Route::get('/login', function () {
//     return redirect('/');
// });

// Route::get('/home', 'HomeController@index')->name('home');
