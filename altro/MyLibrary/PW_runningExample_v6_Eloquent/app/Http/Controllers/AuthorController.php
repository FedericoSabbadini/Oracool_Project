<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl = new DataLayer();
        $authorsList = $dl->listAuthors();
        return view('author.authors')->with('authors_list',$authorsList);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.editAuthor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo 'Store a newly created resource in storage';
        //abort(501);
        $dl = new DataLayer();
        $dl->addAuthor($request->input('firstName'),$request->input('lastName'));
        return Redirect::to(route('author.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(501);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $author = $dl->findAuthorById($id);

        if ($author !== null) {
            return view('author.editAuthor')->with('author', $author);
        } else {
            return view('errors.wrongID')->with('message','Wrong author ID has been used!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // echo 'Update the specified resource in storage';
        // abort(501);
        $dl = new DataLayer();
        $dl->editAuthor($id, $request->input('firstName'), $request->input('lastName'));
        return Redirect::to(route('author.index'));
    }

    public function confirmDestroy($id) {
        $dl = new DataLayer();
        $author = $dl->findAuthorById($id);
        if ($author !== null) {
            return view('author.deleteAuthor')->with('author', $author);
        } else {
            return view('errors.wringID')->with('message','Wrong author ID has been used!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // echo 'Remove the specified resource from storage';
        // abort(501);
        $dl = new DataLayer();
        $dl->deleteAuthor($id);
        return Redirect::to(route('author.index'));
    }
}
