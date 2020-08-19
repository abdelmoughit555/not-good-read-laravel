<?php

Route::post('/quotes/{author}', 'QuoteController@store');
Route::get('/quotes/{quote}/author/{author}', 'QuoteController@show');
Route::patch('/quotes/{quote}/author/{author}', 'QuoteController@update');
Route::delete('/quotes/{quote}/author/{author}', 'QuoteController@destroy');

Route::apiResources([
    'authors' => 'AuthorController',
    'books' => 'BookController',
]);
