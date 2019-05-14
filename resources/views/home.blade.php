@extends('layouts.app')

@section('customStyle')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<style>
.collapsible {
    transition: background-color 0.2s ease-out;
}

.active,
.collapsible:hover {
    background-color: rgba(0, 0, 0, .23);
    cursor: pointer;
}

.collapsible:after {
    content: '\25b6';
    font-weight: bold;
    float: left;
    padding-right: 8px;
    margin-left: 5px;
}

.active:after {
    content: '\25bc';
    display: 'inline-block';

}

.content {
    padding: 0 18px;
    display: none;
    overflow: hidden;
    background-color: #f1f1f1;
}

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

.server-card-header {
    padding-left: .5rem;
}

.server-card-body {
    padding: 5px 15px;
    max-width: 250px;
    max-height: 0;
    transition: max-height 0.2s ease-out;
    overflow: hidden;
}

.server-card-footer {
    padding: 5px 15px;
    max-width: 250px;
}


.server-icon {
    margin: 0 .2rem;
    padding: .2rem;
    height: 24px;
    width: 24px;
    float: right;
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

.icon-enabled {
    border-radius: .2rem;
    transition: background-color 0.2s ease-out;
}

.icon-enabled:hover {
    background-color: rgba(0, 0, 0, 0.2);
    cursor: pointer;
}

.icon-enabled:active {
    background-color: rgba(0, 0, 0, 0.5);
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
}

#sbcard {
    margin-bottom: 0px;
}

#btn-addCard {
    font-size: calc(.9rem - 4px);
}

#sshfield {
    width: 50%;
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
        <div id="sbcardbody" class="card-body sidebar-card-body">
            @foreach ($servers as $server)
            @foreach ($permissions as $permission)
            @if($server->server_id == $permission['server_id'])
            @if($permission['view_in_dash'] != 0 )
            <div id="server_{{$server->server_id}}" class="card">
                <div class="card-header server-card-header collapsible" onClick="onClickServer(event)">
                    {{$server->server_name}}</div>
                <div class="card-body server-card-body closedCollapsible">
                    Server name: {{$server->server_name}}<br>
                    Server label: {{$server->server_label}}<br>
                    Runs Game:
                    <?php 
                        $gameslist = \App\Game::where('game_id', $server->game_id)->get();
                        echo($gameslist[0]->game_name);
                     ?>
                </div>
            </div>
            @endif
            @endif
            @endforeach
            @endforeach
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
                    Welcome {{$currentUser->username}}
                </div>
            </div>

        </div>
    </div>
    <script>

    </script>
</div>
@endsection