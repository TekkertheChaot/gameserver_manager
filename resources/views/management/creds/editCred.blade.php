<?php
$hosts = \App\LGSMHost::all();
$creds = \App\ServerCredentials::all();
?>


<style>
</style>
<div class="form-group row">
    <label for="cred_id">Choose the Credentials to edit:<br>
        <select name="cred_id" id="cred_id_selector" onChange="">
            @foreach($creds as $cred)
            <option value="{{$cred->credential_id}}">User {{$cred->user}} for host
                {{$cred->host_id}}({{\App\LGSMHost::where('host_id', $cred->host_id)->get()[0]->ip_adress}})</option>
            @endforeach
        </select>
    </label>
</div>
<div class="form-group row">
    <label for="host_id" class="col-form-label ">Credentials for host:
        <select name="host_id" id="host_id_selector" onChange="">
            @foreach($hosts as $host)
            <option value="{{$host->host_id}}">{{$host->host_id}} ({{$host->ip_adress}})</option>
            @endforeach
        </select>
    </label>
</div>
<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

    <div class="col-md-6">
        <input id="username" type="text" class="form-control" name="username" value="" required autocomplete="username"
            autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
    </div>
</div>
<div id="submitError"></div>

<div class="float-right">
    <button id="complete" class="button" onClick="onClickSubmitEditCred(event)">Edit Credentials</button></div>

<script>
</script>