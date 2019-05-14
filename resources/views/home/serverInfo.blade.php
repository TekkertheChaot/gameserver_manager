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

<div id="status-card" class="card floating-card">
    <!-- The Modal -->
    <div id="status-modal" class="modal">

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
    <div class="card-header collapsible" onCLick="collapseCollapsible(event)">Status</div>
    <div id="status-body" class="card-body card-body-with-overflow closedCollapsible collapsant">
        @if($privileges['lgsm_status'] != 0)
        Click to retrieve Status
        <button id="doSSH" onClick="onClickGetStatus(event)">Get status</button>
        @else
        You don't have permissions to get the status of this server.
        @endif
    </div>

</div>

<div id="actions-card" class="card floating-card">
    <!-- The Modal -->
    <div id="actions-modal" class="modal">

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
    <div class="card-header collapsible" onCLick="collapseCollapsible(event)">Actions</div>
    <div id="actions-body" class="card-body card-body-with-overflow closedCollapsible collapsant">
        <div id="action-output"></div>
        
    </div>
    <div class="card-footer">
            <div id="actions">
                @if($privileges['lgsm_start'] != 0)
                <button id="doSSH" onClick="onClickStartServer(event)">Start Server</button>
                @endif
                @if($privileges['lgsm_stop'] != 0)
                <button id="doSSH" onClick="onClickStopServer(event)">Stop Server</button>
                @endif
                @if($privileges['lgsm_restart'] != 0)
                <button id="doSSH" onClick="onClickRestartServer(event)">Restart Server</button>
                @endif
                @if($privileges['lgsm_update'] != 0)
                <button id="doSSH" onClick="onClickUpdateServer(event)">Update Server</button>
                @endif</div>
        </div>

</div>