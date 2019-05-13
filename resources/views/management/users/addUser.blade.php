<?php
$users = \App\User::all();
?>


<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,
th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

    <div class="col-md-6">
        <input id="username" type="text" class="form-control" name="username"
            value="" required autocomplete="username" autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control" name="email"
            value="" required autocomplete="email">
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control"
            name="password" required autocomplete="new-password">
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password">
    </div>
</div>


<button id="complete" class="button" onClick="hello()">submit</button>

<script>
</script>