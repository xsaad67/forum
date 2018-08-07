@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	 
            <div class="card" style="margin-bottom:25px;">
                <div class="card-header">
                    {{$thread->title}}
                </div>

                <div class="card-body">
                    {{$thread->body}}
                </div>
            </div>

        </div>
    </div>

     <div class="row justify-content-center">
        <div class="col-md-8">
             
            @foreach($thread->replies as $reply)
            <div class="card" style="margin-bottom:25px;">
                <div class="card-header">
                   {{$reply->owner->name}} said {{$reply->created_at->diffForHumans()}}
                </div>

                <div class="card-body">
                    {{$reply->body}}
                </div>
            </div>
            @endforeach

        </div>
    </div>

     <div class="row justify-content-center">
        <div class="col-md-8">
             
             @guest
                <p class="strong text-center">Please <a href="/login">login</a> to reply</p>
             @else
            <form method="POST" action="/thread/{{$thread->id}}/reply">
                @csrf
                <textarea class="form-control" name="body" rows="5" placeholder="Have some thoughts?"></textarea>
                <button class="btn btn-primary mt-25" type="submit">Submit a reply</button>
            </form>
            @endguest

        </div>
    </div>

</div>

@endsection