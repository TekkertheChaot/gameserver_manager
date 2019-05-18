<?php
$games = \App\Game::all();
?>

<style>
</style>

<div class="form-group row">
    <label for="game_id">Choose the Game to delete:<br>
        <select name="game_id" id="game_id_selector" onChange="">
            @foreach($games as $game)
            <option value="{{$game->game_id}}">{{$game->game_name}}</option>
            @endforeach
        </select>
    </label>
</div>

<div id="submitError"></div>

<div class="float-right">
    <button id="complete" class="button" onClick="onClickSubmitDeleteGame(event)">Delete Game</button>
</div>
<script>
</script>