<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\UserController;
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

// ================= Chat boot routes ==========
// Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
// Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('checkRole');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

//==================== Users ===============

route::get("/users", [UserController::class, 'index'])->name("users.index")->middleware(['auth', 'checkRole']);
// route::get('/users/{id}', [UserController::class, 'show'])->name('users.show')->middleware('auth');
// route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(checkRole::class);

// Route::middleware(['auth','checkRole'])->group(function () {

//     route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
//     route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
//     route::resource("categories", CategoryController::class);
// }
// );

Route::middleware(['auth', 'checkRole'])->group(function () {
    route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    route::post('/users', [UserController::class, 'store'])->name('users.store');
    route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'checkRole'])->group(function () {
    route::resource("categories", CategoryController::class)->except(['show']);
});

Route::middleware(['auth'])->group(function () {
    route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
});

route::get('/showLogin', [AuthController::class, 'showLogin'])->name('login');
route::post('/login', [AuthController::class, 'login'])->name('auth.login');
// route::get('/showLogin', [AuthController::class, 'showLogin'])->name('auth.showLogin');
route::get('/showRegister', [AuthController::class, 'showRegister'])->name('register');
route::post('/logout', [AuthController::class, 'logout'])->name('logout');
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


Route::middleware(['auth', 'checkRole'])->group(function () {

    route::resource("products", ProductController::class)->except(['index', 'show']);
    route::resource("orders", OrderController::class);
    route::resource("order_items", OrderItemController::class);

});

Route::middleware(['auth'])->group(function () {

    route::resource("products", ProductController::class)->only(['index', 'show']);

    route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    route::post('/cart/{id}', [CartController::class, 'store'])->name('cart.store');
    route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    route::post('/cart-clear', [CartController::class, 'clear'])->name('cart.clear');

});

//==================== Payments ===============

Route::middleware(['auth', 'checkRole'])->group(function () {

    route::resource("payments", PaymentController::class);

});
