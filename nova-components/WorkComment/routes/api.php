<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. You're free to add
| as many additional routes to this file as your tool may require.
|
*/

 Route::get('/{id}', function (Request $request, $id) {

     if ($request->resource == 'works') {

         $comments = \App\Work::find($id)->comments;

         return $comments->map(function ($item, $key) {

             $item->right = ($item->user_id == auth()->id());
             $item->user_name = \App\User::find($item->user_id)->name;

             return $item;
         });
     }

     if ($request->resource == 'comments') {

         $comments = \App\Comment::find($id)->work->comments;

         return $comments->map(function ($item, $key) {

             $item->right = ($item->user_id == auth()->id());
             $item->user_name = \App\User::find($item->user_id)->name;

             return $item;
         });
     }

     return [];

 });
