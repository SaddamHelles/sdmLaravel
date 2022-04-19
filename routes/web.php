<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormsController;
// use App\Http\Controllers\Site1Controller;
use App\Http\Controllers\Site2Controller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RelationController;


/*
Route::get('/blog/{id?}/{name?}', function($id = 0, $name = ''){
    return 'Blog Page Number :' . $id . ' Name Is: ' . $name;
})->whereNumber('id')->whereAlpha('name')->name('blog.page');



Route::get('/controllerpage', [TestController::class, 'controller'])->name('controller.page');
Route::get('/contactpage', [TestController::class, 'contact'])->name('contact.page');
Route::get('/userpage', [TestController::class, 'user'])->name('user.page');
Route::get('/productpage', [TestController::class, 'product'])->name('product.page');


Route::get('/first-name/{fname}/last-name/{lname}/id/{id}', function($fname, $lname, $id){
    return 'First Name and Last Name with your Id!';
})->name('myurl.page');

Route::get('/myurl', function(){
    return Route('myurl.page', ['Saddam', 'Hilles', '9435628734']);
});*/



// Route::prefix('/site1')->name('site1.')->group(function(){
//     Route::get('/',[Site1Controller::class, 'index'])->name('index');
//     Route::get('/about-Me',[Site1Controller::class, 'about'])->name('about');
//     Route::get('/contact-Us',[Site1Controller::class, 'contact'])->name('contact');
//     Route::get('/post',[Site1Controller::class, 'post'])->name('post');
// });

Route::prefix('/site2')->name('site2.')->controller(Site2Controller::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/portfolio', 'portfolio')->name('portfolio');
    Route::get('/contact', 'contact')->name('contact');
});

// ---------------------------------------------------------------------------------------------

Route::get('/forms', [FormsController::class, 'formsHandle'])->name('forms');
Route::post('/forms', [FormsController::class, 'form1Submit'])->name('form1.submitAction');


Route::get('/imageforms', [FormsController::class, 'formsHandleImage'])->name('formsHandleImage');
Route::post('/formsImage', [FormsController::class, 'uploadImage'])->name('form1.uploadImage');



Route::get('/mailform', [FormsController::class, 'mailform'])->name('formHandleMail');
Route::post('/formInfoMail', [FormsController::class, 'formInfo_Submit'])->name('formInfo_Submit');



Route::get('/sendemail', [FormsController::class, 'sendemail'])->name('sendemail');
Route::post('/sendemailhandle', [FormsController::class, 'sendemail_submit'])->name('sendemailHandle');


Route::get('/testemail', [FormsController::class, 'testemail'])->name('testemail');


Route::get('/roaapage', 'Site1Controller@post')->name('testroaapage');


Route::resource('/products', ProductsController::class);


Route::get('testpage/{name}/{id}', [Site2Controller::class, 'printData'])->where(['name' => '[a-z]+', 'id' => '[0-9]+']);


Route::get('/showmsg', [ProductsController::class, 'showmsg'])->name('showmsg');


Route::get('/one-to-one', [RelationController::class, 'oneToOne']);

Route::get('/', function (){
    return view('index');
});