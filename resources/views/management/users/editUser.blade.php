<?php
$users = \App\User::all();
?>


<style>
</style>
<div class="form-group row">
    <label for="user_id" class="col-form-label">Choose a User to edit:
        <select name="user_id" id="user_id_selector" onChange="">
            @foreach($users as $user)
            <option value="{{$user->user_id}}">{{$user->username}}</option>
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
    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email">
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password">
    </div>
</div>
<div id="submitError"></div>

<div class="float-right">
<button id="complete" class="button" onClick="onClickSubmitEditUser(event)">Edit user</button>
</div>
<script>
</script>