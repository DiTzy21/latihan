@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product Comments</h1>
    @foreach($comments as $comment)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{$comment->user->name}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{$comment->created_at}}</h6>
            <p class="card-text">{{$comment->comment}}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection
