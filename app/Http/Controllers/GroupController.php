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
    public function getAddUserDialog(Request $request)
    {
        return \View::make('management/groups/addUserToGroup')->render();
    }
    public function getDeleteUserDialog(Request $request)
    {
        return \View::make('management/groups/deleteUserFromGroup')->render();
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
                $result = array('ok' => false, 'message' => 'Group could not be created: '.$this->errorMessage);
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
                $oldGroup = \App\Group::where('group_id', $group_id)->first();
                $oldGroup->group_name = $request->request->get('group_name');
                $oldGroup->save();
                $result = array('ok' => true, 'message' => 'Group successfully changed.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Group could not be edited: '.$this->errorMessage);
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
                $result = array('ok' => false, 'message' => 'Group could not be deleted: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function addUserToGroup(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isAddUserVaild($request)){
                $newAllocation = new \App\User_Group;
                $newAllocation->user_id = $request->request->get('user_id');
                $newAllocation->group_id = $request->request->get('group_id');
                $newAllocation->save();
                $result = array('ok' => true, 'message' => 'User successfully added to group.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'User could not be added to group: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function deleteUserFromGroup(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isDeleteUserVaild($request)){
                $user_id = $request->request->get('user_id');
                $group_id = $request->request->get('group_id');
                $allocation = \App\User_Group::where([
                    ['user_id','=',$user_id],
                    ['group_id', '=',$group_id],
                ])->first();
                $allocation->delete();
                $result = array('ok' => true, 'message' => 'User successfully removed from group.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'User could not be removed from group: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    private function isAdminGroup(Request $request){
        $group_id = $request->request->get('group_id');
        $group = \App\Group::where('group_id', $group_id)->first();
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
                $this->errorMessage = 'The administrator group cannot be deleted.';
            }
        } else {
            $this->errorMessage = 'Group ID could not be fetched.';
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
                $this->errorMessage = 'Group name is empty.';
            }
        } else {
            $this->errorMessage = 'Group ID could not be fetched.';
        }
    }

    private function isAddGroupVaild(Request $request){
        $groupname = $request->request->get('group_name');
        if(\App\Group::where('group_name', $groupname)->get()[0] == null){
            if($this->isGroupNameValid($groupname)){
                return true;
            }
        } else {
            $this->errorMessage = "This group name is already taken.";
        }
        return false;
    }

    private function isGroupNameValid(String $groupname){
        if(strlen($groupname) >= 4){
            if(strlen($groupname) <= 64){
                return true;
            } else {
                $this->errorMessage = "Group name is invalid: It must have a length of 64 characters at most.";
            }
        }else {
            $this->errorMessage = "Group name is invalid: It must have a length of at least 4 characters.";
        }
        return false;
    }

    private function isAddUserVaild(Request $request){
        $group_id = $request->request->get('group_id');
        $group = \App\Group::where('group_id', $group_id)->first();
        $user_id = $request->request->get('user_id');
        $user = \App\User::where('user_id', $user_id)->first();
        if($group != null && $user != null){
            $existingAllocation = \App\User_Group::where([
                ['user_id', '=', $user_id],
                ['group_id', '=', $group_id],
            ])->first();
            if($existingAllocation == null){
                return true;
            } else {
                $this->errorMessage = 'User is already in this group';
            }
        }
        return false;
    }

    private function isDeleteUserVaild(Request $request){
        $group_id = $request->request->get('group_id');
        $group = \App\Group::where('group_id', $group_id)->first();
        $user_id = $request->request->get('user_id');
        $user = \App\User::where('user_id', $user_id)->first();
        if($group != null && $user != null){
            $existingAllocation = \App\User_Group::where([
                ['user_id', '=', $user_id],
                ['group_id', '=', $group_id],
            ])->first();
            if($existingAllocation != null){
                if($group_id == 1){
                    $anotherAdminEntry = \App\User_Group::where('group_id', 1)->get()[1];
                    if($anotherAdminEntry != null){
                        return true;
                    } else {
                        $this->errorMessage = 'Cannot remove the lonely Administrator :( .';
                    }
                } else {
                    return true;
                }
            } else {
                $this->errorMessage = 'User is not a member of this group';
            }
        }
        return false;
    }

    private function isCallAuthorized(Request $request){
        $username = $request->request->get('loggedUsername');
        return ($username != null && \App\User::where('username', $username)->get()[0] != null);
    }
}