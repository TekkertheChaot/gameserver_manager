<?php
$server = \App\Server::where('server_id', $id)->get()[0];
$game = \App\Game::where('game_id', $server->game_id)->get()[0];
?>

<style>
.info-table {
  border: 2px;
  border-color: rgb(255,0,0);
}
td {
  border: 2px solid rgb(255,0,0);
  padding: 5px 15px;
}
</style>


<div id="server-info" class="card">
    <div id="card-header" class="card-header">Server Information</div>
    <div id="card-body" class="card-body">
    <table class="info-table">
      <tr>
        <td>Server Name:</td>
        <td>{{$server->server_name}}</td>
      </tr>
      <tr>
        <td>Server Label:</td>
        <td>{{$server->server_label}}</td>
      </tr>
      <tr>
        <td>Running Game:</td>
        <td>{{$game->game_name}} ({{$game->game_label}})</td>
      </tr>
    </table>
    </div>
</div>

<div id="console-card" class="card">
    <div class="card-header">Console</div>
    <div id="console-body" class="card-body">
    </div>
    <div id="console-footer" class="card-footer">
    <input id="cmd" type="text">
    <button id="doSSH" onClick="onClickRunSSH(event)">send SSH</button>
    </div>
</div>