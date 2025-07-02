<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{
    public function index()
    {
        // GET method (path "/author")
        // root name: author.index
        // root name: author.index

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $userID = $dl->getUserID($_SESSION["loggedName"]);
        $authors_list = $dl->listAuthors($userID);

        return view('author.authorsBootstrap')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])
            ->with('authorList', $authors_list);
    }

    public function create()
    {
        // view with creation form
        // GET method (path "/author/create")
        // root name: author.create

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        return view('author.editAuthorBootstrap')->with('logged', true)
            ->with('loggedName', $_SESSION["loggedName"]);
    }

    public function store(Request $request)
    {
        // for saving just created author
        // POST method (path "/author")
        // root name: author.store

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $userID = $dl->getUserID($_SESSION["loggedName"]);
        $dl->addAuthor($request->input('firstName'), $request->input('lastName'), $userID);
        return Redirect::to(route('author.index'));
    }

    public function show()
    {
        // for showing single author details
        // GET method (path "/author/{authorID}")
        // root name: author.show
        // NOT USED 
    }

    public function edit($id)
    {
        // view with edit form
        // GET method (path "/author/{authorID}/edit")
        // root name: author.edit

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $author = $dl->findAuthorById($id);

        return view('author.editAuthorBootstrap')->with('logged', true)
            ->with('loggedName', $_SESSION["loggedName"])
            ->with('author', $author);
    }

    public function update(Request $request, $id)
    {
        // for saving just modified author
        // PUT method (path "/author/{author}") - root name: author.update NOT USED
        // GET method (path "/author/{id}/update") - root name: author.update

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $dl->editAuthor($id, $request->input('firstName'), $request->input('lastName'));
        return Redirect::to(route('author.index'));
    }

    public function destroy($id)
    {
        // for deleting author
        // DELETE method (path "/author/{authorID}") - root name: author.destroy
        // GET method (path "/author/{id}/destroy") - root name: author.destroy

        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }
        
        $dl = new DataLayer();
        $dl->deleteAuthor($id);
        return Redirect::to(route('author.index'));
    }

    public function confirmDestroy($id)
    {
        //        session_start();
        //    
        //        if(!isset($_SESSION['logged'])) {
        //            return Redirect::to(route('user.login'));
        //        }

        $dl = new DataLayer();
        $author = $dl->findAuthorById($id);
        if ($author !== null) {
            return view('author.deleteAuthorBootstrap')->with('logged', true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('author', $author);
        } else {
            return view('author.deleteErrorPage')->with('logged', true)
                ->with('loggedName', $_SESSION["loggedName"]);
        }
    }

    public function ajaxCheckForAuthors(Request $request) {
        
        $dl = new DataLayer();
        
        if($dl->findAuthorByNames($request->input('firstName'), $request->input('lastName')))
        {
            $response = array('found'=>true);
        } else {
            $response = array('found'=>false);
        }
        return response()->json($response);
    }
}
