<?php
/**
 * Copyright (c) Liigem 2017.
 */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();


Route::group(['domain' => '{account}.teacherhawk.dev'], function ()
{
    Route::get('/', 'School\WelcomeController@index');
});
Route::group(['domain' => 'teacherhawk.dev'], function ()
{
    Route::get('/cgu', 'FrontOffice\StaticController@cgu');
    Route::get('/about', 'FrontOffice\StaticController@about');
    Route::get('/faq', 'FrontOffice\StaticController@faq');
    // Route::get('/pricing', 'FrontOffice\StaticController@pricing');


    Route::get('/', function ()
    {
        return view('frontoffice.home');
    });



    // Controller pour les administrateurs établissements
    Route::group(array('prefix' => 'admin', 'before' => 'auth'), function ()
    {
        Route::get('/', function ()
        {
            return redirect('/admin/dashboard');
        })->middleware('auth', 'role:admin');
		    Route::get('/invites', 'AdminOffice\InvitesController@index')->middleware('auth', 'role:admin');
        Route::get('/dashboard', 'AdminController@index')->middleware('auth', 'role:admin');
        Route::get('/schools', 'AdminOffice\SchoolsController@index')->middleware('auth', 'role:admin');
        Route::get('/classrooms',       ['as' => 'admin-classrooms',  'uses' => 'AdminOffice\ClassroomsController@index'])->middleware('auth', 'role:admin');
    });




    //Controller pour les étudiants
    Route::group(array("prefix" => "student", "before" => "auth"), function ()
    {
        //Controller pour les étudiants
        Route::get("/", "StudentController@index");
        Route::resource("assignments", "AssignmentController");
        Route::resource("teachers", "TeacherForStudentController");
        Route::resource("exams", "ExamController");
        Route::resource("documents", "DocumentsController");

        Route::get("/edt", "StudentController@edtWeek");
        Route::get("/settings", "Students\SettingsController@index");

        Route::get("/notes", "Students\NotesController@index");
        Route::get('documents/{id}/download', "DocumentsController@download")->where('id', '([0-9]+)');

    });
    //Controller pour les profs
    Route::group(array("prefix" => "teacher", "before" => "auth"), function ()
    {
        Route::get('/', function ()
        {
            return redirect('/teacher/dashboard');
        })->middleware('auth', 'role:user');
        Route::get('/dashboard', 'TeacherOffice\DashboardController@index')->middleware('auth', 'role:user');
        Route::resource('classes', 'TeacherOffice\ClassesController', ['only' => [
            'index', 'store', 'update', 'destroy', 'show', 'create'
        ]]);
        Route::resource('assignments', 'TeacherOffice\AssignmentsController', ['only' => [
            'index', 'store', 'update', 'destroy', 'show', 'create'
        ]]);
		Route::get('/assignments/{id}/view/{student_id}', "TeacherOffice\AssignmentsController@view")->where(['id', '([0-9]+)'], ['student_id', '([0-9]+)']);
        Route::post('/assignments/{id}/view', "TeacherOffice\AssignmentsController@gradeDocument")->where('id', '([0-9]+)');
        Route::get('/assignments/{id}/download', "TeacherOffice\AssignmentsController@download")->where('id', '([0-9]+)');

        Route::resource('documents', 'TeacherOffice\DocumentsController', ['only' => [
			'index', 'store', 'destroy'//, 'update', 'show'
        ]]);

        Route::resource("schools", "TeacherOffice\SchoolsController");

        Route::post('/actuality/create', 'TeacherOffice\ActualityController@addActuality')->middleware('auth', 'role:user');

        Route::get('/notes', 'TeacherOffice\NotesController@index')->middleware('auth', 'role:user');
        Route::post('/notes/details', 'TeacherOffice\NotesController@details')->middleware('auth', 'role:user');
        Route::get('/notes/create/{id}', 'TeacherOffice\NotesController@create')->middleware('auth', 'role:user');
        Route::post('/notes/create', 'TeacherOffice\NotesController@create_save')->middleware('auth', 'role:user');
        Route::get('/notes/edit/{id}', 'TeacherOffice\NotesController@edit')->middleware('auth', 'role:user');
        Route::post('/notes/edit/{id}', 'TeacherOffice\NotesController@edit_save')->middleware('auth', 'role:user');
        Route::get('/notes/delete/{id}', 'TeacherOffice\NotesController@delete')->middleware('auth', 'role:user');
        Route::get('/notes/graphics', 'TeacherOffice\NotesController@graphics')->middleware('auth', 'role:user');

       
        
        Route::prefix('/reviews')->group(function(){
          Route::get('/edit', 'TeacherOffice\ReviewsController@edit')->middleware('auth', 'role:user'); 
          Route::post('/edit', 'TeacherOffice\ReviewsController@edit_post')->middleware('auth', 'role:user');
          Route::get('/edit/{id}/{class}','TeacherOffice\ReviewsController@single_post')->name('single.posting')->middleware('auth', 'role:user')->where('id', '([0-9]+)');
          Route::post('/add','TeacherOffice\ReviewsController@createreview')->name('post.reviews')->middleware('auth', 'role:user');
          Route::post('/hellcat','TeacherOffice\ReviewsController@modifyreview')->name('modify.reviews')->middleware('auth', 'role:user');
          Route::get('', 'TeacherOffice\ReviewsController@index')->middleware('auth', 'role:user'); 
         });
        

        //Route::get('/reviews', 'TeacherOffice\ReviewsController@index')->middleware('auth', 'role:user');
        //Route::get('/reviews/edit', 'TeacherOffice\ReviewsController@edit')->middleware('auth', 'role:user');
        //Route::post('/reviews/edit', 'TeacherOffice\ReviewsController@edit_post')->middleware('auth', 'role:user');
        //Route::get('/reviews/edit/{id}/{class}',['uses'=>'TeacherOffice\ReviewsController@single_post', 'as'=>'single.posting'])->middleware('auth', 'role:user')->where('id', '([0-9]+)');
        //Route::post('/reviews/add',['uses'=>'TeacherOffice\ReviewsController@createreview', 'as'=>'post.reviews'])->middleware('auth', 'role:user');
        //Route::post('/reviews/hellcat',['uses'=>'TeacherOffice\ReviewsController@modifyreview', 'as'=>'modify.reviews'])->middleware('auth', 'role:user');


        Route::get('/absences', 'TeacherOffice\AbsencesController@index')->middleware('auth', 'role:user');
        Route::get('/absences/history', 'TeacherOffice\AbsencesController@history')->middleware('auth', 'role:user');
        Route::get('/absences/record/{id}', 'TeacherOffice\AbsencesController@record')->middleware('auth', 'role:user')->where('id', '([0-9]+)');
        Route::post('/absences/record/{id}', 'TeacherOffice\AbsencesController@addAppel')->middleware('auth', 'role:user')->where('id', '([0-9]+)');

        Route::get('/notifications', 'TeacherOffice\StaticController@notifications')->middleware('auth', 'role:user');
        Route::get('/vers0ion', 'TeacherOffice\StaticController@version')->middleware('auth', 'role:user');
        Route::get('/settings', 'TeacherOffice\SettingsController@index')->middleware('auth', 'role:user');
        Route::post('/settings', 'TeacherOffice\SettingsController@update')->middleware('auth', 'role:user');

        Route::get('/invites', 'TeacherOffice\InvitesController@index')->middleware('auth', 'role:user');
        Route::post('/invites', 'TeacherOffice\InvitesController@add')->middleware('auth', 'role:user');
        Route::post('/invites/remove', 'TeacherOffice\InvitesController@remove')->middleware('auth', 'role:user');

    });
	// Common controllers
	Route::get('storage/students/{filename}', function ($filename)
	{
		return response()->file(storage_path('app/uploads/students/' . $filename));
	})->middleware('auth', 'storageAccess');

	Route::get('storage/avatars/{filename}', function ($filename)
	{
		return response()->file(storage_path('app/public/avatars/' . $filename));
	})->middleware('auth');
    });
   