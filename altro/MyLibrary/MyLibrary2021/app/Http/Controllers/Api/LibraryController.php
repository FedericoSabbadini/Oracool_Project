<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Http\Resources\BookResource;

class LibraryController extends Controller
{
    public function listBooks(Request $request)
    {
        // Return all books (with authors if specified in the header)
        $dl = new DataLayer();
        if ($request->header('with_author') == 'true') {
            $books = $dl->listBooksWithAuthors();
        } else {
            $books = $dl->listBooksWithoutAuthors();
        }

        return $books;
    }

    public function listBooksPaginate(Request $request)
    {
        $dl = new DataLayer();
        if ($request->header('with_author') == 'true') {
            $books = $dl->listBooksWithAuthorsPaginate();
        } else {
            $books = $dl->listBooksWithoutAuthorsPaginate();
        }
        return $books;
    }

    public function listBooksPaginateAndSort(Request $request)
    {
        $dl = new DataLayer();
        if ($request->header('with_author') == 'true') {
            $books = $dl->listBooksWithAuthorsPaginateAndSorted($request->input('sort'));
        } else {
            $books = $dl->listBooksWithoutAuthorsPaginateAndSorted($request->input('sort'));
        }
        return $books;
    }

    public function listBooksWithResources(Request $request)
    {
        $dl = new DataLayer();
        // Without using AuthorResource
        // $books = $dl->listBooksWithAuthorsPaginateAndSorted($request->input('sort'), $request->input('page'));
        // Using AuthorResource
        $books = $dl->listBooksWithoutAuthorsPaginateAndSorted($request->input('sort'), $request->input('page'));
        
        return response(BookResource::collection($books));
    }

    public function listBookWithRsponseHeaders(Request $request)
    {
        $dl = new DataLayer();
        // Without using AuthorResource
        // $books = $dl->listBooksWithAuthorsPaginateAndSorted($request->input('sort'), $request->input('page'));
        // Using AuthorResource
        $books = $dl->listBooksWithoutAuthorsPaginateAndSorted($request->input('sort'), $request->input('page'));
        return response(BookResource::collection($books))->header('Owner', 'Devis');
    }

    public function addBook(Request $request)
    {
        $dl = new DataLayer();
        $data = $request->json()->all();

        if ($dl->findUsername($data['user'])) {
            if ($dl->findAuthorByNames($data['author']['firstname'], $data['author']['lastname'])) {
                if ($dl->findBookByTitle($data['title'])) {
                    return response()->json(['Error' => 'Book already present in the database']);
                } else {
                    $author = $dl->getAuthorByName($data['author']['firstname'], $data['author']['lastname']);
                    $user = $dl->getUserID($data['user']);
                    $dl->addBook($data['title'], $author->id, $user);
                    return response()->json(['Msg' => 'Book created']);
                }
            } else {
                return response()->json(['Error' => 'Author not found']);
            }
            return response()->json([
                'Author\'s name' => $data['author']['firstname'] . ' ' . $data['author']['lastname']
            ]);
        } else {
            return response()->json(['Error' => 'Username not found']);
        }
    }
}
