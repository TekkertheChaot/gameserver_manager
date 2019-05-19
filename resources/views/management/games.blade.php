<?php
$games = \App\Game::all();
?>


<style>
</style>

<div class="card">
    <div class="card-header">Games</div>
    <div class="card-header">
        <button id="addGame" class="button" onClick="openAddGameDialog(event)">Add Game</button>
        <button id="editGame" class="button" onClick="openEditGameDialog(event)">Edit Game</button>
        <button id="deleteGame" class="button" onClick="openDeleteGameDialog(event)">Delete Game</button>
    </div>
    <div class="card-body">
        <table>
            <tr class="header-row">
                <th>Nr. #</th>
                <th>Game Name</th>
                <th>Game Label</th>
                <th>Support RCON</th>
            </tr>
            @foreach($games as $game)
            <tr>
                <td>{{$game->game_id}}</td>
                <td>{{$game->game_name}}</td>
                <td>{{$game->game_label}}</td>
                @if($game->support_rcon == 0)
                <td><input type="checkbox" disabled></td>
                @else
                <td><input type="checkbox" checked disabled></td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
</div>