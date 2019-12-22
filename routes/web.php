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
		Route::get('admin/admin-logout', 'AdminController@getAdminLogout');
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
