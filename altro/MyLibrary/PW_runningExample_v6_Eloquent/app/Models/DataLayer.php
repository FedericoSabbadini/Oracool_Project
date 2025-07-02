<?php

namespace App\Models;

class DataLayer
{
    /**
     * Returns the list of books, sorted by title.
     */
    public function listBooks()
    {
        // $booksList = array();

        // $booksList[] = new Book(1,"Il nome della rosa","Umberto Eco",1);
        // $booksList[] = new Book(2,"IT","Stephen King",2);
        // $booksList[] = new Book(3,"The tommyknockers - Le creature del buio","Stephen King",2);

        $booksList = Book::orderBy('title','asc')->get();
        return $booksList;
    }

    /**
     * Returns the author with the specified ID.
     */
    public function findAuthorById($id)
    {
        // if($id==1)
        // {
        //     return new Author(1, "Umberto", "Eco");
        // } elseif($id==2) 
        // {
        //     return new Author(2, "Stephen", "King");
        // } elseif($id==3)
        // {
        //     return new Author(3, "Vito", "Mancuso");
        // } else
        // {
        //     return null;
        // }
        return Author::find($id);
    }

    /**
     * Returns TRUE if a book associated with the author's ID exists, FALSE otherwise.
     * (DEPRECATED)
     */
    public function findBooksByAuthorID($id)
    {
        // if($id==1)
        // {
        //     return true;
        // } elseif($id==2) 
        // {
        //     return true;
        // } else
        // {
        //     return false;
        // }
    }

    /**
     * Returns the book with the specified ID.
     */
    public function findBookById($id)
    {
        // if($id==1)
        // {
        //     return new Book(1,"Il nome della rosa","Umberto Eco",1);
        // } elseif($id==2) 
        // {
        //     return new Book(2,"IT","Stephen King",2);
        // } elseif($id==3)
        // {
        //     return new Book(3,"The tommyknockers - Le creature del buio","Stephen King",2);
        // } else
        // {
        //     return null;
        // }
        return Book::find($id);
    }

    /**
     * Add a new book in the database.
     */
    public function addBook($title,$author_id)
    {
        $book = new Book;
        $book->title = $title;
        $book->author_id = $author_id;
        $book->save();
        // massive creation (only with fillable property enabled on Book):
        // Book::create(['title' => $title, 'author_id' => $author_id]);
    }

    /**
     * Edit the book with the specified ID, using the input parameters.
     */
    public function editBook($id,$title,$author_id)
    {
        $book = Book::find($id);
        $book->title = $title;
        $book->author_id = $author_id;
        $book->save();
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }

    /**
     * Delete the book associated with the specified ID.
     */
    public function deleteBook($id) 
    {
        $book = Book::find($id);
        $book->delete();
    }  
    
    /**
     * Returns the list of authors, sorted by last name and first name, respectively.
     */
    public function listAuthors()
    {
        // $authorsList = array();
        // $authorsList[] = new Author(1, "Umberto", "Eco");
        // $authorsList[] = new Author(2, "Stephen", "King");
        // $authorsList[] = new Author(3, "Vito", "Mancuso");
        $authorsList = Author::orderBy('lastname','asc')->orderBy('firstname','asc')->get();
        return $authorsList;
    }
    
    /**
     * Add a new author in the database.
     */
    public function addAuthor($first_name,$last_name)
    {
        $author = new Author;
        $author->firstname = $first_name;
        $author->lastname = $last_name;
        $author->save();
        // massive creation (only with fillable property enabled on Author):
        // Author::create(['firstname' => $first_name, 'lastname' => $last_name]);
    }  

    /**
     * Edit the author with the specified ID, using the input parameters.
     */
    public function editAuthor($id,$first_name,$last_name)
    {
        $author = Author::find($id);
        $author->firstname = $first_name;
        $author->lastname = $last_name;
        $author->save();
        // massive update (only with fillable property enabled on Author): 
        // Author::find($id)->update(['firstname' => $first_name, 'lastname' => $last_name]);
    }

    /**
     * Delete the author associated with the specified ID.
     */
    public function deleteAuthor($id) 
    {
        $author = Author::find($id);
        $author->delete();
    }
}