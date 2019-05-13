<?php
$servers = \App\Server::all();
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
<table>
    <tr>
        <th>Server ID</th>
        <th>Server Name</th>
        <th>Server Label</th>
        <th>Runs Game</th>
        <th>Runs on Host</th>
        <th>Uses Login-info</th>
    </tr>
    <?php foreach($servers as $server): ?>
    <tr>
        <td>{{$server->server_id}}</td>
        <td>{{$server->server_name}}</td>
        <td>{{$server->server_label}}</td>
        <?php 
        $runningGameID = $server->game_id;
        $runningGames = \App\Game::where('game_id', $runningGameID)->get();
        ?>
        <td>{{$runningGames[0]->game_name}}</td>
        <?php 
        $runningHostID = $server->host_id;
        $runninghosts = \App\LGSMHost::where('host_id', $runningHostID)->get();
        ?>
        <td>{{$runninghosts[0]->ip_adress}}</td>
        <?php 
        $credentialID = $server->credential_id;
        $credentials = \App\ServerCredentials::where('credential_id', $credentialID)->get();
        ?>
        <td>{{$credentials[0]->user}}</td>
    </tr>
    <?php endforeach; ?>
</table>