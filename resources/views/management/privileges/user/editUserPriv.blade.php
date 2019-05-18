<?php
$privs = \App\GroupPrivilege::all();
$users = \App\User::all();
$servers = \App\Server::all();
?>


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
    <tr>
        <td>
            <select name="priv_id" id="priv_id_selector">
                @foreach($privs as $priv)
                <option value="{{$priv->privilege_id}}">{{$priv->privilege_id}}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="user_id" id="user_id_selector">
                @foreach($users as $user)
                <option value="{{$user->user_id}}">{{$user->username}}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="server_id" id="server_id_selector">
                @foreach($servers as $server)
                <option value="{{$server->server_id}}">{{$server->server_name}}</option>
                @endforeach
            </select>
        </td>
        <td><input id="lgsm_start" type="checkbox"></td>
        <td><input id="lgsm_restart" type="checkbox"></td>
        <td><input id="lgsm_stop" type="checkbox"></td>
        <td><input id="lgsm_update" type="checkbox"></td>
        <td><input id="lgsm_status" type="checkbox"></td>
        <td><input id="view_in_dash" type="checkbox"></td>
    </tr>
</table>

<div class="float-right">
    <button id="complete" class="button" onClick="onClickSubmitEditUserPriv(event)">Edit Privilege Rule</button></div>

<script>
</script>