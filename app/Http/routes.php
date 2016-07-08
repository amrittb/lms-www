<?php

Route::auth();

Route::get('/', 'HomeController@index');

Route::resource('/books','BooksController');