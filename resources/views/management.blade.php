@extends('layouts.app')

@section('customStyle')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<style>
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
    margin-bottom: 15px;
}



.card-header {
    font-weight: bold;
}

.sidebar-card-entry:hover {
    background-color: rgba(0, 0, 0, .15);
    cursor: pointer;
}

.sidebar-card-entry:active {
    background-color: rgba(0, 0, 0, .5);
    cursor: pointer;
}

.sidebar-card-entry {
    padding: .1rem .5rem;
    margin: .1rem .25rem;
    margin-left: 5px;
    position: relative;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
    background-color: rgba(0, 0, 0, .03);
    border-bottom: 1px solid rgba(0, 0, 0, .125);
    transition: background-color 0.2s ease-out;
}

.sidebar-card-entry:after {
    height: 16px;
    float: left;
    margin-right: .5rem;
    display: inline-block;
}

.sidebar {
    overflow: hidden;
    height: 100%;
    min-width: 200px;
    z-index: 1;
    top: 0px;
    left: 0px;
    overflow-x: hidden;
    max-width: 400px;
    margin-left: 15px;
    display: inline-block;
    float: left;
}

.sidebar-card-header {}

.sidebar-card-body {
    height: 85vh;
    overflow: auto;
}


.closedCollapsible {
    padding: 0px 15px;
}

.controll-icon-enabled {}

.controll-icon-disabled {}

.col-md-8 {
    flex: 0 0 100%;
    max-width: 100%;

}

.icon-disabled {
    filter: grayscale(100%);
}

.selectedMenu {
    background-color: rgba(0, 0, 0, 0.23);
}

#cardboard {
    margin-bottom: 0px;
}

#cardboard-container {
    max-width: 100vw;
}

#cardboard-body {
    height: 85vh;
    overflow: auto;
    transition: opacity .2s ease-out;
}

#sbcard {
    margin-bottom: 0px;
}

.modal {
    display: none;
    position: absolute;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0);
    transition: background-color 0.2s ease-in-out;
}

/* Modal Content */
.modal-c {
    padding: 20px;
    margin: auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.lds-ring {
    display: inline-block;
    position: relative;
    width: 64px;
    height: 64px;
}

.lds-ring div {
    box-sizing: border-box;
    display: block;
    position: absolute;
    width: 51px;
    height: 51px;
    margin: 6px;
    border: 6px solid #dfc;
    border-radius: 50%;
    animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: #0ba3f4 transparent transparent transparent;
}

.lds-ring div:nth-child(1) {
    animation-delay: -0.45s;
}

.lds-ring div:nth-child(2) {
    animation-delay: -0.3s;
}

.lds-ring div:nth-child(3) {
    animation-delay: -0.15s;
}

@keyframes lds-ring {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
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
            <div class="sidebar-card-entry" onClick="buildMenuPage(event,'users')">Users</div>
            <div class="sidebar-card-entry" onClick="buildMenuPage(event,'groups')">Groups</div>
            <div class="sidebar-card-entry" onClick="buildMenuPage(event,'servers')">Servers</div>
            <div class="sidebar-card-entry" onClick="buildMenuPage(event,'games')">Games</div>
            <div class="sidebar-card-entry" onClick="buildMenuPage(event,'hosts')">Hosts</div>
            <div class="sidebar-card-entry" onClick="buildMenuPage(event,'creds')">Log In Information</div>
            <div class="sidebar-card-entry" onClick="buildMenuPage(event,'privs')">Privileges</div>
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