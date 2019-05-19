<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupPrivilegesController extends Controller
{
    private $errorMessage;

    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    public function getAddPrivDialog(Request $request)
    {
        return \View::make('management/privileges/group/addGroupPriv')->render();
    }
    public function getEditPrivDialog(Request $request)
    {
        return \View::make('management/privileges/group/editGroupPriv')->render();
    }
    public function getDeletePrivDialog(Request $request)
    {
        return \View::make('management/privileges/group/deleteGroupPriv')->render();
    }


    public function addPriv(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isAddPrivVaild($request)){
                $newPriv = new \App\GroupPrivilege;
                $newPriv->server_id = $request->request->get('server_id');
                $newPriv->group_id = $request->request->get('group_id');
                $newPriv->lgsm_start = $request->request->get('lgsm_start');
                $newPriv->lgsm_stop = $request->request->get('lgsm_stop');
                $newPriv->lgsm_restart = $request->request->get('lgsm_restart');
                $newPriv->lgsm_status = $request->request->get('lgsm_status');
                $newPriv->lgsm_update = $request->request->get('lgsm_update');
                $newPriv->view_in_dash = $request->request->get('view_in_dash');
                $newPriv->save();
                $result = array('ok' => true, 'message' => 'Group Rule successfully created.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Group Rule could not be created: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function editPriv(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isEditPrivVaild($request)){
                $priv_id = $request->request->get('priv_id');
                $oldPriv = \App\GroupPrivilege::where('privilege_id', $priv_id)->first();
                $oldPriv->server_id = $request->request->get('server_id');
                $oldPriv->group_id = $request->request->get('group_id');
                $oldPriv->lgsm_start = $request->request->get('lgsm_start');
                $oldPriv->lgsm_stop = $request->request->get('lgsm_stop');
                $oldPriv->lgsm_restart = $request->request->get('lgsm_restart');
                $oldPriv->lgsm_status = $request->request->get('lgsm_status');
                $oldPriv->lgsm_update = $request->request->get('lgsm_update');
                $oldPriv->view_in_dash = $request->request->get('view_in_dash');
                $oldPriv->save();
                $result = array('ok' => true, 'message' => 'Group Rule successfully changed.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Group Rule could not be edited: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function deletePriv(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isDeletePrivVaild($request)){
                $rule = \App\GroupPrivilege::find($request->request->get('priv_id'));
                $rule->delete();
                $result = array('ok' => true, 'message' => 'Group Rule successfully deleted.');
                return json_encode($result);
                
            } else {
                $result = array('ok' => false, 'message' => 'Group Rule could not be deleted: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    private function isDeletePrivVaild(Request $request){
        $priv_id = $request->request->get('priv_id');
        if($this->isPrivAvailable($priv_id)){
            return true;
        }
        return false;
    }

    private function isEditPrivVaild(Request $request){
        $group_id = $request->request->get('group_id');
        $server_id = $request->request->get('server_id');
        $priv_id = $request->request->get('priv_id');
        if($this->isGroupAvailable($group_id)){
            if($this->isServerAvailable($server_id)){
                if($this->isRulePresent($group_id, $server_id)){
                    if($this->isRuleFromExpectedID($group_id, $server_id, $priv_id)){
                        return true;
                    } else {
                        $this->errorMessage = "There is already a rule present. Edit it, or delete existing before adding the same one."; 
                    }
                } else {
                    $this->errorMessage = "There is no matching rule present and cannot edit it, but feel free to add it."; 
                }
            } 
        } 
        return false;
    }

    private function isAddPrivVaild(Request $request){
        $group_id = $request->request->get('group_id');
        $server_id = $request->request->get('server_id');
        if($this->isGroupAvailable($group_id)){
            if($this->isServerAvailable($server_id)){
                if(!$this->isRulePresent($group_id, $server_id)){
                    return true;
                } else {
                    $this->errorMessage = "There is already a rule present. Edit it, or delete existing before adding the same one."; 
                }
            } 
        } 
        return false;
    }

    private function isPrivAvailable($priv_id){
        if(\App\GroupPrivilege::where('privilege_id', $priv_id)->first() != null){
            return true;
        } else {
            $this->errorMessage = "Provided rule id lists no rule and cannot be used."; 
        }
    }

    private function isGroupAvailable($group_id){
        if(\App\Group::where('group_id', $group_id)->first() != null){
            return true;
        } else {
            $this->errorMessage = "Provided group id lists no group and cannot be used."; 
        }
    }

    private function isServerAvailable($server_id){
        if(\App\Server::where('server_id', $server_id)->first() != null){
            return true;
        } else {
            $this->errorMessage = "Provided server id lists no server and cannot be used."; 
        }
    }

    private function isRulePresent($group_id, $server_id){
        $rule = \App\GroupPrivilege::where([
            ['group_id', '=', $group_id],
            ['server_id','=',$server_id]
        ])->first();
        return $rule != null;
    }

    private function isRuleFromExpectedID($group_id, $server_id, $rule_id){
        $rule = \App\GroupPrivilege::where([
            ['group_id', '=', $group_id],
            ['server_id','=',$server_id],
            ['privilege_id', '=', $rule_id]
        ])->first();
        return $rule != null;
    }

    private function isCallAuthorized(Request $request){
        $username = $request->request->get('loggedUsername');
        return ($username != null && \App\User::where('username', $username)->get()[0] != null);
    }
}