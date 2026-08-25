<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

$students = [
    [
        "id" => 1,
        "name" => "leena",
        "email" => "leena@gmail.com",
    ],
    [
        "id" => 2,
        "name" => "salma",
        "email" => "salma@gmail.com",
    ],
    [
        "id" => 3,
        "name" => "login",
        "email" => "login@gmail.com",
    ],
    [
        "id" => 4,
        "name" => "mohammed",
        "email" => "mohammed@gmail.com",
    ],
];

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/students', function () use ($students) {
    // return view('allStudents',["students"=> $students]);
    return view('allStudents', compact("students"));
});


//********************* Get Single student  (task) */
Route::get('/students/{id}', function ($id) use ($students) {

    $student = collect($students)->firstWhere('id', (int) $id);

    if (!$student) {
        abort(404, "Student not found");
    }

    return view('student', compact('student'));
});

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


//========================= Day 2 : Users (Controller + Model) =========================
Route::resource('users', UserController::class);

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('order_items', OrderItemController::class);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
