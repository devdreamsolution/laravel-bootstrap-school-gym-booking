<?php


Auth::routes();

Route::middleware(['auth'])->group(function () {

	Route::get('/', function(){
		return redirect()->route('contacts.index');
	});

	Route::prefix('dashboard')->group(function(){
	    Route::get('contacts', 'ContactController@index')->name('contacts.index');
	});
});
Route::post('dashboard/search', 'ContactController@search');
Route::post('dashboard/booking', 'ContactController@booking');

Route::get('admin', 'BookingController@index');
Route::post('admin/store', 'BookingController@store');
Route::get('admin/edit/{contact}', 'BookingController@edit');
Route::put('admin/update/{contact}', 'BookingController@update');
Route::delete('admin/delete/{contact}', 'BookingController@destroy');
Route::get('view/request', 'BookingController@request');