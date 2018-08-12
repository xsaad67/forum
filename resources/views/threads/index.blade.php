@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	@foreach($threads as $thread)
            
            <div class="card" style="margin-bottom:25px;">
                <div class="card-header">

                    <div class="d-flex justify-content-between">    

                            <div><a href="{{$thread->path()}}">
                                {{$thread->title}} {{$thread->replies_count}}
                            </a></div>

                            @can('update',$thread)
                            <div>
                                <form method="POST" action="{{$thread->path()}}">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            @endcan

                        </div>
                    </div>

                <div class="card-body">
                    {{$thread->body}}
                </div>
            </div>

            @endforeach
        </div>
    </div>
</div>

@endsection