<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});


Auth::routes();

Route::group(['middleware'=>'auth'],function (){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/retrouverAmies','AmieController@retrouver');
    Route::get('/confirm/{id}/{token}','Auth\RegisterController@confirm');
    Route::get('/add/{id}','AmieController@envoyer');
    Route::get('/accepter/{nom}/{id}','AmieController@accepter');
    Route::get('/supprimer/{id}','AmieController@supprimer');
    Route::get('/amis','AmieController@amis');
    Route::get('/supprimerAmi/{id}','AmieController@supprimerAmi');

    Route::post('/ajouterPost','PostController@create');

    Route::get('/supprimerPost/{id}','PostController@destroy');
    Route::get('/bloquerCommentaire/{id}','PostController@bloquer');
    Route::get('/supprimerCommentaire/{id}','PostController@suppCommentaire');
    Route::get('/indexPost','PostController@index');
    Route::get('/indexAime/{id}','PostController@indexAimer');
    //Route::get('/indexAime2/{id}','PostController@indexAimer2');
    Route::get('/ajouterAime/{id}','PostController@createAime');
    //  Route::get('/ajouterAime2/{id}','PostController@createAime2');
    Route::post('/recherche','PostController@recherche');
    Route::post('/modfierContenu/{id}','PostController@modfierContenu');

    Route::post('/ajouterCommentaire/{id}','PostController@createCommentaire');
    Route::get('/indexCommentaire/{id}','PostController@indexCommentaire');

    Route::post('/saveImg','PostController@saveImg');

    Route::get('/conversation','MessageController@index');
    Route::get('/conversation/{user}','MessageController@index');
    Route::post('/conversation/{user}','MessageController@store');

    Route::get('/profile','ProfileController@index')->name('profile');
    Route::post('/imageProfile','ProfileController@update');
   // Route::post('/imageProfile','ProfileController@test');






    Route::get('/groupeAcademique/{id}', 'GroupeAcademiqueController@show')->name('groupe');
    Route::post('/ajouterPostPGA/{id}','GroupeAcademiqueController@create');
    Route::post('/saveImgPGA/{id}','GroupeAcademiqueController@saveImgPGA');
    Route::get('/indexPostPGA','GroupeAcademiqueController@index');
    Route::get('/supprimerPostPGA/{id}','GroupeAcademiqueController@destroy');
    Route::post('/modfierContenuPGA/{id}','GroupeAcademiqueController@modfierContenu');

    Route::get('/indexAimePGA/{id}','GroupeAcademiqueController@indexAimer');
    Route::get('/ajouterAimePGA/{id}','GroupeAcademiqueController@createAime');

    Route::post('/ajouterCommentairePGA/{id}','GroupeAcademiqueController@createCommentaire');
    Route::get('/indexCommentairePGA/{id}','GroupeAcademiqueController@indexCommentaire');

    Route::post('/upload/{id}','GroupeAcademiqueController@store')->name('upload');
    Route::get('/download/{id}','GroupeAcademiqueController@ss')->name('download');

    Route::get('/groupeAcademiquePhoto/{id}', 'GroupeAcademiqueController@showPhoto');
    Route::get(' /groupeAcademiqueMembre/{id}', 'GroupeAcademiqueController@showMembre');
    Route::get(' /groupeAcademiqueFichier/{id}', 'GroupeAcademiqueController@showFichier');

    Route::post('/groupe','GroupeController@store');
    Route::get('/groupe/{id}', 'GroupeController@show')->name('groupe');
    Route::post('/ajouterPostPG/{id}','GroupeController@create');
    Route::post('/saveImgPG/{id}','GroupeController@saveImgPGA');
    Route::get('/indexPostPG','GroupeController@index');
    Route::get('/supprimerPostPG/{id}','GroupeController@destroy');
    Route::post('/modfierContenuPG/{id}','GroupeController@modfierContenu');
    Route::post('/uploadd/{id}','GroupeController@storee')->name('uploadd');
    Route::get('/downloadd/{id}','GroupeController@ss')->name('downloadd');

    Route::get('/indexAimePG/{id}','GroupeController@indexAimer');
    Route::get('/ajouterAimePG/{id}','GroupeController@createAime');

    Route::post('/ajouterCommentairePG/{id}','GroupeController@createCommentaire');
    Route::get('/indexCommentairePG/{id}','GroupeController@indexCommentaire');

    Route::get('/groupePhoto/{id}', 'GroupeController@showPhoto');
    Route::get(' /groupeMembre/{id}', 'GroupeController@showMembre');
    Route::get(' /groupeFichier/{id}', 'GroupeController@showFichier');





                                                }
       );

