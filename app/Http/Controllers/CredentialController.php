<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CredentialController extends Controller
{
    private $errorMessage;

    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    public function getAddCredDialog(Request $request)
    {
        return \View::make('management/creds/addCred')->render();
    }
    public function getEditCredDialog(Request $request)
    {
        return \View::make('management/creds/editCred')->render();
    }
    public function getDeleteCredDialog(Request $request)
    {
        return \View::make('management/creds/deleteCred')->render();
    }


    public function addCred(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isAddCredVaild($request)){
                $newCred = new \App\ServerCredentials;
                $newCred->host_id = $request->request->get('host_id');
                $newCred->user = $request->request->get('username');
                $newCred->password = $request->request->get('password');
                $newCred->save();
                $result = array('ok' => true, 'message' => 'Credentials successfully created.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Credentials could not be created: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function editCred(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isEditCredVaild($request)){
                $cred_id = $request->request->get('cred_id');
                $oldCred = \App\ServerCredentials::where('credential_id', $cred_id)->first();
                $oldCred->user = $request->request->get('username');
                $oldCred->password = $request->request->get('password');
                $oldCred->host_id = $request->request->get('host_id');
                $oldCred->save();
                $result = array('ok' => true, 'message' => 'Credentials successfully changed.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Credentials could not be edited: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function deleteCred(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isDeleteCredVaild($request)){
                $cred_id = \App\ServerCredentials::find($request->request->get('cred_id'));
                $cred_id->delete();
                $result = array('ok' => true, 'message' => 'Credentials successfully deleted.');
                return json_encode($result);
                
            } else {
                $result = array('ok' => false, 'message' => 'Credentials could not be deleted: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    private function isDeleteCredVaild(Request $request){
        $cred_id = $request->request->get('cred_id');
        if($cred_id != null){
            return true;
        } else {
            $this->errorMessage = 'Cred ID could not be fetched.';
        }
    }

    private function isEditCredVaild(Request $request){
        $cred_id = $request->request->get('cred_id');
        if($cred_id != null){
            $host_id = $request->request->get('host_id');
            if($host_id != null){
                $username = $request->request->get('username');
                if($username != null){
                    $password = $request->request->get('password');
                    if($password != null){
                        return true;
                    } else {
                        $this->errorMessage = 'Password cannot be empty.';
                    }
                } else {
                    $this->errorMessage = 'Username cannot be empty.';
                }
            } else {
                $this->errorMessage = 'No host has been selected to apply credentials to.';
            }
        } else {
            $this->errorMessage = 'Credential ID could not be fetched.';
        }
    }

    private function isAddCredVaild(Request $request){
        $host_id = $request->request->get('host_id');
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        if($username != null && $password != null){
                return true;
        } else {
            $this->errorMessage = "Credentials cannot be empty. A username and a password must be set.";
        }
        return false;
    }

    private function isCallAuthorized(Request $request){
        $username = $request->request->get('loggedUsername');
        return ($username != null && \App\User::where('username', $username)->get()[0] != null);
    }
}