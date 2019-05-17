<?php
$users = \App\User::all();
$groups = \App\Group::all();
$users_groups = \App\User_Group::all();
?>


<style>
</style>
<div class="card">
    <div class="card-header">Users</div>
    <div class="card-body">
      Currently there 
      @if(sizeof($users) != 1) 
      are 
      @else
      is
      @endif 
      {{sizeof($users)}} 
        @if(sizeof($users) != 1)
        users.
        @else user.
        @endif
        <table>
            <tr class="header-row">
                <th>User ID</th>
                <th>Username</th>
                <th>E-Mail</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{$user->user_id}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
            </tr>
            @endforeach
        </table>
        <button id="addUser" class="button" onClick="openAddUserDialog(event)">Add User</button>
        <button id="editUser" class="button" onClick="openEditUserDialog(event)">Edit User</button>
        <button id="deleteUser" class="button" onClick="openDeleteUserDialog(event)">Delete User</button>
    </div>
</div>

<div class="card">
    <div class="card-header">Groups</div>
    <div class="card-body">
    <div class="card floating-card">
        <div class="card-header">All groups</div>
        <div class="card-body no-padding">
            <table class="table-width-100">
                @foreach($groups as $group)
                <tr>
                    <td class="group-td" onClick="onClickInspectGroup(event)">{{$group->group_name}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="card floating-card">
        <div id="group-inspect-modal" class="modal">
            <!-- Modal content -->
            <div class="modal-c">
                <div class="ld ld-spin-fast ld-spinner">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="card-header">Members</div>
        <div id="group-inspect-body" class="card-body no-padding">
            <div class="card-body">Select a Group to inspect</div>
        </div>
    </div></div>

</div>