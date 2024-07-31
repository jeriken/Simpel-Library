<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponses;
use App\Models\MstBooks;

class BookController extends Controller
{
    use ApiResponses;

    public function index(): JsonResponse
    {
        //get all books
        $books = MstBooks::get();

        //return collection of books
        return $this->successResponse($books, 200);
    }

    public function show($id): JsonResponse
    {
        //find book by ID
        $book = MstBooks::find($id);

        //return single book 
        return $this->successResponse($book, 200);
    }

    public function store(BookRequest $request): JsonResponse
    {
        //create book
        $book = MstBooks::create([
            'judul'         => $request->judul,
            'penerbit'      => $request->penerbit,
            'halaman'       => $request->halaman,
            'stok'          => $request->stok,
        ]);

        //return response
        return $this->successResponse($book, 200);
    }

    public function update(BookRequest $request, $id): JsonResponse
    {
        //find book by ID
        $book = MstBooks::find($id);

        //update book with new image
        $book->update([
            'judul'         => $request->judul,
            'penerbit'      => $request->penerbit,
            'halaman'       => $request->halaman,
            'stok'          => $request->stok,
        ]);

        //return response
        return $this->successResponse($book, 200);
    }

    public function destroy($id)
    {

        //find book by ID
        $book = MstBooks::find($id);

        //delete book
        $book->delete();

        //return response
        return $this->successResponse(null, 200);
    }

}
