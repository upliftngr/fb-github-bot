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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'ManageGitHubController@connectToGitHub');


/*
* ROUTES
* User authorization callback URL
* http://fbmsgis2.eastus.cloudapp.azure.com/gconfirm
* The full URL to redirect to after a user authorizes an installation.
*/
Route::get('/gconfirm/', function() {
    return "A required confirmation going on here";
});


/*  
*   Setup URL (optional)
*
*	http://fbmsgis2.eastus.cloudapp.azure.com/additionalsetupconfirm
* 	A URL to redirect users to after they install your GitHub App if additional setup is required on your end.
*/
Route::get('/additionalsetupconfirm/', function() {
    return "Additional Setup Confirmation Going On Here";
});


/* 
*	Webhook URL
*	http://fbmsgis2.eastus.cloudapp.azure.com/listenhook
* 	Events will POST to this URL. Read our webhook documentation for more information.
*   https://developer.github.com/webhooks/
*/
Route::get('/listenhook/', function() {
    return "This is GitHub Listening Hook";
});


/**
 * Facebook related hooks
 */
Route::get('/fbwebhook/', 'ManageMessengerController@checkWebHook');


Route::get('/webhook', 'ManageMessengerController@getWebhook');

Route::post('/webhook', 'ManageMessengerController@postWebhook');

Route::get('/messagefrombot/', function() {
    return "Hello Mind, This is Chat bot, Your Controller";
});

Route::get('/speaktobot/', function() {
    return "Hello world, I am this chat bot mind";
});


https://web.facebook.com/gituserscommunity