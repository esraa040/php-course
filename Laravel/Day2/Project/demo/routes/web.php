<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});







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

route::get("/users",[UserController::class,'index'])->name("users.index");
route::get('/users/{id}',[UserController::class,'show'])->name('users.show');
route::delete('/users/{id}',[UserController::class,'destroy'])->name('users.destroy');


route::resource("categories",CategoryController::class); // generate all routes with route name

route::resource("products",ProductController::class);
route::resource("orders",OrderController::class);
route::resource("order_items",OrderItemController::class);



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
