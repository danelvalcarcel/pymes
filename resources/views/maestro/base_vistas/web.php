<?php
 


 //Lo que debe de hacer es reemplazar Control + H 
//Suponiendo que va a crear la vista de productos
//debe de reemplazar Eps por Producto
//El nombre siempre debe de ir en singular



Route::get('/formulario_Eps/{id}/{ruta}/', 'EpsController@formulario_Eps')->name('formulario_Eps');
Route::post('/Eps_create', 'EpsController@Eps_create')->name('Eps_create');
Route::post('/Eps_update', 'EpsController@Eps_update')->name('Eps_update');
Route::get('/All_Eps', 'EpsController@All_Eps')->name('All_Eps');
Route::post('/delete_Eps/{id}', 'EpsController@delete_Eps')->name('delete_Eps');
