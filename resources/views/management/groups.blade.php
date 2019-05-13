<?php
$groups = \App\Group::all();
$users_groups = \App\User_Group::all();
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
        <th>Group ID</th>
        <th>Group Name</th>
    </tr>
    <?php foreach($groups as $group): ?>
    <tr>
        <td>{{$group->group_id}}</td>
        <td>{{$group->group_name}}</td>
    </tr>
    <?php endforeach; ?>
</table>