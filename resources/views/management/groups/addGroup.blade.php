<?php
$groups = \App\Group::all();
?>


<style>
</style>

<div class="form-group row">
    <label for="group_name" class="col-md-4 col-form-label text-md-right">Group name</label>

    <div class="col-md-6">
        <input id="group_name" type="text" class="form-control" name="group_name"
            value="" required autocomplete="username" autofocus>
    </div>
</div>

<div id="submitError"></div>

<div class="float-right">
<button id="complete" class="button" onClick="onClickSubmitAddGroup(event)">Create group</button>
</div>
<script>
</script>