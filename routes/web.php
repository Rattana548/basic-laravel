<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\DB;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $user = DB::table('users')->get();
        return view('dashboard')->with('user',$user);
    })->name('dashboard');
    
    Route::get('/department/all',[DepartmentController::class,'index'])->name('department');
    Route::post('/department/add',[DepartmentController::class,'insert'])->name('adddepartment');
    Route::post('/department/update/{id}',[DepartmentController::class,'update']);
    Route::get('/department/edit/{id}',[DepartmentController::class,'edit']);
    Route::get('/department/softdelete/{id}',[DepartmentController::class,'softdelete']);
    Route::get('/department/bin',[DepartmentController::class,'bin'])->name('bin');
    Route::get('/department/restore/{id}',[DepartmentController::class,'restore']);
    Route::get('/department/delete/{id}',[DepartmentController::class,'delete']);

    Route::post('/service/add',[ServiceController::class,'insert'])->name('addservice');
    Route::get('/service/all',[ServiceController::class,'index'])->name('service');
    Route::get('/service/edit/{id}',[ServiceController::class,'edit']);
    Route::get('/service/delete/{id}',[ServiceController::class,'delete']);
    Route::post('/service/update/{id}',[ServiceController::class,'update']);



    
});
