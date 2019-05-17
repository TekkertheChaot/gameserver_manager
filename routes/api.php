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
Route::post('/management/groups/{groupName}/inspect', 'GroupsController@inspectGroup');
Route::post('/management/servers', 'AjaxController@getServersPage');
Route::post('/management/games', 'AjaxController@getGamesPage');
Route::post('/management/hosts', 'AjaxController@getHostsPage');
Route::post('/management/creds', 'AjaxController@getCredsPage');
Route::post('/management/privs', 'AjaxController@getPrivsPage');
Route::post('/management/users/addDialog', 'AjaxController@getAddUserDialog');
Route::post('/management/users/editDialog', 'AjaxController@getEditUserDialog');
Route::post('/management/users/deleteDialog', 'AjaxController@getDeleteUserDialog');
Route::post('/management/users/action/add', 'UserController@addUser');
Route::post('/management/users/action/edit', 'UserController@editUser');
Route::post('/management/users/action/delete', 'UserController@deleteUser');
Route::post('/dashboard/server/{id}', 'AjaxController@getServerInformation');
Route::post('/dashboard/ssh/{serverId}/status', 'AjaxController@getServerStatus');
Route::post('/dashboard/ssh/{serverId}/action/start', 'AjaxController@startServer');
Route::post('/dashboard/ssh/{serverId}/action/stop', 'AjaxController@stopServer');
Route::post('/dashboard/ssh/{serverId}/action/restart', 'AjaxController@restartServer');
Route::post('/dashboard/ssh/{serverId}/action/update', 'AjaxController@updateServer');