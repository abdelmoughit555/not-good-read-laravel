<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Comment;
use App\Http\Requests\ReplyRequest;
use App\Events\Reply\ReplyCreated;
use App\Http\Resources\Reply\ReplyCommentResource;

class ReplyController extends Controller
{
    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Comment $comment)
    {
        return ReplyCommentResource::collection(
            $comment->replies()->with('user')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyRequest $request, Comment $comment)
    {
        $reply = $comment->replies()->create([
            'user_id' => auth()->id(),
            'text' => $request->text
        ]);

        event(
            new ReplyCreated($reply)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(ReplyRequest $request, Reply $reply, Comment $comment)
    {
        $this->authorize('update', $reply);

        $reply->update(
            $request->validated()
        );

        return 200;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);

        $reply->delete();

        return 200;
    }
}
