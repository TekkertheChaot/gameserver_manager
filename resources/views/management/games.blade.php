<?php
$games = \App\Game::all();
?>


<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<table>
    <tr>
        <th>Game ID</th>
        <th>Game Name</th>
        <th>Game Label</th>
        <th>Support RCON</th>
    </tr>
    <?php foreach($games as $game): ?>
    <tr>
        <td>{{$game->game_id}}</td>
        <td>{{$game->game_name}}</td>
        <td>{{$game->game_label}}</td>
        @if($game->support_rcon == 0)
        <td>False</td>
        @else
        <td>True</td>
        @endif
    </tr>
    <?php endforeach; ?>
</table>