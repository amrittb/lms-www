<?php

Route::auth();

Route::get('/', 'HomeController@index');

Route::resource('/books','BooksController');

Route::group(['prefix' => '/books/{books}/copies'],function() {

    Route::post('/',[
        'uses' => 'BookCopiesController@store',
        'as' => 'books.copies.store'
    ]);

    Route::delete('/{copies}',[
       'uses' => 'BookCopiesController@destroy',
        'as' => 'books.copies.destroy'
    ]);
});

Route::resource('/users','UsersController',['except' => ['create','store']]);

Route::resource('/categories','BookCategoriesController',['only' => ['index','store','destroy']]);