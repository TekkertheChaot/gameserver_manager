<?php
$hosts = \App\LGSMHost::all();
?>

<div class="card">
    <div class="card-header">LGSM Hosts</div>
    <div class="card-header">
        <button id="addUser" class="button" onClick="openAddHostDialog(event)">Add Host</button>
        <button id="editUser" class="button" onClick="openEditHostDialog(event)">Edit Host</button>
        <button id="deleteUser" class="button" onClick="openDeleteHostDialog(event)">Delete Host</button>
    </div>
    <div class="card-body">

        <table>
            <tr class="header-row">
                <th>Nr. #</th>
                <th>IP Adress</th>
            </tr>
            @foreach($hosts as $host)
            <tr>
                <td>{{$host->host_id}}</td>
                <td>{{$host->ip_adress}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>