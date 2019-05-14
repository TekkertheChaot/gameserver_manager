<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
require_once('./../app/SSH/SSHComunicator.php');
require_once('./../app/Privileges/PrivilegeProvider.php');

class AjaxController extends Controller
{
    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    public function getUsersPage(Request $request)
    {
        return \View::make('management/users')->render();
    }

    public function getGroupsPage(Request $request)
    {
        return \View::make('management/groups')->render();
    }

    public function getServersPage(Request $request)
    {
        return \View::make('management/servers')->render();
    }
    public function getGamesPage(Request $request)
    {
        return \View::make('management/games')->render();
    }
    public function getHostsPage(Request $request)
    {
        return \View::make('management/hosts')->render();
    }
    public function getCredsPage(Request $request)
    {
        return \View::make('management/creds')->render();
    }
    public function getAddUserDialog(Request $request)
    {
        return \View::make('management/users/addUser')->render();
    }
    public function getPrivsPage(Request $request)
    {
        return \View::make('management/privileges')->render();
    }
    public function getServerInformation(String $id, Request $request)
    {
        $username = $request->request->get('username');
        if($username != null){
            $user = \App\User::where('username', $username)->get()[0];
            $privileges = \PrivilegeProvider::getEffectivePrivilegesForUser($user->user_id);
            $privilegesForServer = \PrivilegeProvider::getPrivilegesForServerID($privileges, $id);
            return \View::make('home/serverInfo', ['id' => $id, 'privileges' => $privilegesForServer, 'pt' => $privileges])->render();
        } else {
            return 'Call could not be authorized';
        }
    }
    private function runSSHCmd(String $serverId, String $cmd)
    {
        return \SSHComunicator::executeCommand($serverId, $cmd);
    }
    public function getServerStatus(String $serverId, Request $request){
        $username = $request->request->get('username');

        if($username != null){
            $user = \App\User::where('username', $username)->get()[0];
            $privileges = \PrivilegeProvider::getEffectivePrivilegesForUser($user->user_id);
            $privilegesForServer = \PrivilegeProvider::getPrivilegesForServerID($privileges, $serverId);
            if($privilegesForServer['lgsm_status'] != 0){
                return $this->runSSHCmd($serverId, 'details');
            }
        }else{
            return 'null';
        }
    }
    public function startServer(String $serverId, Request $request){
        $username = $request->request->get('username');
        if($username != null){
            return $this->runSSHCmd($serverId, 'start');
        } else {
            return 'Call could not be authorized';
        }
    }
    public function stopServer(String $serverId, Request $request){
        $username = $request->request->get('username');
        if($username != null){
            return $this->runSSHCmd($serverId, 'stop');
        } else {
            return 'Call could not be authorized';
        }
    }
    public function restartServer(String $serverId, Request $request){
        $username = $request->request->get('username');
        if($username != null){
            return $this->runSSHCmd($serverId, 'restart');
        } else {
            return 'Call could not be authorized';
        }
    }
    public function updateServer(String $serverId, Request $request){
        $username = $request->request->get('username');
        if($username != null){
            return $this->runSSHCmd($serverId, 'update');
        } else {
            return 'Call could not be authorized';
        }
    }
    


}