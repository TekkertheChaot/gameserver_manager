<?php
$privs = \App\GroupPrivilege::all();
?>

<style>
</style>

<div class="form-group row">
    <label for="priv_id">Choose the privilege rule to delete:<br>
        <select name="priv_id" id="priv_id_selector" onChange="">
            @foreach($privs as $priv)
            <option value="{{$priv->privilege_id}}">{{$priv->privilege_id}}</option>
            @endforeach
        </select>
    </label>
</div>

<div id="submitError"></div>

<div class="float-right">
    <button id="complete" class="button" onClick="onClickSubmitDeleteUserPriv(event)">Delete Privilege Rule</button>
</div>
<script>
</script>