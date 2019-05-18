<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
require_once('./../app/SSH/SSHComunicator.php');
require_once('./../app/Privileges/PrivilegeProvider.php');

class ServerController extends Controller
{
    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    
    public function getServerInformation(String $id, Request $request)
    {
        $username = $request->request->get('loggedUsername');
        if($this->isCallAuthorized($request)){
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
        $username = $request->request->get('loggedUsername');
        if($this->isCallAuthorized($request)){
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
        if($this->isCallAuthorized($request)){
            return $this->runSSHCmd($serverId, 'start');
        } else {
            return 'Call could not be authorized';
        }
    }
    public function stopServer(String $serverId, Request $request){
        if($this->isCallAuthorized($request)){
            return $this->runSSHCmd($serverId, 'stop');
        } else {
            return 'Call could not be authorized';
        }
    }
    public function restartServer(String $serverId, Request $request){
        if($this->isCallAuthorized($request)){
            return $this->runSSHCmd($serverId, 'restart');
        } else {
            return 'Call could not be authorized';
        }
    }
    public function updateServer(String $serverId, Request $request){
        if($this->isCallAuthorized($request)){
            return $this->runSSHCmd($serverId, 'update');
        } else {
            return 'Call could not be authorized';
        }
    }

    private function isCallAuthorized(Request $request){
        $username = $request->request->get('loggedUsername');
        return ($username != null && \App\User::where('username', $username)->get()[0] != null);
    }
    


}