<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/management/users', 'AjaxController@getUsersPage');
Route::get('/management/groups', 'AjaxController@getGroupsPage');
Route::get('/management/servers', 'AjaxController@getServersPage');
Route::get('/management/games', 'AjaxController@getGamesPage');
Route::get('/management/hosts', 'AjaxController@getHostsPage');
Route::get('/management/creds', 'AjaxController@getCredsPage');
Route::get('/management/privs', 'AjaxController@getPrivsPage');
Route::get('/management/users/add', 'AjaxController@getAddUserDialog');
Route::get('/dashboard/server/{id}', 'AjaxController@getServerInformation');
Route::get('/dashboard/ssh/{serverId}/status', 'AjaxController@getServerStatus');