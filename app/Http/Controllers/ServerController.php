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
            $user = \App\User::where('username', $username)->first();
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
            $user = \App\User::where('username', $username)->first();
            $privileges = \PrivilegeProvider::getEffectivePrivilegesForUser($user->user_id);
            $privilegesForServer = \PrivilegeProvider::getPrivilegesForServerID($privileges, $serverId);
            if($privilegesForServer['lgsm_status'] != 0){
                $response = $this->runSSHCmd($serverId, 'details');
                $this->removeColorCoding($response);
                $this->removeTPUT($response);
                $status = $this->getStatus($response);
                $maxPlayer = $this->getMaxPlayers($response);
                $internalIP= $this->getInternalIP($response);
                $serverIP= $this->getServerIP($response);
                $Tickrate= $this->getTickRate($response);
                $defaultMap= $this->getDefaultMap($response);
                $internalServerName= $this->getInternalServerName($response);
                return \View::make('home/serverStatus', [
                    'status' => $status, 
                    'maxPlayer' => $maxPlayer, 
                    'internalIP' => $internalIP,
                    'serverIP' => $serverIP,
                    'Tickrate' => $Tickrate,
                    'defaultMap' => $defaultMap,
                    'internalServerName' => $internalServerName,
                    ])->render();
                 
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
    
    private function removeColorCoding(&$response){
        $startPos;
        $endPos;
        while(($startPos = strpos($response, '[')) != false){
            $endPos = strpos($response, 'm', $startPos);
            $response = substr_replace($response, '', $startPos, $endPos-$startPos+1);
        }
		$response = str_replace("\e", '', $response);
    }

    private function removeTPUT(&$response){
        $startPos;
        $endPos;
        while(($startPos = strpos($response, 'tput')) != false){
            $endPos = strpos($response, 'specified', $startPos-1);
            $response = substr_replace($response, '', $startPos, ($endPos + strlen('specified'))-$startPos+1);
        }
    }
	
	private function getStatus(&$response){
		$startpos = strpos($response  , 'Status:');
		$endpos = strpos($response, PHP_EOL, $startpos);
		return substr($response, $startpos + strlen('Status:'), $endpos-$startpos);
    }
    
    private function getInternalServerName(&$response){
		$startpos = strpos($response  , 'Status:');
		$endpos = strpos($response, PHP_EOL, $startpos);
		return substr($response, $startpos + strlen('Status:'), $endpos-$startpos);
    }
    private function getMaxPlayers(&$response){
		$startpos = strpos($response  , 'Maxplayers:');
		$endpos = strpos($response, PHP_EOL, $startpos);
		return substr($response, $startpos + strlen('Maxplayers:'), $endpos-$startpos);
    }
    private function getServerIP(&$response){
		$startpos = strpos($response  , 'Server IP:');
		$endpos = strpos($response, PHP_EOL, $startpos);
		return substr($response, $startpos + strlen('Server IP:'), $endpos-$startpos);
    }
    private function getInternalIP(&$response){
		$startpos = strpos($response  , 'Internet IP:');
		$endpos = strpos($response, PHP_EOL, $startpos);
		return substr($response, $startpos + strlen('Internet IP:'), $endpos-$startpos);
    }
    private function getDefaultMap(&$response){
		$startpos = strpos($response  , 'Default Map:');
		$endpos = strpos($response, PHP_EOL, $startpos);
		return substr($response, $startpos + strlen('Default Map:'), $endpos-$startpos);
    }
    private function getTickRate(&$response){
		$startpos = strpos($response  , 'Tick rate:');
		$endpos = strpos($response, PHP_EOL, $startpos);
		return substr($response, $startpos + strlen('Tick rate:'), $endpos-$startpos);
	}

}