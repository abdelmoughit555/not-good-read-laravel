<?php

//QuoteController
Route::post('/quotes/{author}', 'QuoteController@store');
Route::get('/quotes/{quote}/author/{author}', 'QuoteController@show');
Route::patch('/quotes/{quote}/author/{author}', 'QuoteController@update');
Route::delete('/quotes/{quote}/author/{author}', 'QuoteController@destroy');

//CommentController
Route::post('/comments/books/{book}', 'CommentController@store');
Route::patch('/comments/{comment}/books/{book}', 'CommentController@update');
Route::delete('/comments/{comment}', 'CommentController@destroy');

Route::apiResources([
    'books' => 'BookController',
    'authors' => 'AuthorController',
    'categories' => 'CategoryController'
]);
