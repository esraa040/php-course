<?php

use Illuminate\Support\Facades\Route;

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
});


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
