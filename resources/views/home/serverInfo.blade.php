<?php
$server = \App\Server::where('server_id', $id)->get()[0];
$game = \App\Game::where('game_id', $server->game_id)->get()[0];
?>

<style>
</style>


<div id="server-info" class="card floating-card">
    <div class="card-header collapsible" onClick="collapseCollapsible(event)">Server Information</div>
    <div id="serverinfo-card-body" class="card-body card-body-with-overflow closedCollapsible collapsant">
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

<div id="status-card" class="card floating-card" >
    <div class="card-header collapsible" onCLick="collapseCollapsible(event)">Status</div>
    <div id="status-body" class="card-body card-body-with-overflow closedCollapsible collapsant">
    @if($privileges['lgsm_status'] != 0)
    Click to retrieve Status
    <div id="console-footer" class="card-footer">
    <button id="doSSH" onClick="onClickGetStatus(event)">Get status</button>
    </div>
    @else 
    You don't have permissions to get the status of this server.
    @endif
    </div>
    
</div>

<div id="actions-card" class="card floating-card" >
    <div class="card-header collapsible" onCLick="collapseCollapsible(event)">Actions</div>
    <div id="status-body" class="card-body card-body-with-overflow closedCollapsible collapsant">
    @if($privileges['lgsm_start'] != 0)
    <button id="doSSH" onClick="runSSH(event)">Start Server</button>
    @endif
    @if($privileges['lgsm_stop'] != 0)
    <button id="doSSH" onClick="runSSH(event)">Stop Server</button>
    @endif
    @if($privileges['lgsm_restart'] != 0)
    <button id="doSSH" onClick="runSSH(event)">Restart Server</button>
    @endif
    @if($privileges['lgsm_update'] != 0)
    <button id="doSSH" onClick="runSSH(event)">Update Server</button>
    @endif</div>
    
</div>