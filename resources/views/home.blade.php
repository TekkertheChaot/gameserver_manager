@extends('layouts.app')

@section('customStyle')
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

.sidebar-card-body {
    height: 85vh;
    overflow: auto;
}

.col-md-8 {
    flex: 0 0 100%;
    max-width: 100%;

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
</style>
@endsection

@section('content')

<div id="sb" class="sidebar">
    <div id="sbcard" class="card">
        <div id="sbcardheader" class="card-header sidebar-card-header">
            Sidebar
            <button id="btn-addCard" onCLick="addCardToSidebar()">add Card</button></div>
        <div id="sbcardbody" class="card-body sidebar-card-body">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are logged in!<br>
                    <button style="font-size: 12px;" onCLick="addTimeToStatus()">add time</button>
                </div>
            </div>
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
                            You are {{Auth::user()->name}}.
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
    </script>
</div>
@endsection