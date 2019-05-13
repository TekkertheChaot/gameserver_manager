<?php
$userPrivs = \App\UserPrivilege::all();
$groupPrivs = \App\GroupPrivilege::all();
?>


<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
User Privileges
<table>
    <tr>
        <th>Username</th>
        <th>Servername</th>
        <th>Can Start</th>
        <th>Can Restart</th>
        <th>Can Stop</th>
        <th>Can Update</th>
        <th>Can get Status</th>
        <th>Can View In Dashboard</th>
    </tr>
    <?php foreach($userPrivs as $userPriv): ?>
    <tr>
        <?php 
          $user = \App\User::where('user_id', $userPriv->user_id)->get();
        ?>
        <td>{{$user[0]->username}}</td>
        <?php 
          $server = \App\Server::where('server_id', $userPriv->server_id)->get();
        ?>
        <td>{{$server[0]->server_name}}</td>
        @if($userPriv->lgsm_start == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
        @if($userPriv->lgsm_restart == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
        @if($userPriv->lgsm_stop == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
        @if($userPriv->lgsm_update == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
        @if($userPriv->lgsm_status == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
        @if($userPriv->view_in_dash == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
    </tr>
    <?php endforeach; ?>
</table>
<br>
Group Privileges
<table>
    <tr>
        <th>Groupname</th>
        <th>Servername</th>
        <th>Can Start</th>
        <th>Can Restart</th>
        <th>Can Stop</th>
        <th>Can Update</th>
        <th>Can get Status</th>
        <th>Can View In Dashboard</th>
    </tr>
    <?php foreach($groupPrivs as $groupPriv): ?>
    <tr>
        <?php 
          $group = \App\Group::where('group_id', $groupPriv->group_id)->get();
        ?>
        <td>{{$group[0]->group_name}}</td>
        <?php 
          $server = \App\Server::where('server_id', $groupPriv->server_id)->get();
        ?>
        <td>{{$server[0]->server_name}}</td>
        @if($groupPriv->lgsm_start == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
        @if($groupPriv->lgsm_restart == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
        @if($groupPriv->lgsm_stop == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
        @if($groupPriv->lgsm_update == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
        @if($groupPriv->lgsm_status == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
        @if($groupPriv->view_in_dash == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
    </tr>
    <?php endforeach; ?>
</table>