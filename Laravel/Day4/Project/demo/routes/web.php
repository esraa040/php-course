<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\checkRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("home");







// route::get('/students',function()
// {
//   $students = [
//     [
//         "id" => 1,
//         "name" => "leena",
//         "email" => "leena@gmail.com",
//     ],
//     [
//         "id" => 2,
//         "name" => "salma",
//         "email" => "salma@gmail.com",
//     ],
//     [
//         "id" => 3,
//         "name" => "login",
//         "email" => "login@gmail.com",
//     ],
//     [
//         "id" => 4,
//         "name" => "mohammed",
//         "email" => "mohammed@gmail.com",
//     ],

// ];
// // return view('allStudents',["students"=> $students]);
// return view('allStudents',compact("students"));
// //     foreach ($students as $student) {
// //     // var_dump($student);
// //     // echo "<br> ******************************* <br>";

// //     # code...
// // }

// });


// //********************* Get Single student  (task) */
// route::get('/students/{id}',function()
// {
//       $students = [
//     [
//         "id" => 1,
//         "name" => "leena",
//         "email" => "leena@gmail.com",
//     ],
//     [
//         "id" => 2,
//         "name" => "salma",
//         "email" => "salma@gmail.com",
//     ],
//     [
//         "id" => 3,
//         "name" => "login",
//         "email" => "login@gmail.com",
//     ],
//     [
//         "id" => 4,
//         "name" => "mohammed",
//         "email" => "mohammed@gmail.com",
//     ],

// ];
//     // $student;//
//     return view('student',compact('student'));
// });

// route::get('url',action); // action ===> function  || controller

/***
 *
 * get
 * post
 * put
 * update
 * edit
 * delete
 */




//==================== Users ===============

route::get("/users", [UserController::class, 'index'])->name("users.index")->middleware(['auth','checkRole']);
// route::get('/users/{id}', [UserController::class, 'show'])->name('users.show')->middleware('auth');
// route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(checkRole::class);

Route::middleware(['auth','checkRole'])->group(function () {

    route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    route::resource("categories", CategoryController::class);
}
);

route::get('/showLogin', [AuthController::class, 'showLogin'])->name('auth.showLogin');
route::post('/login', [AuthController::class, 'login'])->name('auth.login');
// route::get('/showLogin', [AuthController::class, 'showLogin'])->name('auth.showLogin');
route::get('/showRegister', [AuthController::class, 'showRegister'])->name('auth.showRegister');
route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
route::post('/register', [AuthController::class, 'register'])->name('auth.register');
// route::resource("categories", CategoryController::class); // generate all routes with route name


// list all routes : php artisan route:list
/**                   url                                           route name                 function
 *  GET|HEAD        categories .................................... categories.index › CategoryController@index
 *  POST            categories .................................... categories.store › CategoryController@store
 *   GET|HEAD        categories/create ........................... categories.create › CategoryController@create
 *   GET|HEAD        categories/{category} ........................... categories.show › CategoryController@show
 *   PUT|PATCH       categories/{category} ....................... categories.update › CategoryController@update
 *   DELETE          categories/{category} ..................... categories.destroy › CategoryController@destroy
 *   GET|HEAD        categories/{category}/edit ...................... categories.edit › CategoryController@edit
 *                      --------------------------------
 *   GET|HEAD        users .................................................. users.index › UserController@index
 *   GET|HEAD        users/{id} ............................................... users.show › UserController@show
 *   DELETE          users/{id} ......................................... users.destroy › UserController@destroy

 *
 */


Route::middleware(['auth'])->group(function () {

    route::resource("products", ProductController::class);
    route::resource("orders", OrderController::class);
    route::resource("order_items", OrderItemController::class);

});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
