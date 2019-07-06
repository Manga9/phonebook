<?php

Route::get('/', 'phonebookController@index');
Route::post('/phonebook', 'phonebookController@store');
Route::post('getData', 'phonebookController@getData');
Route::patch('/phonebook/{id?}', 'phonebookController@update');
