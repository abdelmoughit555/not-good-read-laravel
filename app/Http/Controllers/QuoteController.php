<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\QuoteRequest;
use App\Http\Resources\Quote\QuoteResource;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Author $author, QuoteRequest $request)
    {
        $author->quotes()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote, Author $author)
    {
        return new QuoteResource(
            $quote->load('author')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(QuoteRequest $request, Quote $quote, Author $author)
    {
        $quote->update(
            $request->validated()
        );

        return new QuoteResource(
            $quote->fresh()->load('author')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote, Author $author)
    {
        $quote->delete();

        return 200;
    }
}
