@extends('layouts.app')

@section('customStyle')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<style>

</style>
@endsection

@section('content')
<!-- The Modal -->
<div id="siteModal" class="modal">
    <!-- Modal content -->
    <div class="modal-c">
        <div class="close" onClick="closePopup(event)">&times;</div>
        <div class="popup-card card">
            <div id="popupModal" class="modal">
                <!-- Modal content -->
                <div class="modal-c">
                    <div class="ld ld-spin-fast ld-spinner">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div id="popupDialogHeader" class="card-header">Header
            </div>
            <div id="popupDialog" class="card-body">Body</div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<div id="sb" class="sidebar">
    <div id="sbcard" class="card">
        <div id="sbcardheader" class="card-header sidebar-card-header">
            Sidebar</div>
        <div id="sbcardbody" class="sidebar-card-body">
            <div class="sidebar-card-entry" onClick="onCLickManageMenuItem(event,'users')">Users</div>
            <div class="sidebar-card-entry" onClick="onCLickManageMenuItem(event,'groups')">Groups</div>
            <div class="sidebar-card-entry" onClick="onCLickManageMenuItem(event,'servers')">Servers</div>
            <div class="sidebar-card-entry" onClick="onCLickManageMenuItem(event,'games')">Games</div>
            <div class="sidebar-card-entry" onClick="onCLickManageMenuItem(event,'hosts')">Hosts</div>
            <div class="sidebar-card-entry" onClick="onCLickManageMenuItem(event,'creds')">Log In Information</div>
            <div class="sidebar-card-entry" onClick="onCLickManageMenuItem(event,'privs')">Privileges</div>
        </div>
    </div>
</div>
<div id="cardboard-container" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="cardboard" class="card">
                <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-c">
                        <div class="ld ld-spin-fast ld-spinner">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                </div>
                <div id="cardboard-header" class="card-header">Dashboard</div>
                <div id="cardboard-body" class="card-body">

                </div>
            </div>

        </div>
    </div>
    <script>
    </script>
</div>
@endsection