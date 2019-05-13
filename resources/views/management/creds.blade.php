<?php
$creds = \App\ServerCredentials::all();
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
        <th>Credential ID</th>
        <th>For Host ID</th>
        <th>Username</th>
        <th>Password</th>
    </tr>
    <?php foreach($creds as $cred): ?>
    <tr>
        <td>{{$cred->credential_id}}</td>
        <td>{{$cred->host_id}}</td>
        <td>{{$cred->user}}</td>
        <td>{{$cred->password}}</td>
    </tr>
    <?php endforeach; ?>
</table>