<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Get all the books
        $books = Book::all();
        // Return them
        return $this->successResponse($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // Create the rules for validation
        $rules = [
            'title'       => 'required|max:255',
            'description' => 'required|max:255',
            'price'       => 'required|min:1',
            'author_id'   => 'required|min:1'
        ];

        // validate the response
        $this->validate($request, $rules);

        // Create the book (sends all the data in the request)
        $book = Book::create($request->all());

        // Send the response
        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book) {
        $book = Book::findOrFail($book);
        return $this->successResponse($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book) {

        // validation rules
        $rules = [
            'title'       => 'max:255',
            'description' => 'max:255',
            'price'       => 'min:1',
            'author_id'   => 'min:1'
        ];

        // validate
        $this->validate($request, $rules);

        $book = Book::findOrFail($book);

        // Assigns the values
        $book->fill($request->all());

        // Check to makes ure something changed
        if ($book->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // save the book
        $book->save();

        return $this->successResponse($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book) {
        $book = Book::findOrFail($book);
        $book->delete();
        // Return the book info (it's still in memory even though it's been deleted)
        $this->successResponse($book);
    }
}
