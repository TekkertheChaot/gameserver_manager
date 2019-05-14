@extends('layouts.app')

@section('customHead')  
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
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