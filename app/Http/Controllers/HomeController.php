<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {      
        //get current user as db model
        $currentUser = \App\User::where('username', \Auth::user()->username)->get()[0];

        //create effective Params
        $effectivePerms = $this->initEffectiveGroupPermissions();

        //get groups permissions for each group this user is in
        $usersGroups = \App\User_Group::where('user_id', $currentUser->user_id)->get();
        foreach($usersGroups as $usersGroup){
            $usersGroupPermissions = \App\GroupPrivilege::where('group_id', $usersGroup->group_id)->get();
            $this->addGroupsPermissionsToEffectivePerms($effectivePerms, $usersGroupPermissions);
        }

        //get user permissions and overwrite permissions
        $usersPermissions = \App\UserPrivilege::where('user_id', $currentUser->user_id)->get();
        $this->addUsersPermissionsToEffectivePerms($effectivePerms, $usersPermissions);

        // give view the variables
        $servers = \App\Server::all();
        return view('home', ['currentUser' => $currentUser, 'servers' => $servers, 'permissions' => $effectivePerms]);
    }

    private function initEffectiveGroupPermissions(){
        return array();
    }
    private function addGroupsPermissionsToEffectivePerms(&$effectivePerms, &$usersGroupPermissions){
        foreach($usersGroupPermissions as $usersGroupPermission){
            $this->processGroupPermissionRow($effectivePerms, $usersGroupPermission);
        }
    }
    private function processGroupPermissionRow(&$effectivePerms, &$usersGroupPermission){
        $affectingServerID = $usersGroupPermission->server_id;
        $idFound = false;
        foreach($effectivePerms as $effectivePerm){
            if($effectivePerm['server_id'] == $affectingServerID){
                $idFound = true;
                $this->changeRowAccordingToPermissions($effectivePerm, $usersGroupPermission);
            }
        }
        if(!$idFound){
        $this->addRowToEffectivePerms($effectivePerms, $usersGroupPermission);
        }
    }

    private function addRowToEffectivePerms(&$effectivePerms, &$PermissionRow){
        $newRow = array(
            'server_id'=>$PermissionRow->server_id,
            'lgsm_start'=>$PermissionRow->lgsm_start,
            'lgsm_stop'=>$PermissionRow->lgsm_stop,
            'lgsm_restart'=>$PermissionRow->lgsm_restart,
            'lgsm_status'=>$PermissionRow->lgsm_status,
            'view_in_dash'=>$PermissionRow->view_in_dash
        );
        array_push($effectivePerms, $newRow);
    }

    private function changeRowAccordingToPermissions(&$effectivePermRow, &$newPermRow){
        foreach($effectivePermRow as $key => $value){
            if($effectivePermRow[$key] < $newPermRow[$key]){
                $effectivePermRow[$key] = $newPermRow[$key];
            }
        }

    }

    private function changeRowAccordingToUserPermissions(&$effectivePermRow, &$newPermRow){
        foreach($effectivePermRow as $key => $value){
            $effectivePermRow[$key] = $newPermRow[$key];
        }

    }

    private function addUsersPermissionsToEffectivePerms(&$effectivePerms, &$userPermissions){
        foreach($userPermissions as $userPermission){
            $this->processUserPermissionRow($effectivePerms, $userPermission);
        }
    }

    private function processUserPermissionRow(&$effectivePerms, &$userPermission){
        $affectingServerID = $userPermission->server_id;
        $idFound = false;
        foreach($effectivePerms as $effectivePerm){
            if($effectivePerm['server_id'] == $affectingServerID){
                $idFound = true;
                $this->changeRowAccordingToUserPermissions($effectivePerm, $userPermission);
            }
        }
        
        if(!$idFound){
            $this->addRowToEffectivePerms($effectivePerms, $userPermission);
        }
    }

}