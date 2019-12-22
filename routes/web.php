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

Auth::routes();

/*Route for Admin, Listing Manager & Leads Manager*/
Route::group(['prefix'=>'/','namespace'=>'Admin'], function(){
	Route::get('/', 'AdminController@getAdminLogin')->name('welcome');
	Route::get('/login', 'AdminController@getAdminLogin');
	Route::post('/login', 'AdminController@postAdminLogin');
	Route::post('/', 'AdminController@postAdminLogin');
	Route::get('/admin-logout', 'AdminController@getAdminLogout');

	Route::group(['middleware'=>['auth','admin']],function(){
		Route::get('/admin-register', 'AdminController@getAdminRegister');
		Route::post('/admin-register', 'AdminController@postAdminRegister');
		Route::get('admin/dashboard', 'AdminController@viewAdminDashboard');

		/*USER URL's*/
		Route::get('admin/users', 'AdminController@getUsers');
		Route::get('/users/add', function(){return view('admin.add-user');});
		Route::post('/users/add', 'AdminController@postAddUser');
		Route::get('admin/users/edit/{id}', 'AdminController@getEditUser');
		Route::get('admin/users/view/{id}', 'AdminController@getViewUser');
		Route::post('admin/users/edit/{id}', 'AdminController@postUpdateUser');
		/*Route::get('/users/trash', 'AdminController@getTrashUsers');*/
		Route::get('/users/permanent-delete/{id}', 'AdminController@getPermanentDeleteUser');
		/*Route::get('/users/undo/{id}', 'AdminController@getUndoUser');*/

		/*Inspection URL's*/
		Route::get('/inspection', 'InspectionController@getInspection');
		Route::get('/inspection/add', function(){return view('admin.add-inspection');});
		Route::post('/inspection/add', 'InspectionController@postAddInspection');
		Route::get('/inspection/edit/{id}', 'InspectionController@getEditInspection');
		Route::post('/inspection/edit/{id}', 'InspectionController@postUpdateInspection');
		Route::get('/inspection/permanent-delete/{id}', 'InspectionController@getPermanentDeleteInspection');
		Route::get('/inspection/step/steps-list/{id}', 'InspectionController@getInspectionSteps');
		Route::get('/inspection/step/steps-add/{id}', function(){return view('admin.add-steps');});
		Route::post('/inspection/step/steps-add/{id}', 'InspectionController@postAddInspectionSteps');
		Route::get('/inspection/step/steps-edit/{i_id}/{s_id}', 'InspectionController@getEditInspectionSteps');
		Route::post('/inspection/step/steps-edit/{i_id}/{s_id}', 'InspectionController@postUpdateInspectionSteps');
		Route::get('/inspection/step/permanent-delete/{id}', 'InspectionController@getPermanentDeleteInspectionStep');
		Route::get('/inspection/inspection-schedule/{id}', 'InspectionController@getInspectionSchedule');
		Route::get('/inspection/schedule/add/{id}', 'InspectionController@getAddInspectionSchedule');
		Route::post('/inspection/schedule/add/{id}', 'InspectionController@postAddInspectionSchedule');
		Route::get('/inspection/schedule/edit/{id}', 'InspectionController@getEditInspectionSchedule');
		Route::post('/inspection/schedule/edit/{id}', 'InspectionController@postUpdateInspectionSchedule');
		Route::get('/inspection/schedule/permanent-delete/{id}', 'InspectionController@getPermanentDeleteInspectionSchedule');
	});	

});

/*Route for Users & Vendors*/
Route::group(['namespace'=>'User'], function(){
    Route::post('/user-login', 'UserController@postUserLogin');
	Route::post('/user-register', 'UserController@postUserRegister');
});

  /*Route for all*/
/*Route::get('/user-login', 'HomeController@homeView')->name('welcome');
Route::get('/dashboard', 'User\VendorController@getVendorDashboard');
*/


//API Block
Route::group(['namespace'=>'Api'], function(){
    Route::post('/register', 'ApiController@registerUser');
	Route::post('/getScheduledInspections', 'ApiController@getScheduledInspections');
	Route::post('/getInspectionDetails', 'ApiController@getInspectionDetails');
	Route::post('/login', 'ApiController@login');
});
