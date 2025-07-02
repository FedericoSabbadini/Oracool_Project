<?php

namespace App\Models;

class DataLayer
{
    /**
     * Returns the list of books, sorted by title.
     */
    public function listBooks()
    {
        $booksList = array();

        $booksList[] = new Book(1,"Il nome della rosa","Umberto Eco",1);
        $booksList[] = new Book(2,"IT","Stephen King",2);
        $booksList[] = new Book(3,"The tommyknockers - Le creature del buio","Stephen King",2);
        
        return $booksList;
    }

    /**
     * Returns the author with the specified ID.
     */
    public function findAuthorById($id)
    {
        if($id==1)
        {
            return new Author(1, "Umberto", "Eco");
        } elseif($id==2) 
        {
            return new Author(2, "Stephen", "King");
        } elseif($id==3)
        {
            return new Author(3, "Vito", "Mancuso");
        } else
        {
            return null;
        }
    }

    /**
     * Returns TRUE if a book associated with the author's ID exists, FALSE otherwise.
     */
    public function findBooksByAuthorID($id)
    {
        if($id==1)
        {
            return true;
        } elseif($id==2) 
        {
            return true;
        } else
        {
            return false;
        } 
    }

    /**
     * Returns the book with the specified ID.
     */
    public function findBookById($id)
    {
        if($id==1)
        {
            return new Book(1,"Il nome della rosa","Umberto Eco",1);
        } elseif($id==2) 
        {
            return new Book(2,"IT","Stephen King",2);
        } elseif($id==3)
        {
            return new Book(3,"The tommyknockers - Le creature del buio","Stephen King",2);
        } else
        {
            return null;
        }
    }

    /**
     * Add a new book in the database.
     */
    public function addBook($title,$author_id)
    {
        // TODO
    }

    /**
     * Edit the book with the specified ID, using the input parameters.
     */
    public function editBook($id,$title,$author_id)
    {
        // TODO
    }

    /**
     * Delete the book associated with the specified ID.
     */
    public function deleteBook($id) 
    {
        // TODO
    }  
    
    /**
     * Returns the list of authors, sorted by last name and first name, respectively.
     */
    public function listAuthors()
    {
        $authorsList = array();
        $authorsList[] = new Author(1, "Umberto", "Eco");
        $authorsList[] = new Author(2, "Stephen", "King");
        $authorsList[] = new Author(3, "Vito", "Mancuso");
        return $authorsList;
    }
    
    /**
     * Add a new author in the database.
     */
    public function addAuthor($first_name,$last_name)
    {
        // TODO
    }  

    /**
     * Edit the author with the specified ID, using the input parameters.
     */
    public function editAuthor($id,$first_name,$last_name)
    {
        // TODO
    }

    /**
     * Delete the author associated with the specified ID.
     */
    public function deleteAuthor($id) 
    {
        // TODO
    }
}