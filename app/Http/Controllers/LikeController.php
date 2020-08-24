<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Enums\LikeType;
use App\Http\Requests\LikeRequest;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LikeRequest $request, $id)
    {
        $this->getRecordModel($request->type, $id)
            ->like(auth()->id());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }

    /**
     * Undocumented function
     *
     * @param [type] $type
     * @param [type] $id
     * @return \Illuminate\Database\Eloquent\ModeL
     */
    protected function getRecordModel($type, $id)
    {
        return (LikeType::getValue($type))::findOrFail($id);
    }
}
