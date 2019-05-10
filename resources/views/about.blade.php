@extends('layouts.app')

@section('customStyle')
<style>
#console-out {
    font-family: consolas;
    border-width: 1px
    border-color: red;
    background: lightgrey;
}
</style>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">About</div>

                <div class="card-body">
                    This is Sparta!
                    <button onClick="loadDoc()">do de ding</button>
                    <div id="console-out">
                    <?php 
                        include('../app/Joking/testclass.php');

                        echo("<pre>".TestClass::doSSH()."</pre>");
                    ?>
                    <div>
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
