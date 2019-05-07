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
                    
                    @foreach ($links as $link)
                        <a href="{{ $link->url }}">{{ $link->title }}</a>
                    @endforeach
                </div>
                
            </div>
            <div></div>
            <div class="card">
                <div class="card-header">A new Card for you</div>

                <div class="card-body">
                    This is a new card for you to experiment with.
                </div>
                <div class="card-footer">
                Und das hier ist ein Footer.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
