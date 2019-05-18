<?php
$groups = \App\Group::all();
$servers = \App\Server::all();
?>


<style>
</style>

<table>
    <tr class="header-row">
        <th>Groupname</th>
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
            <select name="group_id" id="group_id_selector">
                @foreach($groups as $group)
                <option value="{{$group->group_id}}">{{$group->group_name}}</option>
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
    <button id="complete" class="button" onClick="onClickSubmitAddGroupPriv(event)">Create Privilege Rule</button>
</div>

<script>
</script>