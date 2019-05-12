@extends('layouts.app')

@section('customStyle')
<style>

.full-height {
    height: 80vh;
}

.body {
    height: 100vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}
</style>
@endsection


@section('content')
<div class="container flex-center position-ref full-height">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">About</div>

                <div class="card-body">
                    This site was created to control Linux-game-server-insances without having to log on to the machine
                    and give credentials to other persons.<br>
                    <br>
                    Created by Christian Knecht & Jannik Neumann.
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function loadDoc() {
    console.log("Button pressed");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("console-out").innerHTML = this.responseText;
            console.log(this.responseText);
        } else {
            console.log(this.status);
        }
    };
    xhttp.open("GET", "sshtest", true);
    xhttp.send();
}
</script>
@endsection