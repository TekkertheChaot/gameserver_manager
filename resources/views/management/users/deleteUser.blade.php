<?php
$users = \App\User::all();
?>


<style>
</style>
<div class="form-group row">
    <label for="user_id">Choose a User to delete:<br> 
    <select name="user_id" id="user_id_selector" onChange="">
     @foreach($users as $user)
        <option value="{{$user->user_id}}">{{$user->username}}</option>
     @endforeach
     </select>
     </label>
</div>

<div id="submitError"></div>


<button id="complete" class="button" onClick="onClickSubmitDeleteUser(event)">submit</button>

<script>
</script>