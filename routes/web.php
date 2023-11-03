<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataSourceController;
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
    return view('Admin.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {

    //Admin Routes
    Route::group(['middleware' => ['checkAdmin']], function () {
        Route::get('Admin/dashboard', [AdminController::class, 'dashboard'])->name('Admin/dashboard');
        Route::post('Admin/createUser',[AdminController::class,'createUser'])->name('Admin/createUser');
        Route::get('Admin/deleteUser/{id}',[AdminController::class,'deleteUser']);
         Route::post('Admin/updateUser',[AdminController::class,'updateUser'])->name('Admin/updateUser');
         Route::get('Admin/editUser/{id}',[AdminController::class,'editUser'])->name('Admin/editUser');
         Route::post('Admin/changeUserRole',[AdminController::class,'changeUserRole'])->name('Admin/changeUserRole');
         Route::get('Admin/changePassword',[AdminController::class,'changePassword'])->name('Admin/changePassword');
         Route::post('Admin/changePasswordData',[AdminController::class,'changePasswordData'])->name('Admin/changePasswordData');
         
        // Create Data Sources 
      
        Route::post('Admin/createDataSourceOption', [DataSourceController::class,'createDataSourceOption'])->name('createDataSourceOption');
       
       
  
        Route::get('Admin/editDataSourceOption/{id}',[DataSourceController::class,'editDataSourceOption']);
        
    });

    Route::post('Admin/createDataSource', [DataSourceController::class,'createDataSource'])->name('createDataSource');
    Route::post('Admin/createDataSourceType', [DataSourceController::class,'createDataSourceType'])->name('createDataSourceType');
    Route::get('Admin/editDataSource/{id}',[DataSourceController::class,'editDataSource']);
    Route::get('Admin/editDataSourceType/{id}',[DataSourceController::class,'editDataSourceType']);
    Route::get('Participant_field/{id}',[DataSourceController::class,'getparticipantfield']);

    //Data Source
    Route::get('dashboard', [DataSourceController::class,'index'])->name('dashboard');
    Route::get('getDataSourceType/{id}',[DataSourceController::class,'getDataSourceType']);
    Route::get('getDataSourceOption/{id}',[DataSourceController::class,'getDataSourceOption']);
    Route::get('getDataSourceOptionByType/{id}',[DataSourceController::class,'getDataSourceOptionByType']);

    Route::get('getActionstepParticipantCollection/{id}', [DataSourceController::class, 'getActionstepParticipantCollection']);


    Route::get('getActionstepCollection/{id}',[DataSourceController::class,'getActionstepCollection']);
   
    
    Route::post('createResult', [DataSourceController::class,'createResult'])->name('createResult');
    Route::get('getResult', [DataSourceController::class,'getResult'])->name('getResult');
    Route::get('deleteResult/{id}', [DataSourceController::class,'deleteResult'])->name('deleteResult');

    Route::get('/upload-form', function () {
        return view('fileupload');
    });

    Route::post('/uploadfile',[DataSourceController::class,'upload'])->name('uploadfile');
    Route::post('usersdelete_dataSource/{id}', [DataSourceController::class,'delete_dataSource']);
    Route::post('usersdelete_dataSourceField/{id}', [DataSourceController::class,'delete_dataSourceField']);
    Route::post('fetch_dataSource', [DataSourceController::class,'fetch_dataSource']);

});


require __DIR__.'/auth.php';
