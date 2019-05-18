@extends('layouts.app')

@section('customHead')
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container flex-center position-ref full-height">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card card-shadow">
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
@endsection