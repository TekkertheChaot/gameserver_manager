<?php
$groups = \App\Group::all();
$users = \App\Users::all();
?>


<style>
</style>
<div class="form-group row">
    <label for="group_id" class="col-form-label ">Choose a group to add user into:
        <select name="group_id" id="group_id_selector" onChange="">
            @foreach($groups as $group)
            <option value="{{$group->group_id}}">{{$group->group_name}}</option>
            @endforeach
        </select>
    </label>
    <label for="user_id" class="col-form-label ">Choose a user to add:
        <select name="user_id" id="user_id_selector" onChange="">
            @foreach($users as $user)
            <option value="{{$user->user_id}}">{{$user->username}}</option>
            @endforeach
        </select>
    </label>
</div>
</div>


<div class="form-group row">
    <label for="group_name" class="col-md-4 col-form-label text-md-right">Group name</label>

    <div class="col-md-6">
        <input id="group_name" type="text" class="form-control" name="group_name" value="" required
            autocomplete="username" autofocus>
    </div>
</div>
<div id="submitError"></div>

<div class="float-right">
<button id="complete" class="button" onClick="onClickSubmitAddUserToGroup(event)">Add to Group</button>
</div>
<script>
</script>