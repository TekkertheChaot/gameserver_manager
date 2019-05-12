@extends('layouts.app')

@section('customStyle')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<style>
.collapsible {
    transition: background-color 0.2s ease-out;
}

.active,
.collapsible:hover {
    background-color: rgba(0, 0, 0, .07);
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
    position: sticky;
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
    background-color: rgba(0,0,0,0.2);
    cursor: pointer;
}
.icon-enabled:active {
    background-color: rgba(0,0,0,0.5);
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
</style>
@endsection

@section('content')

<div id="sb" class="sidebar">
    <div id="sbcard" class="card">
        <div id="sbcardheader" class="card-header sidebar-card-header">
            Sidebar</div>
        <div id="sbcardbody" class="card-body sidebar-card-body">
            @foreach ($servers as $server)
            <div id="server_{{$server->server_id}}" class="card">
                <div class="card-header server-card-header collapsible" onClick="collapseCollapsible(event)">
                    {{$server->server_name}}</div>
                <div class="card-body server-card-body closedCollapsible">
                    Server name: {{$server->server_name}}<br>
                    Server label: {{$server->server_label}}<br>
                    Runs Game:
                    <?php 
                        $gameslist = \App\Game::where('game_id', $server->game_id)->get();
                        foreach ($gameslist as $game) {
                            if($game->game_id == $server->game_id){
                                echo($game->game_name);
                            }
                        }
                    ?>
                </div>
                <div class="card-footer server-card-footer">
                    <img class="server-icon start-server-icon icon-enabled"
                        src="./../resources/pics/gs_control/start-min.png" width="16" height="16" alt="Start Server">
                        <img class="server-icon start-server-icon icon-disabled"
                        src="./../resources/pics/gs_control/restart-min.png" width="16" height="16" alt="Restart Server">
                        <img class="server-icon start-server-icon icon-disabled"
                        src="./../resources/pics/gs_control/stop-min.png" width="16" height="16" alt="Stop Server">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div id="cardboard-container" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="cardboard" class="card">
                <div id="cardboard-header" class="card-header">Dashboard</div>
                <div id="cardboard-body" class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    You are logged in!

                    <div id="aboutUser" class="card">
                        <div class="card-header">About You</div>
                        <div class="card-body">
                            You are {{Auth::user()->username}}.
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Console</div>
                        <div id="console-output" class="card-body">

                        </div>
                        <div class="card-footer">
                            <input id="sshfield" type="text" name="fname">
                            <button onCLick="doSSHtest()">Execute SSH
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Links</div>
                        <div class="card-body">
                            @foreach ($links as $link)
                            <a href="{{ $link->url }}">{{ $link->title }}</a><br>
                            @endforeach
                        </div>
                        <div class="card-footer">Und das hier ist ein Footer.</div>
                    </div>
                    <div class="card">
                        <div class="card-header">Links</div>
                        <div class="card-body">
                            @foreach ($links as $link)
                            <a href="{{ $link->url }}">{{ $link->title }}</a><br>
                            @endforeach
                        </div>
                        <div class="card-footer">Und das hier ist ein Footer.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
    function addTimeToStatus() {
        console.log("adding time...");
        var aboutUser = document.getElementById("aboutUser");
        aboutUser.childNodes.forEach(function(child) {
            console.log("Got child -> " + child.className);
            if (child.className == "card-body") {
                child.innerHTML = child.innerHTML + "It is " + new Date().toLocaleTimeString() + ". ";
            }
        });
    }

    function addCardToSidebar() {
        var sbcardbody = document.getElementById("sbcardbody");
        if (sbcardbody != null) {
            sbcardbody.innerHTML = sbcardbody.innerHTML + getExampleCard();
        } else {
            console.log("sbcardbody could not be found");
            alert("failed, sbcardbody not found")
        }
    }

    function getExampleCard() {
        return "<div class=\"card\"><div class=\"card-header\">ExampleHeader</div><div class=\"card-body\">This is a Example card</div><div class=\"card-footer\">And this is a footer</div></div>";
    }

    function addCardToBoard() {
        var cardboard = document.getElementById("cardboard");
        if (cardboard != null) {
            cardboard.innerHTML = cardboard.innerHTML + getExampleCard();
        } else {
            console.log("cardboard could not be found");
            alert("failed, cardboard not found")
        }
    }

    function doSSHtest() {
        var data = document.getElementById('sshfield').value;
        console.log("Button pressed");
        var params = typeof data == 'string' ? data : Object.keys(data).map(
            function(k) {
                return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
            }
        ).join('&');
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("console-output").innerHTML = this.responseText;
                console.log(this.responseText);
            } else {
                console.log(this.status);
            }
        };
        xhttp.open("POST", "api/ssh/APItest");
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(params);
    }

    function hello() {
        console.log("Clicked on me");
    }

    function collapseCollapsible(event) {
        event.originalTarget.classList.toggle('active');
        var content = event.originalTarget.nextElementSibling;
        content.classList.toggle('closedCollapsible');
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    }
    </script>
</div>
@endsection