<?php

include_once('../utils/config.php');
include_once('Author.php');
include_once('Book.php');

class DataLayer
{
    private $pdo;

    /**
     * Constructor of the DataLayer class
     */
    public function __construct()
    {        
        global $HOST, $USERNAME, $PASSWORD, $DB_NAME;

        try {
            $this->pdo = new PDO("mysql:host={$HOST};dbname={$DB_NAME}", $USERNAME, $PASSWORD);
            // Set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }
    
    /**
     * Returns the list of books, sorted by title.
     */
    public function listBooks()
    {
        $sql = "SELECT * FROM book ORDER BY title";
        try {
            $statement = $this->pdo->query($sql);

            $books = $statement->fetchAll(PDO::FETCH_ASSOC);
            $booksList = array();
            foreach ($books as $book) {
                $author = $this->findAuthorById($book['author_id']);
                $booksList[] = new Book($book['id'],$book['title'],$author->getFirstName()." ".$author->getLastName(),$book['author_id']);
            }
            return $booksList;
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }

    /**
     * Returns the author with the specified ID.
     */
    public function findAuthorById($id)
    {
        $sql = "SELECT * FROM author where id = :id";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':id',$id);
            $statement->execute();
            //Alternative: $statement->execute(array(':id' => $id));

            $author = $statement->fetch(PDO::FETCH_ASSOC);

            // Check if author found
            if ($author) {
                return new Author($author['id'], $author['firstname'], $author['lastname']);
            } else {
                return null; // Author not found
            }
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }

    /**
     * Returns TRUE if a book associated with the author's ID exists, FALSE otherwise.
     */
    public function findBooksByAuthorID($author_id)
    {
        $sql = "SELECT * FROM book where author_id = :author_id";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':author_id',$author_id);
            $statement->execute();

            // Get the number of affected rows
            $affectedRows = $statement->rowCount();

            if($affectedRows != 0)
            {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }

    /**
     * Returns the book with the specified ID.
     */
    public function findBookById($id)
    {
        $sql = "SELECT * FROM book where id = :id";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':id',$id);
            $statement->execute();

            $book = $statement->fetch(PDO::FETCH_ASSOC);

            // Check if book found
            if ($book) {
                $author = $this->findAuthorById($book['author_id']);
                return new Book($book['id'],$book['title'],$author->getFirstName()." ".$author->getLastName(),$book['author_id']);
            } else {
                return null; // Book not found
            }
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }

    /**
     * Add a new book in the database.
     */
    public function addBook($title,$author_id)
    {
        $sql = "INSERT INTO book (title,author_id) VALUES (:title,:author_id)";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':title',$title);
            $statement->bindParam(':author_id',$author_id);
            $statement->execute();
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }

    /**
     * Edit the book with the specified ID, using the input parameters.
     */
    public function editBook($id,$title,$author_id)
    {
        $sql = "UPDATE book SET title = :title, author_id = :author_id WHERE id = :id";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':title',$title);
            $statement->bindParam(':author_id',$author_id);
            $statement->bindParam(':id',$id);
            $statement->execute();
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }

    /**
     * Delete the book associated with the specified ID.
     */
    public function deleteBook($id) 
    {
        $sql = "DELETE FROM book where id = :id";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':id',$id);
            $statement->execute();
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }  
    
    /**
     * Returns the list of authors, sorted by last name and first name, respectively.
     */
    public function listAuthors()
    {
        $sql = "SELECT * FROM author ORDER BY lastname,firstname";
        try {
            $statement = $this->pdo->query($sql);

            $authors = $statement->fetchAll(PDO::FETCH_ASSOC);
            $authorsList = array();
            foreach ($authors as $author) {
                $authorsList[] = new Author($author['id'],$author['firstname'],$author['lastname']);
            }
            return $authorsList;
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }
    
    /**
     * Add a new author in the database.
     */
    public function addAuthor($first_name,$last_name)
    {
        $sql = "INSERT INTO author (firstname,lastname) VALUES (:first_name,:last_name)";

        try{
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':first_name',$first_name);
            $statement->bindParam(':last_name',$last_name);
            $statement->execute();
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }  

    /**
     * Edit the author with the specified ID, using the input parameters.
     */
    public function editAuthor($id,$first_name,$last_name)
    {
        $sql = "UPDATE author SET firstname = :first_name, lastname = :last_name WHERE id = :id";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':first_name',$first_name);
            $statement->bindParam(':last_name',$last_name);
            $statement->bindParam(':id',$id);
            $statement->execute();
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }

    /**
     * Delete the author associated with the specified ID.
     */
    public function deleteAuthor($id) 
    {
        $sql = "DELETE FROM author where id = :id";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':id',$id);
            $statement->execute();
        } catch (PDOException $e) {
            die("ERROR: Could not execute query. " . $e->getMessage());
        }
    }
}