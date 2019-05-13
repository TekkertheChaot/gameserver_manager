<?php
$users = \App\User::all();
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
Currently there @if(sizeof($users) != 1) are @else is @endif {{sizeof($users)}} user @if(sizeof($users) != 1) s @endif.
<table>
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>E-Mail</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{$user->user_id}}</td>
        <td>{{$user->username}}</td>
        <td>{{$user->email}}</td>
    </tr>
    @endforeach
</table>

<button id="addUser" class="button" onClick="openAddUserDialog(event)">Add User</button>
