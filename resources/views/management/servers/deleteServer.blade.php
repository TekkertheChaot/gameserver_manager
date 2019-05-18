<?php
$servers = \App\Server::all();
?>

<style>
</style>

<div class="form-group row">
    <label for="server_id">Choose the Server to delete:<br>
        <select name="server_id" id="server_id_selector" onChange="">
            @foreach($servers as $server)
            <option value="{{$server->server_id}}">{{$server->server_name}}</option>
            @endforeach
        </select>
    </label>
</div>

<div id="submitError"></div>

<div class="float-right">
    <button id="complete" class="button" onClick="onClickSubmitDeleteServer(event)">Delete Server</button>
</div>
<script>
</script>