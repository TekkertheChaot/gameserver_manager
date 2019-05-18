<?php
$groups = \App\Group::all();
$users = \App\User::all();
?>


<style>
</style>
<div class="form-group row">
    <label for="group_id" class="col-form-label ">Choose a group to remove user from:
        <select name="group_id" id="group_id_selector" onChange="">
            @foreach($groups as $group)
            <option value="{{$group->group_id}}">{{$group->group_name}}</option>
            @endforeach
        </select>
    </label>
</div>
<div class="form-group row">
    <label for="user_id" class="col-form-label ">Choose a user to remove:
        <select name="user_id" id="user_id_selector" onChange="">
            @foreach($users as $user)
            <option value="{{$user->user_id}}">{{$user->username}}</option>
            @endforeach
        </select>
    </label>
</div>
</div>


<div id="submitError"></div>

<div class="float-right">
<button id="complete" class="button" onClick="onClickSubmitDeleteUserFromGroup(event)">Remove from Group</button>
</div>
<script>
</script>