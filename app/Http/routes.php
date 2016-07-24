<?php

Route::auth();

Route::get('/', 'HomeController@index');

Route::resource('/books','BooksController');

Route::group(['prefix' => '/books/{books}/copies'],function() {

    Route::post('/',[
        'uses' => 'BookCopiesController@store',
        'as' => 'books.copies.store'
    ]);
});