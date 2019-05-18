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
Route::post('/management/users', 'ManagementController@getUsersPage');
Route::post('/management/servers', 'ManagementController@getServersPage');
Route::post('/management/games', 'ManagementController@getGamesPage');
Route::post('/management/hosts', 'ManagementController@getHostsPage');
Route::post('/management/creds', 'ManagementController@getCredsPage');
Route::post('/management/privs', 'ManagementController@getPrivsPage');

Route::post('/management/users/addDialog', 'UserController@getAddUserDialog');
Route::post('/management/users/editDialog', 'UserController@getEditUserDialog');
Route::post('/management/users/deleteDialog', 'UserController@getDeleteUserDialog');

Route::post('/management/users/action/add', 'UserController@addUser');
Route::post('/management/users/action/edit', 'UserController@editUser');
Route::post('/management/users/action/delete', 'UserController@deleteUser');

Route::post('/management/groups/{groupName}/inspect', 'GroupController@inspectGroup');
Route::post('/management/groups/addDialog', 'GroupController@getAddGroupDialog');
Route::post('/management/groups/editDialog', 'GroupController@getEditGroupDialog');
Route::post('/management/groups/deleteDialog', 'GroupController@getDeleteGroupDialog');

Route::post('/management/groups/action/add', 'GroupController@addGroup');
Route::post('/management/groups/action/edit', 'GroupController@editGroup');
Route::post('/management/groups/action/delete', 'GroupController@deleteGroup');
Route::post('/management/groups/action/addUser', 'GroupController@addUserToGroup');
Route::post('/management/groups/action/deleteUser', 'GroupController@deleteUserFromGroup');

Route::post('/dashboard/server/{id}', 'ServerController@getServerInformation');

Route::post('/dashboard/ssh/{serverId}/status', 'ServerController@getServerStatus');
Route::post('/dashboard/ssh/{serverId}/action/start', 'ServerController@startServer');
Route::post('/dashboard/ssh/{serverId}/action/stop', 'ServerController@stopServer');
Route::post('/dashboard/ssh/{serverId}/action/restart', 'ServerController@restartServer');
Route::post('/dashboard/ssh/{serverId}/action/update', 'ServerController@updateServer');
