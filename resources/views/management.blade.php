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
    background-color: rgba(0,0,0,.15);
    cursor: pointer;
}

.sidebar-card-entry:active {
    background-color: rgba(0,0,0,.5);
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
    background-color: rgba(0,0,0,0.23);
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
</style>
@endsection

@section('content')

<div id="sb" class="sidebar">
    <div id="sbcard" class="card">
        <div id="sbcardheader" class="card-header sidebar-card-header">
            Sidebar</div>
        <div id="sbcardbody" class="sidebar-card-body">
            <div class="sidebar-card-entry" onClick="buildUserPage(event)">Users</div>
            <div class="sidebar-card-entry" onClick="buildGroupsPage(event)">Groups</div>
            <div class="sidebar-card-entry" onClick="buildServersPage(event)">Servers</div>
            <div class="sidebar-card-entry" onClick="buildGamesPage(event)">Games</div>
        </div>
    </div>
</div>
<div id="cardboard-container" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="cardboard" class="card">
                <div id="cardboard-header" class="card-header">Dashboard</div>
                <div id="cardboard-body" class="card-body">

                </div>
            </div>

        </div>
    </div>
    <script>
    var lastEvent;
    function buildUserPage(event) {
        setLastPressed(event);
        loadSiteIntoCardboard('./../resources/views/management/users.php');
    }
    function buildGroupsPage(event) {
        setLastPressed(event);
        loadSiteIntoCardboard('./../resources/views/management/groups.php');
    }
    function buildServersPage(event) {
        setLastPressed(event);
        loadSiteIntoCardboard('./../resources/views/management/servers.php');
    }
    function buildGamesPage(event) {
        setLastPressed(event);
        loadSiteIntoCardboard('./../resources/views/management/games.php');
    }

    function setLastPressed(event){
        if(lastEvent != null){
            console.log('last event exists');
            lastEvent.originalTarget.classList.toggle('selectedMenu');
        }
        lastEvent = event;
        event.originalTarget.classList.toggle('selectedMenu');
    }

    function getExampleCard() {
        return "<div class=\"card\"><div class=\"card-header\">ExampleHeader</div><div class=\"card-body\">This is a Example card</div><div class=\"card-footer\">And this is a footer</div></div>";
    }

    function hello() {
        console.log("Clicked on me");
    }

    function loadSiteIntoCardboard(url) {
        console.log("Button pressed");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cardboard-body").innerHTML = this.responseText;
            } else {
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
    }
    </script>
</div>
@endsection