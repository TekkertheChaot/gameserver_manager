<?php
$hosts = \App\LGSMHost::all();
?>


<style>
</style>
<div class="form-group row">
    <label for="host_id">Choose a Host to delete:<br> 
    <select name="host_id" id="host_id_selector" onChange="">
     @foreach($hosts as $host)
        <option value="{{$host->host_id}}">{{$host->host_id}}: ({{$host->ip_adress}})</option>
     @endforeach
     </select>
     </label>
</div>

<div id="submitError"></div>

<div class="float-right">
<button id="complete" class="button" onClick="onClickSubmitDeleteHost(event)">Delete Host</button>
</div>

<script>
</script>