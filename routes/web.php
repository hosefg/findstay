<?php
use App\Http\Controllers\WisatawanController;
use GoogleMaps\GoogleMaps;
use App\Http\Controllers\OwnerController;

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

    return view('index');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/login-user', function () {
    return view('login_user');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/signup_traveler', function () {
    return view('signup_traveler');
});



Route::get('/login_traveler', 'WisatawanController@showLoginForm');
Route::post('post_traveler', 'WisatawanController@login');

Route::get('login_pemilik', 'OwnerController@showLoginForm');
Route::post('post_owner','OwnerController@login');


Route::get('/signup_owner', function () {
    return view('signup_owner');
});
Route::post('/signup_owner', 'OwnerController@store');

Route::get('homestay','HomestayController@index');

Route::get('/signup_homestay', function () {
    $id_owner = Auth('owner')->user()->id_owner;
    return view('signup_homestay',['id_owner' => $id_owner]);
});
Route::post('/signup_homestay', 'HomestayController@store');
Route::delete('/homestay/{homestay}', 'HomestayController@destroy');
Route::get('/homestay/{homestay}/edit','HomestayController@edit');
Route::get('/homestay/{homestay}/single','HomestayController@showHomestay');
Route::patch('/homestay/{homestay}', 'HomestayController@update');
Route::get('cari','HomestayController@search');
Route::post('book_homestay','PesananController@confirmation');
//Route::post('book_homestay/','PesananController@index');




Route::post('/signup_traveler_post', 'WisatawanController@store');






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
