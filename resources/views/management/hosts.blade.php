<?php
$hosts = \App\LGSMHost::all();
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
        <th>Host ID</th>
        <th>IP Adress</th>
    </tr>
    <?php foreach($hosts as $host): ?>
    <tr>
        <td>{{$host->host_id}}</td>
        <td>{{$host->ip_adress}}</td>
    </tr>
    <?php endforeach; ?>
</table>