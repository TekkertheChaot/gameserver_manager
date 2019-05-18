<?php
$hosts = \App\LGSMHost::all();
?>


<style>
</style>
<div class="form-group row">
    <label for="host_id" class="col-form-label ">Choose a host to edit:
        <select name="host_id" id="host_id_selector" onChange="">
            @foreach($hosts as $host)
            <option value="{{$host->host_id}}">{{$host->host_id}}: ({{$host->ip_adress}})</option>
            @endforeach
        </select>
    </label>
</div>
</div>


<div class="form-group row">
    <label for="ip_adress" class="col-md-4 col-form-label text-md-right">Host's IP-Adress</label>

    <div class="col-md-6">
        <input id="ip_adress" type="text" class="form-control" name="ip_adress" value="" autofocus>
    </div>
</div>
<div id="submitError"></div>

<div class="float-right">
<button id="complete" class="button" onClick="onClickSubmitEditHost(event)">Change Host</button>
</div>

<script>
</script>