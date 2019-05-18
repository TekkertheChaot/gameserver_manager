<?php
$servers = \App\Server::all();
?>


<div class="card">
    <div class="card-header">Servers</div>
    <div class="card-header">
        <button id="addUser" class="button" onClick="openAddServerDialog(event)">Add Server</button>
        <button id="editUser" class="button" onClick="openEditServerDialog(event)">Edit Server</button>
        <button id="deleteUser" class="button" onClick="openDeleteServerDialog(event)">Delete Server</button>
    </div>
    <div class="card-body">
        <table>
            <tr class="header-row">
                <th>Nr. #</th>
                <th>Server Name</th>
                <th>Server Label</th>
                <th>Runs Game</th>
                <th>Runs on Host</th>
                <th>Uses Login-info</th>
            </tr>
            @foreach($servers as $server)
            <tr>
                <td>{{$server->server_id}}</td>
                <td>{{$server->server_name}}</td>
                <td>{{$server->server_label}}</td>
                <td>{{\App\Game::where('game_id', $server->game_id)->first()->game_name}}</td>
                <td>{{\App\LGSMHost::where('host_id', $server->host_id)->first()->ip_adress}}</td>
                <td>{{\App\ServerCredentials::where('credential_id', $server->credential_id)->first()->user}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>