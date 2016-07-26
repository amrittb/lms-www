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

    Route::get('/{copies}/edit',[
        'uses' => 'BookCopiesController@edit',
        'as' => 'books.copies.edit'
    ]);

    Route::patch('/{copies}',[
        'uses' => 'BookCopiesController@update',
        'as' => 'books.copies.update'
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

Route::resource('/publications','PublicationsController',['except' => ['create','show']]);

Route::resource('/authors','AuthorsController',['except' => ['create','show']]);

Route::resource('/categories','BookCategoriesController',['except' => ['create','show']]);

Route::resource('/issues','IssuesController',['only' => 'index']);

Route::resource('/providers','BookProvidersController',['except' => ['create','show']]);

Route::resource('/provisioncategories','ProvisionCategoriesController',['except' => ['create','show']]);