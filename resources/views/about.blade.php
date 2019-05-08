@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <?php 
            require './../app/Joking/testclass.php';

            TestClass::sayHelloName(" ja lol");
            ?>
                <div class="card-header">About</div>

                <div class="card-body">
                    This is Sparta!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
