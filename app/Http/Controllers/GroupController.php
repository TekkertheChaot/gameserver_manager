<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    private $errorMessage;

    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    public function getAddGroupDialog(Request $request)
    {
        return \View::make('management/groups/addGroup')->render();
    }
    public function getEditGroupDialog(Request $request)
    {
        return \View::make('management/groups/editGroup')->render();
    }
    public function getDeleteGroupDialog(Request $request)
    {
        return \View::make('management/groups/deleteGroup')->render();
    }

    public function inspectGroup(String $groupName, Request $request){
        if($this->isCallAuthorized($request)){
            return \View::make('management/groups/inspectGroup', ['groupName' => $groupName])->render();
        } else {
            return 'Call could not be authorized';
        }
    }

    public function addGroup(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isAddGroupVaild($request)){
                $newGroup = new \App\Group;
                $newGroup->group_name = $request->request->get('group_name');
                $newGroup->save();
                $result = array('ok' => true, 'message' => 'Group successfully created.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => $errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function editGroup(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isEditGroupVaild($request)){
                $group_id = $request->request->get('group_id');
                $oldGroup = \App\Group::where('group_id', $group_id)->get()[0];
                $oldGroup->group_name = $request->request->get('group_name');
                $oldGroup->save();
                $result = array('ok' => true, 'message' => 'Group successfully changed.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => $errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function deleteGroup(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isDeleteGroupVaild($request)){
                $group = \App\Group::find($request->request->get('group_id'));
                $group->delete();
                $result = array('ok' => true, 'message' => 'Group successfully deleted.');
                return json_encode($result);
                
            } else {
                $result = array('ok' => false, 'message' => $this->$errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function addUserToGroup(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isAddUserVaild($request)){
                $group_id = $request->request->get('group_id');
                $group = \App\Group::where('group_id', $group_id)->get()[0];
                $user_id = $request->request->get('user_id');
                $user = \App\User::where('user_id', $user_id)->get()[0];
                $oldGroup->save();
                $result = array('ok' => true, 'message' => 'Group successfully changed.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => $errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    private function isAdminGroup(Request $request){
        $group_id = $request->request->get('group_id');
        $group = \App\Group::where('group_id', $group_id)->get()[0];
        if($group->group_id == 1){
            return true;
        }
        return false;
    }

    private function isDeleteGroupVaild(Request $request){
        $group_id = $request->request->get('group_id');
        if($group_id != null){
            if(!$this->isAdminGroup($request)){
                return true;
            } else {
                $this->$errorMessage = 'The administrator group cannot be deleted.';
            }
        } else {
            $this->$errorMessage = 'Group ID could not be fetched.';
        }
    }

    private function isEditGroupVaild(Request $request){
        $group_id = $request->request->get('group_id');
        if($group_id != null){
            $group_name = $request->request->get('group_name');
            if($group_name != null){
                if($this->isGroupNameValid($group_name)){
                    return true;
                }
            } else {
                $errorMessage = 'Group name is empty.';
            }
        } else {
            $errorMessage = 'Group ID could not be fetched.';
        }
    }

    private function isAddGroupVaild(Request $request){
        $groupname = $request->request->get('group_name');
        if(\App\Group::where('group_name', $groupname)->get()[0] == null){
            if($this->isGroupNameValid($groupname)){
                return true;
            }
        } else {
            $errorMessage = "This group name is already taken.";
        }
        return false;
    }

    private function isGroupNameValid(String $groupname){
        if(strlen($groupname) >= 4){
            if(strlen($groupname) <= 64){
                return true;
            } else {
                $errorMessage = "Group name is invalid: It must have a length of 64 characters at most.";
            }
        }else {
            $errorMessage = "Group name is invalid: It must have a length of at least 4 characters.";
        }
        return false;
    }

    private function isAddUserVaild(Request $request){
        $group_id = $request->request->get('group_id');
        $group = \App\Group::where('group_id', $group_id)->get()[0];
        $user_id = $request->request->get('user_id');
        $user = \App\User::where('user_id', $user_id)->get()[0];
        if($group != null && $user != null){
            $existingAllocation = \App\User_Group::where([
                ['user_id', '=', $user_id],
                ['group_id', '<>', $group_id],
            ])->get();
            if($existingAllocation = )
        }
        return false;
    }

    private function isCallAuthorized(Request $request){
        $username = $request->request->get('loggedUsername');
        return ($username != null && \App\User::where('username', $username)->get()[0] != null);
    }
}