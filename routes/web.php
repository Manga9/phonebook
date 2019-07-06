<?php

Route::GET('/', 'phonebookController@index');
Route::POST('/phonebook', 'phonebookController@store');
Route::POST('getData', 'phonebookController@getData');
Route::PATCH('/phonebook/{id?}', 'phonebookController@update');
Route::DELETE('/phonebook/{id?}', 'phonebookController@destroy');
