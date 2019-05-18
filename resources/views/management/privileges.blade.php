<?php
$userPrivs = \App\UserPrivilege::all();
$groupPrivs = \App\GroupPrivilege::all();
?>

<div class="card">
    <div class="card-header">User Privileges</div>
    <div class="card-header">
        <button id="addUserPriv" class="button" onClick="openAddUserPrivDialog(event)">Add User Privilege</button>
        <button id="editUserPriv" class="button" onClick="openEditUserPrivDialog(event)">Edit User Privilege</button>
        <button id="deleteUserOriv" class="button" onClick="openDeleteUserPrivDialog(event)">Delete User
            Privilege</button>
    </div>
    <div class="card-body">
        <table>
            <tr class="header-row">
                <th>Nr. #</th>
                <th>Username</th>
                <th>Servername</th>
                <th>Can Start</th>
                <th>Can Restart</th>
                <th>Can Stop</th>
                <th>Can Update</th>
                <th>Can get Status</th>
                <th>Can View In Dashboard</th>
            </tr>
            @foreach($userPrivs as $userPriv)
            <tr>
                <td>{{$userPriv->privilege_id}}</td>
                <td>{{\App\User::where('user_id', $userPriv->user_id)->first()->username}}</td>
                <td>{{\App\Server::where('server_id', $userPriv->server_id)->first()->server_name}}</td>
                @if($userPriv->lgsm_start == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
                @if($userPriv->lgsm_restart == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
                @if($userPriv->lgsm_stop == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
                @if($userPriv->lgsm_update == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
                @if($userPriv->lgsm_status == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
                @if($userPriv->view_in_dash == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">Group Privileges</div>
    <div class="card-header">
        <button id="addGroupPriv" class="button" onClick="openAddGroupPrivDialog(event)">Add Group Privilege</button>
        <button id="editGroupPriv" class="button" onClick="openEditGroupPrivDialog(event)">Edit Group Privilege</button>
        <button id="deleteGroupOriv" class="button" onClick="openDeleteGroupPrivDialog(event)">Delete
            GroupPrivilege</button>
    </div>
    <div class="card-body">
        <table>
            <tr class="header-row">
                <th>Nr. #</th>
                <th>Groupname</th>
                <th>Servername</th>
                <th>Can Start</th>
                <th>Can Restart</th>
                <th>Can Stop</th>
                <th>Can Update</th>
                <th>Can get Status</th>
                <th>Can View In Dashboard</th>
            </tr>
            @foreach($groupPrivs as $groupPriv)
            <tr>
                <td>{{$groupPriv->privilege_id}}</td>
                <td>{{\App\Group::where('group_id', $groupPriv->group_id)->first()->group_name}}</td>
                <td>{{\App\Server::where('server_id', $groupPriv->server_id)->first()->server_name}}</td>
                @if($groupPriv->lgsm_start == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
                @if($groupPriv->lgsm_restart == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
                @if($groupPriv->lgsm_stop == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
                @if($groupPriv->lgsm_update == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
                @if($groupPriv->lgsm_status == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
                @if($groupPriv->view_in_dash == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
</div>