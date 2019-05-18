<?php
$creds = \App\ServerCredentials::all();
?>


<style>
</style>
<div class="form-group row">
    <label for="cred_id">Choose the Credentials to delete:<br>
        <select name="cred_id" id="cred_id_selector" onChange="">
            @foreach($creds as $cred)
            <option value="{{$cred->credential_id}}">User {{$cred->user}} for host
                {{$cred->host_id}}({{\App\LGSMHost::where('host_id', $cred->host_id)->get()[0]->ip_adress}})</option>
            @endforeach
        </select>
    </label>
</div>

<div id="submitError"></div>

<div class="float-right">
    <button id="complete" class="button" onClick="onClickSubmitDeleteCred(event)">Delete Credentials</button>
</div>
<script>
</script>