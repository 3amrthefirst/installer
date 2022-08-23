<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\BusinessInfoController;
use App\Http\Controllers\BusinessLicenseController;
use App\Http\Controllers\workingDaysController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth routes
Route::group( ['prefix' => 'auth'] ,function (){
    //register
    Route::post('register' , [AuthController::class, 'register']);
    //login
    Route::post('login' , [AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:api'] , function () {
    // logout
    Route::get('logout' , [AuthController::class , 'logout']);
    // user
    Route::group(['prefix' => 'user'] , function (){
        // Auth user
        Route::get('/' , [UserController::class , 'user']);
        //all users
        Route::get('all' , [UserController::class , 'index']);
        //pagination
        Route::get('paginate', [UserController::class, 'paginate']);
        //user by id
        Route::get('show/{id}' , [UserController::class,'show']);
        //update
        Route::post('update/{id}' , [UserController::class,'update']);
        //update
        Route::delete('destroy/{id}' , [UserController::class,'destroy']);
        //search
        Route::post('search' , [UserController::class , 'search']);
    });

    Route::group(['prefix' => 'businessInfo'] , function(){
        // all business
        Route::get('/' , [BusinessInfoController::class, 'index']);
        // all paginate
        Route::get('/paginate' , [BusinessInfoController::class, 'indexPaginate']);
        // store
        Route::post('/create' , [BusinessInfoController::class, 'store']);
        // show by id
        Route::get('/show/{id}' , [BusinessInfoController::class, 'show']);
        //update
        Route::post('/update/{id}' , [BusinessInfoController::class, 'update']);
        //destroy
        Route::delete('/destroy/{id}' , [BusinessInfoController::class, 'destroy']);
        // search
        Route::post('/search' , [BusinessInfoController::class, 'search']);
    });

    Route::group(['prefix' => 'businessLicense'] , function(){
        // all business
        Route::get('/' , [BusinessLicenseController::class, 'index']);
        // all paginate
        Route::get('/paginate' , [BusinessLicenseController::class, 'indexPaginate']);
        // store
        Route::post('/create' , [BusinessLicenseController::class, 'store']);
        // show by id
        Route::get('/show/{id}' , [BusinessLicenseController::class, 'show']);
        //update
        Route::post('/update/{id}' , [BusinessLicenseController::class, 'update']);
        //destroy
        Route::delete('/destroy/{id}' , [BusinessLicenseController::class, 'destroy']);
        // search
        Route::post('/search' , [BusinessLicenseController::class, 'search']);
    });

    Route::group(['prefix' => 'workingDays'] , function(){
        //all records
        Route::get('/' , [workingDaysController::class , 'index']);
        // all records in paginate
        Route::get('paginate' , [workingDaysController::class , 'indexPaginate']);
        //all auth user working days
        Route::get('authUser' , [workingDaysController::class , 'indexAuthUser']);
        // all specific day  users
        Route::get('day/{id}', [workingDaysController::class , 'indexDay']);
        //all specific user days
        Route::get('user/{id}',[workingDaysController::class,'indexUser']);
        // store
        Route::post('create',[workingDaysController::class, 'store']);
        //show
        Route::get('show/{id}' , [workingDaysController::class,'show']);
        //update
        Route::post('update' , [workingDaysController::class,'update']);
        //destroy
        Route::delete('destroy/{id}',[workingDaysController::class , 'destroy']);
        //search
    });

});
