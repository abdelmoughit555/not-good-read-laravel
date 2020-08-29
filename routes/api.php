<?php

//QuoteController
Route::post('/quotes/{author}', 'QuoteController@store');
Route::get('/quotes/{quote}/author/{author}', 'QuoteController@show');
Route::patch('/quotes/{quote}/author/{author}', 'QuoteController@update');
Route::delete('/quotes/{quote}/author/{author}', 'QuoteController@destroy');

//CommentController
Route::get('/comments/books/{book}', 'CommentController@index');
Route::post('/comments/books/{book}', 'CommentController@store');
Route::patch('/comments/{comment}/books/{book}', 'CommentController@update');
Route::delete('/comments/{comment}', 'CommentController@destroy');

//ReplyController
Route::get('/replies/comments/{comment}', 'ReplyController@index');
Route::post('/replies/comments/{comment}', 'ReplyController@store');
Route::patch('/replies/{reply}/comments/{comment}', 'ReplyController@update');
Route::delete('/replies/{reply}/comments/{comment}', 'ReplyController@destroy');

//bookrateController
Route::post('/books/{book}/rate', 'BookRateController@store');

//LikeController
Route::post('/likes/{id}', 'LikeController@store');

Route::apiResources([
    'books' => 'BookController',
    'authors' => 'AuthorController',
    'categories' => 'CategoryController'
]);
