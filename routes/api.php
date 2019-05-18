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
// MANAGEMENT - MENU
// page calls for menu sidebar entries and content
Route::post('/management/users', 'ManagementController@getUsersPage');
Route::post('/management/servers', 'ManagementController@getServersPage');
Route::post('/management/games', 'ManagementController@getGamesPage');
Route::post('/management/hosts', 'ManagementController@getHostsPage');
Route::post('/management/creds', 'ManagementController@getCredsPage');
Route::post('/management/privs', 'ManagementController@getPrivsPage');

// MANAGEMENT - USERS
// dialog calls for user manipulation
Route::post('/management/users/addDialog', 'UserController@getAddUserDialog');
Route::post('/management/users/editDialog', 'UserController@getEditUserDialog');
Route::post('/management/users/deleteDialog', 'UserController@getDeleteUserDialog');
// user manipulation calls
Route::post('/management/users/action/add', 'UserController@addUser');
Route::post('/management/users/action/edit', 'UserController@editUser');
Route::post('/management/users/action/delete', 'UserController@deleteUser');

// MANAGEMENT - GROUPS
// dialog calls for group manipulation
Route::post('/management/groups/{groupName}/inspect', 'GroupController@inspectGroup');
Route::post('/management/groups/addDialog', 'GroupController@getAddGroupDialog');
Route::post('/management/groups/editDialog', 'GroupController@getEditGroupDialog');
Route::post('/management/groups/deleteDialog', 'GroupController@getDeleteGroupDialog');
Route::post('/management/groups/addUserDialog', 'GroupController@getAddUserDialog');
Route::post('/management/groups/removeUserDialog', 'GroupController@getDeleteUserDialog');
// group manipulation calls
Route::post('/management/groups/action/add', 'GroupController@addGroup');
Route::post('/management/groups/action/edit', 'GroupController@editGroup');
Route::post('/management/groups/action/delete', 'GroupController@deleteGroup');
Route::post('/management/groups/action/addUser', 'GroupController@addUserToGroup');
Route::post('/management/groups/action/deleteUser', 'GroupController@deleteUserFromGroup');

// MANAGEMENT - HOSTS
// page calls for host manipulation
Route::post('/management/hosts/addDialog', 'HostController@getAddHostDialog');
Route::post('/management/hosts/editDialog', 'HostController@getEditHostDialog');
Route::post('/management/hosts/deleteDialog', 'HostController@getDeleteHostDialog');
// host manipulation calls
Route::post('/management/hosts/action/add', 'HostController@addHost');
Route::post('/management/hosts/action/edit', 'HostController@editHost');
Route::post('/management/hosts/action/delete', 'HostController@deleteHost');

// MANAGEMENT - CREDENTIALS
// page calls for Credential manipulation
Route::post('/management/creds/addDialog', 'CredentialController@getAddCredDialog');
Route::post('/management/creds/editDialog', 'CredentialController@getEditCredDialog');
Route::post('/management/creds/deleteDialog', 'CredentialController@getDeleteCredDialog');
// credential manipulation calls
Route::post('/management/creds/action/add', 'CredentialController@addCred');
Route::post('/management/creds/action/edit', 'CredentialController@editCred');
Route::post('/management/creds/action/delete', 'CredentialController@deleteCred');

// MANAGEMENT - GAMES
// page calls for games manipulation
Route::post('/management/games/addDialog', 'GamesController@getAddGameDialog');
Route::post('/management/games/editDialog', 'GamesController@getEditGameDialog');
Route::post('/management/games/deleteDialog', 'GamesController@getDeleteGameDialog');
// games manipulation calls
Route::post('/management/games/action/add', 'GamesController@addGame');
Route::post('/management/games/action/edit', 'GamesController@editGame');
Route::post('/management/games/action/delete', 'GamesController@deleteGame');

// MANAGEMENT - SEVRERS
// page calls for servers manipulation
Route::post('/management/servers/addDialog', 'ServersController@getAddServerDialog');
Route::post('/management/servers/editDialog', 'ServersController@getEditServerDialog');
Route::post('/management/servers/deleteDialog', 'ServersController@getDeleteServerDialog');
// servers manipulation calls
Route::post('/management/servers/action/add', 'ServersController@addServer');
Route::post('/management/servers/action/edit', 'ServersController@editServer');
Route::post('/management/servers/action/delete', 'ServersController@deleteServer');

// MANAGEMENT - USER PRIVILEGES
// page calls for user privileges manipulation
Route::post('/management/userPrivs/addDialog', 'UserPrivilegesController@getAddPrivDialog');
Route::post('/management/userPrivs/editDialog', 'UserPrivilegesController@getEditPrivDialog');
Route::post('/management/userPrivs/deleteDialog', 'UserPrivilegesController@getDeletePrivDialog');
// user privileges manipulation calls
Route::post('/management/userPrivs/action/add', 'UserPrivilegesController@addPriv');
Route::post('/management/userPrivs/action/edit', 'UserPrivilegesController@editPriv');
Route::post('/management/userPrivs/action/delete', 'UserPrivilegesController@deletePriv');

// MANAGEMENT - GROUP PRIVILEGES
// page calls for group privileges manipulation
Route::post('/management/groupPrivs/addDialog', 'GroupPrivilegesController@getAddPrivDialog');
Route::post('/management/groupPrivs/editDialog', 'GroupPrivilegesController@getEditPrivDialog');
Route::post('/management/groupPrivs/deleteDialog', 'GroupPrivilegesController@getDeletePrivDialog');
// group privileges manipulation calls
Route::post('/management/groupPrivs/action/add', 'GroupPrivilegesController@addPriv');
Route::post('/management/groupPrivs/action/edit', 'GroupPrivilegesController@editPriv');
Route::post('/management/groupPrivs/action/delete', 'GroupPrivilegesController@deletePriv');


// HOME & DASHBOARD
// page calls for specific server
Route::post('/dashboard/server/{id}', 'ServerController@getServerInformation');
// server action calls
Route::post('/dashboard/ssh/{serverId}/status', 'ServerController@getServerStatus');
Route::post('/dashboard/ssh/{serverId}/action/start', 'ServerController@startServer');
Route::post('/dashboard/ssh/{serverId}/action/stop', 'ServerController@stopServer');
Route::post('/dashboard/ssh/{serverId}/action/restart', 'ServerController@restartServer');
Route::post('/dashboard/ssh/{serverId}/action/update', 'ServerController@updateServer');

