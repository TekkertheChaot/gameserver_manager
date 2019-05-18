<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HostController extends Controller
{
    private $errorMessage;

    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    public function getAddHostDialog(Request $request)
    {
        return \View::make('management/hosts/addHost')->render();
    }
    public function getEditHostDialog(Request $request)
    {
        return \View::make('management/hosts/editHost')->render();
    }
    public function getDeleteHostDialog(Request $request)
    {
        return \View::make('management/hosts/deleteHost')->render();
    }

    public function addHost(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isAddHostVaild($request)){
                $newHost = new \App\LGSMHost;
                $newHost->ip_adress = $request->request->get('ip_adress');
                $newHost->save();
                $result = array('ok' => true, 'message' => 'Host successfully created.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Host could not be created: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function editHost(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isEditHostVaild($request)){
                $host_id = $request->request->get('host_id');
                $oldHost = \App\LGSMHost::where('host_id', $host_id)->first();
                $oldHost->ip_adress = $request->request->get('ip_adress');
                $oldHost->save();
                $result = array('ok' => true, 'message' => 'Host successfully changed.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Host could not be edit: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function deleteHost(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isDeleteHostVaild($request)){
                $host = \App\LGSMHost::find($request->request->get('host_id'));
                $host->delete();
                $result = array('ok' => true, 'message' => 'Host successfully deleted.');
                return json_encode($result);
                
            } else {
                $result = array('ok' => false, 'message' => 'Host could not be deleted: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }


    private function isDeleteHostVaild(Request $request){
        $host_id = $request->request->get('host_id');
        if($host_id != null){
            return true;
        } else {
            $this->errorMessage = 'Host ID could not be fetched.';
        }
    }

    private function isEditHostVaild(Request $request){
        $host_id = $request->request->get('host_id');
        if($host_id != null){
            $ip_adress = $request->request->get('ip_adress');
            if($ip_adress != null){
                return true;
            } else {
                $this->errorMessage = 'IP-Adress cannot be empty. TIf you want to delete a host, use the delete button.';
            }
        } else {
            $this->errorMessage = 'Host ID could not be fetched.';
        }
    }

    private function isAddHostVaild(Request $request){
        $ip_adress = $request->request->get('ip_adress');
        if($ip_adress != null){
            if(\App\LGSMHost::where('ip_adress', $ip_adress)->get()[0] == null){
                return true;
            } else {
                $this->errorMessage = "This IP-Adress is already taken.";
            }
        } else {
            $this->errorMessage = 'The IP-Adress you provided cannot be empty';
        }
        return false;
    }

    private function isCallAuthorized(Request $request){
        $username = $request->request->get('loggedUsername');
        return ($username != null && \App\User::where('username', $username)->get()[0] != null);
    }
}