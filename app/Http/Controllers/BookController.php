<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\Book\BookResource;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(
            Book::with(['authors', 'categories'])
                ->withScopes()
                ->latest()
                ->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $book = Book::createBookWithSync($request);

        return new BookResource(
            $book->load(
                'authors',
                'categories',
                'comments'
            )
        );
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource(
            $book->load(
                'authors',
                'categories'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $book->updateBookWithSync($request);

        return new BookResource(
            $book->load(
                'authors',
                'categories'
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->authors()->detach();

        $book->categories()->detach();

        $book->delete();
    }
}
