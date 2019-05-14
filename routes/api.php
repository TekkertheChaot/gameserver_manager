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
Route::post('/management/users', 'AjaxController@getUsersPage');
Route::post('/management/groups', 'AjaxController@getGroupsPage');
Route::post('/management/servers', 'AjaxController@getServersPage');
Route::post('/management/games', 'AjaxController@getGamesPage');
Route::post('/management/hosts', 'AjaxController@getHostsPage');
Route::post('/management/creds', 'AjaxController@getCredsPage');
Route::post('/management/privs', 'AjaxController@getPrivsPage');
Route::post('/management/users/add', 'AjaxController@getAddUserDialog');
Route::post('/dashboard/server/{id}', 'AjaxController@getServerInformation');
Route::post('/dashboard/ssh/{serverId}/status', 'AjaxController@getServerStatus');
Route::post('/dashboard/ssh/{serverId}/action/start', 'AjaxController@startServer');
Route::post('/dashboard/ssh/{serverId}/action/stop', 'AjaxController@stopServer');
Route::post('/dashboard/ssh/{serverId}/action/restart', 'AjaxController@restartServer');
Route::post('/dashboard/ssh/{serverId}/action/update', 'AjaxController@updateServer');