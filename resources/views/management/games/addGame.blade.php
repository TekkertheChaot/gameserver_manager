<?php
?>


<style>
</style>
<div class="form-group row">
    <label for="game_name" class="col-md-4 col-form-label text-md-right">Game Name</label>

    <div class="col-md-6">
        <input id="game_name" type="text" class="form-control" name="game_name" value="" required autocomplete="username"
            autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="game_label" class="col-md-4 col-form-label text-md-right">Game Label (LGSM-Label)</label>

    <div class="col-md-6">
        <input id="game_label" type="text" class="form-control" name="game_label" value="" required autocomplete="username"
            autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="support_rcon" class="col-md-4 col-form-label text-md-right">RCON Support</label>

    <div class="col-md-6">
        <input id="support_rcon" type="checkbox" class="form-control" name="support_rcon" value=""autofocus>
    </div>
</div>

<div class="float-right">
    <button id="complete" class="button" onClick="onClickSubmitAddGame(event)">Create Game</button>
</div>

<script>
</script>