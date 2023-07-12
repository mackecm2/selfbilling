<?php
use Illuminate\Http\Request;
Auth::routes();
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
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::get('password/expired', 'Auth\ExpiredPasswordController@expired')
        ->name('password.expired');

Route::post('password/post_expired', 'Auth\ExpiredPasswordController@postExpired')
        ->name('password.post_expired');

Route::get('/submit', function () {
    return view('submit');
});

Route::post('/submit', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'url' => 'required|url|max:255',
        'description' => 'required|max:255',
    ]);

    $link = tap(new App\Link($data))->save();

    return redirect('/');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['password_expired'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
    });
 
    Route::get('password/expired', 'Auth\ExpiredPasswordController@expired')
        ->name('password.expired');
    Route::post('password/post_expired', 'Auth\ExpiredPasswordController@postExpired')
        ->name('password.post_expired');
});

Route::get('/showprint', 'UserController@showprint')->middleware('auth');
Route::get('/docs', 'DocumentController@index')->middleware('auth');
Route::get('/userdocs', 'UserdocController@index')->middleware('auth');
Route::post('/store', 'UserController@store')->middleware('auth');
Route::get('/showall', 'UserController@showall')->middleware('auth');
Route::get('/showapproved', 'UserController@showapproved')->middleware('auth');
Route::post('/approve', 'UserController@approve')->middleware('auth');
Route::post('/reject', 'UserController@reject')->middleware('auth');
Route::get('/uploadfile','UserdocController@uploadForm');
Route::post('/thankyou','UserdocController@uploadSubmit');
Route::post('/uploadfile','UserController@store');

Route::get('/database-test', function () {
    if ( DB::connection()->getDatabaseName() ) {
        echo 'Connected successfully to database ' . DB::connection()->getDatabaseName();
    }
});
