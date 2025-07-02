<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl = new DataLayer();
        // $booksList = $dl->listBooks();
        $booksList = $dl->listBooks();
        return view('book.books')->with('books_list',$booksList);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dl = new DataLayer();
        $authorList = $dl->listAuthors();
        $categories = $dl->getAllCategories();
        return view('book.editBook')->with('authorList',$authorList)->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo "Store a newly created resource in storage";
        // abort(501);
        $selectedCategories = $request->input('categories',[]);
        $dl = new DataLayer();
        $dl->addBook($request->input('title'), $request->input('author_id'),$selectedCategories);

        return Redirect::to(route('book.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dl = new DataLayer();
        $book = $dl->findBookById($id);

        if ($book !== null) {
            return view('book.details')->with('book',$book);
        } else {
            return view('errors.wrongID')->with('message','Wrong book ID has been used!');
        }  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $authorList = $dl->listAuthors();
        $book = $dl->findBookById($id);
        $categories = $dl->getAllCategories();

        if ($book !== null) {
            return view('book.editBook')->with('authorList', $authorList)->with('book', $book)->with('categories',$categories);
        } else {
            return view('errors.wrongID')->with('message','Wrong book ID has been used!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // echo "Update the specified resource in storage";
        // abort(501);
        $selectedCategories = $request->input('categories',[]);
        $dl = new DataLayer();
        $dl->editBook($id, $request->input('title'), $request->input('author_id'),$selectedCategories);
        return Redirect::to(route('book.index'));
    }

    public function confirmDestroy($id)
    {
        $dl = new DataLayer();
        $book = $dl->findBookById($id);
        if ($book !== null) {
            return view('book.deleteBook')->with('book', $book);
        } else {
            return view('errors.wrongID')->with('message','Wrong book ID has been used!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // echo "Remove the specified resource from storage";
        // abort(501);
        $dl = new DataLayer();
        $dl->deleteBook($id);
        return Redirect::to(route('book.index'));
    }
}
