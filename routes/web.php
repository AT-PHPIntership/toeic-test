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

//=========================Backend=======================================
Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {

    // Dashboard
    Route::get('dashboard', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');

    // User
    Route::resource('user', 'UserController', ['as' => 'admin'], ['only' => [
        'index', 'show'
    ]]);

    // Admin User
    Route::resource('admin-user', 'AdminUserController', ['as' => 'admin'], ['only' => [
    'index', 'edit', 'create', 'store', 'update', 'destroy'
    ]]);

    //Category
    Route::resource('categories', 'CategoryController', ['as' => 'admin']);
    Route::resource('exams', 'ExamController', ['as' => 'admin', 'except' => 'show']);

    // Part
    Route::resource('part', 'PartController', ['as' => 'admin'], ['only' => [
        'index',
    ]]);

    Route::group(['prefix' => 'exams'], function () {
        Route::get('{examId}/question/part1/create', 'QuestionController@createPart1')->name('admin.questions.create.part1');
        Route::post('{examId}/question/part1', 'QuestionController@storePart1')->name('admin.questions.store.part1');
        Route::get('{examId}/question/part7/create', 'QuestionController@createPart7')->name('admin.questions.create.part7');
        Route::post('{examId}/question/part7', 'QuestionController@storePart7')->name('admin.questions.store.part7');
    });
});

// Login backend
Route::group(['namespace' => 'Backend', 'prefix' => 'admin'], function () {
    Route::Auth();
});
