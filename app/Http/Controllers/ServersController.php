<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServersController extends Controller
{
    private $errorMessage;

    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    public function getAddServerDialog(Request $request)
    {
        return \View::make('management/servers/addServer')->render();
    }
    public function getEditServerDialog(Request $request)
    {
        return \View::make('management/servers/editServer')->render();
    }
    public function getDeleteServerDialog(Request $request)
    {
        return \View::make('management/servers/deleteServer')->render();
    }
    public function addServer(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isAddServerVaild($request)){
                $newServer = new \App\Server;
                $newServer->server_name = $request->request->get('server_name');
                $newServer->server_label = $request->request->get('server_label');
                $newServer->host_id = $request->request->get('host_id');
                $newServer->game_id = $request->request->get('game_id');
                $newServer->credential_id = $request->request->get('cred_id');
                $newServer->save();
                $result = array('ok' => true, 'message' => 'Server successfully created.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Server could not be created: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function editServer(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isEditServerVaild($request)){
                $server_id = $request->request->get('server_id');
                $oldServer = \App\Server::where('server_id', $server_id)->first();
                $oldServer->server_name = $request->request->get('server_name');
                $oldServer->server_label = $request->request->get('server_label');
                $oldServer->host_id = $request->request->get('host_id');
                $oldServer->game_id = $request->request->get('game_id');
                $oldServer->credential_id = $request->request->get('cred_id');
                $oldServer->save();
                $result = array('ok' => true, 'message' => 'Server successfully changed.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Server could not be edited: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function deleteServer(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isDeleteServerVaild($request)){
                $server = \App\Server::find($request->request->get('server_id'));
                $server->delete();
                $result = array('ok' => true, 'message' => 'Server successfully deleted.');
                return json_encode($result);
                
            } else {
                $result = array('ok' => false, 'message' => 'Server could not be deleted: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    private function isDeleteServerVaild(Request $request){
        $server_id = $request->request->get('server_id');
        if($this->isServerAvailable($server_id)){
            return true;
        }
        return false;
    }

    private function isEditServerVaild(Request $request){
        $server_id = $request->request->get('server_id');
        $server_name = trim($request->request->get('server_name'));
        $server_label = trim($request->request->get('server_label'));
        $game_id = $request->request->get('game_id');
        $host_id = $request->request->get('host_id');
        $cred_id = $request->request->get('cred_id');
        if($this->isServerAvailable($server_id)){
            if($this->isGameAvailable($game_id)){
                if($this->isHostAvailable($host_id)){
                    if($this->isCredentialAvailable($cred_id)){
                        if($this->areCredentialsForHost($host_id, $cred_id)){
                            if($this->isServerNameValid($server_name)){
                                if($this->isServerLabelValid($server_label)){
                                    return true;
                                } 
                            } 
                        }
                    } 
                } 
            } 
        }
        return false;
    }

    private function isAddServerVaild(Request $request){
        $server_name = trim($request->request->get('server_name'));
        $server_label = trim($request->request->get('server_label'));
        $game_id = $request->request->get('game_id');
        $host_id = $request->request->get('host_id');
        $cred_id = $request->request->get('cred_id');
        if($this->isGameAvailable($game_id)){
            if($this->isHostAvailable($host_id)){
                if($this->isCredentialAvailable($cred_id)){
                    if($this->areCredentialsForHost($host_id, $cred_id)){
                        if($this->isServerNameValid($server_name)){
                            if($this->isServerLabelValid($server_label)){
                                return true;
                            } 
                        }
                    } 
                } 
            } 
        } 
        return false;
    }

    private function isServerNameValid($server_name){
        if($server_name != null){
            if(strlen($server_name) <= 190){
                if(strlen($server_name) >=4){
                    return true;
                } else {
                    $this->errorMessage = "The server name length must be larger than 3 characters.";
                }
            } else {
                $this->errorMessage = "The server name length must be shorter than 190 characters.";
            }
        } else {
            $this->errorMessage = "The server name must not be empty"; 
        }
    }

    private function isServerLabelValid($server_label){
        if($server_label != null){
            if(strlen($server_label) <= 190){
                if(strlen($server_label) >=4){
                    return true;
                } else {
                    $this->errorMessage = "The server label length must be larger than 3 characters.";
                }
            } else {
                $this->errorMessage = "The server label length must be shorter than 190 characters.";
            }
        } else {
            $this->errorMessage = "The server label must not be empty"; 
        }
    }

    private function isGameAvailable($game_id){
        if(\App\Game::where('game_id', $game_id)->first() != null){
            return true;
        } else {
            $this->errorMessage = "Provided game id lists no game and cannot be used."; 
        }
    }

    private function isHostAvailable($host_id){
        if(\App\LGSMHost::where('host_id', $host_id)->first() != null){
            return true;
        } else {
            $this->errorMessage = "Provided host id lists no host and cannot be used."; 
        }
    }

    private function isCredentialAvailable($cred_id){
        if(\App\ServerCredentials::where('credential_id', $cred_id)->first() != null){
            return true;
        } else {
            $this->errorMessage = "Provided credential id lists no credential information and cannot be used."; 
        }
    }

    private function isServerAvailable($server_id){
        if(\App\Server::where('server_id', $server_id)->first() != null){
            return true;
        } else {
            $this->errorMessage = "Provided server id lists no server and cannot be used."; 
        }
    }

    private function areCredentialsForHost($host_id, $cred_id){
        $hostForCred = \App\ServerCredentials::where('credential_id', $cred_id)->first();
        if($hostForCred->host_id == $host_id){
            return true;
        } else {
            $this->errorMessage = "The credentials cannot be used on this host."; 
        }
    }

    private function isCallAuthorized(Request $request){
        $username = $request->request->get('loggedUsername');
        return ($username != null && \App\User::where('username', $username)->get()[0] != null);
    }
}