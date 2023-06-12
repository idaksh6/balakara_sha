<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

 
Route::get('/', function () {
    return view('auth/login');
});



Route::controller(AuthController::class)->group(function () {

   
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
 
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
 
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
 
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
 

    
    Route::controller(ProductController::class)->prefix('students')->group(function () {
        Route::get('dahboard', 'dashboard')->name('dashboard');
        Route::get('', 'index')->name('products');
        Route::get('add', 'add')->name('products.add');
        
        Route::post('student/lkg_add', 'saveLKG')->name('products.savelkg');

        Route::post('student/ukg_add', 'saveUKG')->name('products.saveukg');

        Route::post('student/nursery_add', 'saveNursery')->name('products.savenursery');


        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::post('edit/{id}', 'update')->name('products.update');
        Route::get('delete/{id}', 'delete')->name('products.delete');
        Route::get('/search', 'search')->name('products.search');

         Route::get('exportexcel','export')->name('products.export-excel');

         Route::get('exportpdf','exportPDF')->name('products.export-pdf');

         Route::get('nursery','viewNurseryForm')->name('nursery');

         Route::get('lkg','viewLKGForm')->name('lkg');

         Route::get('ukg','viewUKGForm')->name('ukg');


    });


    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('', 'index')->name('category');
        Route::get('add', 'add')->name('category.add');
        Route::post('save', 'save')->name('category.save');
        Route::get('edit/{id}', 'edit')->name('category.edit');
        Route::post('edit/{id}', 'update')->name('category.update');
        Route::get('delete/{id}', 'delete')->name('category.delete');



    });

    
});
