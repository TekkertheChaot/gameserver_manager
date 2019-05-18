<?php
$games = \App\Game::all();
$hosts = \App\LGSMHost::all();
$creds = \App\ServerCredentials::all();
?>


<style>
</style>

<div class="form-group row">
    <label for="server_name" class="col-md-4 col-form-label text-md-right">Server Name</label>

    <div class="col-md-6">
        <input id="server_name" type="text" class="form-control" name="server_name" value="" required autocomplete="server_name"
            autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="server_label" class="col-md-4 col-form-label text-md-right">Server Label (shortname)</label>

    <div class="col-md-6">
        <input id="server_label" type="text" class="form-control" name="server_label" value="" required autocomplete="username"
            autofocus>
    </div>
</div>


<div class="form-group row">
    <label for="game_id">Choose the Game this server is running:<br>
        <select name="game_id" id="game_id_selector" onChange="">
            @foreach($games as $game)
            <option value="{{$game->game_id}}">{{$game->game_id}}: {{$game->game_name}}</option>
            @endforeach
        </select>
    </label>
</div>
<div class="form-group row">
    <label for="host_id">Choose the Host this server is running on:<br>
        <select name="host_id" id="host_id_selector" onChange="">
            @foreach($hosts as $host)
            <option value="{{$host->host_id}}">{{$host->host_id}}: {{$host->ip_adress}}</option>
            @endforeach
        </select>
    </label>
</div>
<div class="form-group row">
    <label for="cred_id">Choose the Credentials for this server:<br>
        <select name="cred_id" id="cred_id_selector" onChange="">
            @foreach($creds as $cred)
            <option value="{{$cred->credential_id}}">{{$cred->credential_id}}: {{$cred->user}}</option>
            @endforeach
        </select>
    </label>
</div>

<div class="float-right">
    <button id="complete" class="button" onClick="onClickSubmitAddServer(event)">Create Server</button>
</div>

<script>
</script>