<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    public function index()
    {
        // view with the list of books
        // GET method (path "/book")
        // root name: book.index


        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $userID = $dl->getUserID($_SESSION["loggedName"]);
        $books_list = $dl->listBooks($userID);
        return view('book.booksBootstrap')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])
            ->with('bookList', $books_list);
    }

    public function create()
    {
        // view with creation form
        // GET method (path "/book/create")
        // root name: book.create

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $userID = $dl->getUserID($_SESSION["loggedName"]);
        $authors_list = $dl->listAuthors($userID);

        return view('book.editBookBootstrap')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])
            ->with('authorList', $authors_list);
    }

    public function store(Request $request)
    {
        // for saving just created book
        // POST method (path "/book")
        // root name: book.store

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $userID = $dl->getUserID($_SESSION["loggedName"]);
        $dl->addBook($request->input('title'), $request->input('author_id'), $userID);
        return Redirect::to(route('book.index'));
    }

    public function show()
    {
        // for showing single book details
        // GET method (path "/book/{book}")
        // root name: book.show
        // NOT USED 
    }

    public function edit($id)
    {
        // view with edit form
        // GET method (path "/book/{book}/edit")
        // root name: book.edit

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $userID = $dl->getUserID($_SESSION["loggedName"]);
        $authors_list = $dl->listAuthors($userID);
        $book = $dl->findBookById($id);

        return view('book.editBookBootstrap')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])
            ->with('authorList', $authors_list)->with('book', $book);
    }

    public function update(Request $request, $id)
    {
        // for saving just modified book
        // PUT method (path "/book/{book}") - root name: book.update NOT USED      
        // GET method (path "/book/{id}/update") - root name: book.update

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $dl->editBook($id, $request->input('title'), $request->input('author_id'));
        return Redirect::to(route('book.index'));
    }

    public function destroy($id)
    {
        // for deleting book
        // DELETE method (path "/book/{book}") - root name: book.destroy NOT USED
        // GET method (path "/book/{id}/destroy") - root name: book.destroy

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $dl->deleteBook($id);
        return Redirect::to(route('book.index'));
    }

    public function confirmDestroy($id)
    {
        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $book = $dl->findBookById($id);
        if ($book !== null) {
            return view('book.deleteBookBootstrap')->with('logged', true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('book', $book);
        } else {
            return view('book.deleteErrorPage')->with('logged', true)
                ->with('loggedName', $_SESSION["loggedName"]);
        }
    }

    public function ajaxCheckForBooks(Request $request) {
        
        $dl = new DataLayer();
        
        if($dl->findBookByTitle($request->input('title')))
        {
            $response = array('found'=>true);
        } else {
            $response = array('found'=>false);
        }
        return response()->json($response);
    }
}
