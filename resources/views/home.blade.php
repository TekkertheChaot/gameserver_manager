@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
            <div class="card">
                <div class="card-header">About You</div>
                <div class="card-body">
                    You are {{Auth::user()->name}}
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
        </div>
    </div>
</div>
@endsection
