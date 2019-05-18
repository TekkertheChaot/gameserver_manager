<?php 

use phpseclib\Net\SSH2;

class SSHComunicator{

    private static function getSSHSession(String $username, String $password, String $ipAdress){

        $ssh = new SSH2($ipAdress);
        if (!$ssh->login($username, $password)) {
            exit('Login Failed');
        }
        return $ssh;
    }

    public static function executeCommand(Int $serverID, String $command){
        $server = \App\Server::where('server_id', $serverID)->get()[0];
        $gamelabel = \App\Game::where('game_id', $server->game_id)->get()[0]->game_label;
        $host = \App\LGSMHost::where('host_id', $server->host_id)->get()[0];
        $credentials = \App\ServerCredentials::where('credential_id', $server->credential_id)->get()[0];
        $ssh = \SSHComunicator::getSSHSession($credentials->user, $credentials->password, $host->ip_adress);
        $toExecute = './'.$gamelabel.' '.$command;
        $ssh->setTimeout(25);
        $response = $ssh->exec($toExecute);
        \SSHComunicator::removeColorCoding($response);
        return $response;
    }

    private static function removeColorCoding(&$response){
        $startPos;
        $endPos;
        while(($startPos = strpos($response, '[')) != false){
            $endPos = strpos($response, 'm', $startPos);
            $response = substr_replace($response, '', $startPos, $endPos-$startPos+1);
        }
    }
}
?>