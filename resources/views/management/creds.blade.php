<?php
$creds = \App\ServerCredentials::all();
?>




<div class="card">
    <div class="card-header">Login Credentials</div>
    <div class="card-header">
        <button id="addUser" class="button" onClick="openAddCredDialog(event)">Add Credentials</button>
        <button id="editUser" class="button" onClick="openEditCredDialog(event)">Edit Credentials</button>
        <button id="deleteUser" class="button" onClick="openDeleteCredDialog(event)">Delete Credentials</button>
    </div>
    <div class="card-body">

        <table>
            <tr>
                <th>Nr. #</th>
                <th>For Host</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
            @foreach($creds as $cred)
            <tr>
                <td>{{$cred->credential_id}}</td>
                <td>{{$cred->host_id}} ({{\App\LGSMHost::where('host_id', $cred->host_id)->first()->ip_adress}})</td>
                <td class="password-field">{{$cred->user}}</td>
                <td class="password-field">{{$cred->password}}</td>
            </tr>
            @endforeach
        </table>
    </div>

</div>