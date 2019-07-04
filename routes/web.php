<?php

Route::get('/', 'phonebookController@index');
Route::post('/phonebook', 'phonebookController@store');
Route::get('getData', 'phonebookController@getData');
