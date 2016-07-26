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

    Route::get('/{copies}/issues',[
        'uses' => 'IssuesController@create',
        'as' => 'books.copies.createissue'
    ]);

    Route::post('/{copies}/issues',[
        'uses' => 'IssuesController@issue',
        'as' => 'books.copies.issue'
    ]);

    Route::post('/{copies}/issues/{issues}/return',[
        'uses' => 'IssuesController@returnBook',
        'as' => 'books.copies.issue.return'
    ]);
});

Route::resource('/users','UsersController',['except' => ['create','store']]);

Route::resource('/authors','AuthorsController',['only' => ['index','store','destroy']]);

Route::resource('/categories','BookCategoriesController',['only' => ['index','store','destroy']]);

Route::resource('/issues','IssuesController',['only' => 'index']);

Route::resource('/providers','BookProvidersController',['except' => ['create','show']]);