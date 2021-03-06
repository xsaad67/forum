<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use App\Filters\ThreadFilters;
use Illuminate\Http\Request;

class ThreadController extends Controller
{


    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {

        $threads = $this->getThreads($channel, $filters);
        if(request()->wantsJson()){
            return $threads;
        }
        return view('threads.index',compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // dd($request->all());
        $this->validate($request,[
            'title'=>'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id',
        ]);


        $thread = new Thread();
        $thread->user_id= auth()->id();
        $thread->title = $request->title;
        $thread->body = $request->body;
        $thread->channel_id = $request->channel_id;
        $thread->save();
        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelID, Thread $thread)
    {
        
        $replies = $thread->replies()->paginate(5);
        // return $thread->replies;
        return view('threads.show',compact('thread','replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel, Thread $thread)
    {
        // if($thread->user_id != auth()->id()){

        //     abort(403,'You do not have permission');
        //     if(request()->wantsJson()){
        //         return response(['status'=>'Permission denied'],403);
        //     }

        //     return redirect('/login');
        // }

        $this->authorize('update',$thread);
        $thread->delete();
        return back();
    }


    public function getThreads(Channel $channel, $filters){

        $threads =Thread::latest()->filter($filters);
        if($channel->exists){
            $threads->where('channel_id',$channel->id);
        }
        

        $threads = $threads->get();

        return $threads;

    }
}
