<?php

class Book
{
    private $id;
    private $title; 
    private $author_lastName;
    private $authorID;
    
    public function __construct($identifier, $book_title, $author_name, $author_id)
    {
        $this->id = $identifier;
        $this->title = $book_title;
        $this->author_lastName = $author_name;
        $this->authorID = $author_id;
    }
    
    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getAuthor() {
        return $this->author_lastName;
    }
    
    function getAuthorID() {
        return $this->authorID;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setAuthor($author_name) {
        $this->author_lastName = $author_name;
    }
    
    function setAuthorID($author_id) {
        $this->authorID = $author_id;
    }
}