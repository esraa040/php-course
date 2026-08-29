<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::resource('/products', ProductController::class)->names('api.products');

// [
//   {
//     "id": 1,
//     "name": "Micheal Hodkiewicz DDS",
//     "description": "Sequi hic atque perspiciatis ad omnis consequuntur ut. Omnis occaecati qui aut distinctio aut. Voluptatum et nemo voluptatem cupiditate magni consequatur accusamus.",
//     "price": "36.77",
//     "quantity": 15,
//     "category_id": 4,
//     "created_at": "2026-08-25T07:11:47.000000Z",
//     "updated_at": "2026-08-25T07:11:47.000000Z"
//   },
//   {
//     "id": 2,
//     "name": "Eddie Satterfield",
//     "description": "Atque occaecati est architecto inventore culpa esse omnis. Tempore quis dolore totam omnis qui. Qui perspiciatis voluptates nulla eos voluptatem eius.",
//     "price": "84.06",
//     "quantity": 20,
//     "category_id": 7,
//     "created_at": "2026-08-25T07:11:47.000000Z",
//     "updated_at": "2026-08-25T07:11:47.000000Z"
//   },
//   {
//     "id": 3,
//     "name": "Gunnar Greenholt",
//     "description": "Ratione facilis voluptate dolore sit. Iusto sed natus ipsum ut ut et ut. Et est molestiae eius eveniet sint quod.",
//     "price": "33.57",
//     "quantity": 26,
//     "category_id": 9,
//     "created_at": "2026-08-25T07:11:47.000000Z",
//     "updated_at": "2026-08-25T07:11:47.000000Z"
//   },]
