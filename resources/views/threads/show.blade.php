@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
        	 
            <div class="card" style="margin-bottom:25px;">
                <div class="card-header">
                    {{$thread->title}}
                </div>

                <div class="card-body">
                    {{$thread->body}}
                </div>
            </div>


          

            @foreach($replies as $reply)
                <div class="card" style="margin-bottom:25px;">
                    <div class="card-header">
                       {{$reply->owner->name}} said {{$reply->created_at->diffForHumans()}}
                    </div>

                    <div class="card-body">
                        {{$reply->body}}
                    </div>


                </div>
                {{$replies->links()}}
            @endforeach

          
            
      
             
             @guest
                <p class="strong text-center">Please <a href="/login">login</a> to reply</p>
             @else
            <form method="POST" action="{{ url($thread->path().'/reply') }}">
                @csrf
                <textarea class="form-control" name="body" rows="5" placeholder="Have some thoughts?"></textarea>
                <button class="btn btn-primary mt-25" type="submit">Submit a reply</button>
            </form>
            @endguest


        </div>

        <div class="col-md-4">
            
            <div class="card" style="margin-bottom:25px;">
                <div class="card-header">
                    Meta Information
                </div>

                <div class="card-body">
                    This thread was published at {{ $thread->created_at->diffForHumans()}} by <a href="/threads?by={{$thread->creater->name}}">{{$thread->creater->name}}</a>.
                    and currently has {{$thread->replies_count}} {{str_plural('reply', $thread->replies_count)}}
                </div>
            </div>

        </div>
    </div>


</div>

@endsection