<?php

class PrivilegeProvider {

    public static function getEffectivePrivilegesForUser(String $user_id){
        //get current user as db model
        $currentUser = \App\User::where('user_id', $user_id)->get()[0];

        //create effective Params
        $effectivePerms = PrivilegeProvider::initEffectiveGroupPermissions();

        //get groups permissions for each group this user is in
        $usersGroups = \App\User_Group::where('user_id', $currentUser->user_id)->get();
        foreach($usersGroups as $usersGroup){
            $usersGroupPermissions = \App\GroupPrivilege::where('group_id', $usersGroup->group_id)->get();
            PrivilegeProvider::addGroupsPermissionsToEffectivePerms($effectivePerms, $usersGroupPermissions);
        }

        //get user permissions and overwrite permissions
        $usersPermissions = \App\UserPrivilege::where('user_id', $currentUser->user_id)->get();
        PrivilegeProvider::addUsersPermissionsToEffectivePerms($effectivePerms, $usersPermissions);

        return $effectivePerms;
    }

    public static function getPrivilegesForServerID($effectivePrivileges, $serverId){
        foreach ($effectivePrivileges as $effectivePrivilege) {
            if($effectivePrivilege['server_id'] == $serverId){
                return $effectivePrivilege;
            }
        } return null;

    }
    
    private static function initEffectiveGroupPermissions(){
        return array();
    }
    private static function addGroupsPermissionsToEffectivePerms(&$effectivePerms, &$usersGroupPermissions){
        foreach($usersGroupPermissions as $usersGroupPermission){
            PrivilegeProvider::processGroupPermissionRow($effectivePerms, $usersGroupPermission);
        }
    }
    private static function processGroupPermissionRow(&$effectivePerms, &$usersGroupPermission){
        $affectingServerID = $usersGroupPermission->server_id;
        $idFound = false;
        foreach($effectivePerms as $effectivePerm){
            if($effectivePerm['server_id'] == $affectingServerID){
                $idFound = true;
                PrivilegeProvider::changeRowAccordingToPermissions($effectivePerm, $usersGroupPermission);
            }
        }
        if(!$idFound){
        PrivilegeProvider::addRowToEffectivePerms($effectivePerms, $usersGroupPermission);
        }
    }

    private static function addRowToEffectivePerms(&$effectivePerms, &$PermissionRow){
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

    private static function changeRowAccordingToPermissions(&$effectivePermRow, &$newPermRow){
        foreach($effectivePermRow as $key => $value){
            if($effectivePermRow[$key] < $newPermRow[$key]){
                $effectivePermRow[$key] = $newPermRow[$key];
            }
        }

    }

    private static function changeRowAccordingToUserPermissions(&$effectivePermRow, &$newPermRow){
        foreach($effectivePermRow as $key => $value){
            $effectivePermRow[$key] = $newPermRow[$key];
        }

    }

    private static function addUsersPermissionsToEffectivePerms(&$effectivePerms, &$userPermissions){
        foreach($userPermissions as $userPermission){
            PrivilegeProvider::processUserPermissionRow($effectivePerms, $userPermission);
        }
    }

    private static function processUserPermissionRow(&$effectivePerms, &$userPermission){
        $affectingServerID = $userPermission->server_id;
        $idFound = false;
        foreach($effectivePerms as $effectivePerm){
            if($effectivePerm['server_id'] == $affectingServerID){
                $idFound = true;
                PrivilegeProvider::changeRowAccordingToUserPermissions($effectivePerm, $userPermission);
            }
        }
        
        if(!$idFound){
            PrivilegeProvider::addRowToEffectivePerms($effectivePerms, $userPermission);
        }
    }


}