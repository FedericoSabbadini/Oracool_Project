<?php
require_once ('../utils/XHTML_functions.php');
include_once ('../models/Author.php');
include_once ('../models/Book.php');
include_once ('../models/DataLayer.php');
$dl = new DataLayer();

if (isset ($_GET['confirm'])) {
    if (isset ($_GET['id'])) {
        $dl->deleteBook($_GET['id']);
    }
    header("location: books.php");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
        echo html_head("Biblios :: Delete Book from the List");
    ?>

    <body>
        <?php
            // Caricamento del menu
            $menuItems = [
                ["name" => "Home", "link" => "../index.php"],
                ["name" => "My Library", "link" => "#", "submenu" => [
                    ["name" => "Books List", "link" => "books.php"],
                    ["name" => "Authors List", "link" => "../authors/authors.php"]
                ]]
            ];
            $activeIndex = [0, 1]; // My Library è attivo

            generateMenu($menuItems, $activeIndex);
        ?>

    <div class="container-fluid d-flex justify-content-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="books.php">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="books.php">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">Delete book</li>
            </ol>
        </nav>
    </div>

    <?php
        $book = null;
        if (isset($_GET['id'])) {
            $book = $dl->findBookById($_GET['id']);
        }
        if(!is_null($book)) {
    ?>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-12">
                <header>
                    <h1>
                        <?php
                            echo 'Delete book "' . $book->getTitle() . '" from the list';
                        ?>
                    </h1>
                </header>
                <p class="confirm">
                    Deleting book. Confirm?
                </p>
            </div>
        </div>
    </div>


    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-6 order-md-2">
                <div class="card border-secondary">
                    <div class="card-header">
                        Confirm
                    </div>
                    <div class="card-body">
                        <p>
                            The book <strong>will be permanently removed</strong> from the data base
                        </p>
                        <?php
                                echo '<a class="btn btn-danger" href="deleteBook.php?id=' . $_GET['id'] . '&confirm=confirm"><i class="bi bi-trash"></i> Delete</a>';
                                ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6 order-md-1">
                <div class="card border-secondary">
                    <div class="card-header">
                        Revert
                    </div>
                    <div class="card-body">
                        <p>
                            The book <strong>will not be removed</strong> from the data base
                        </p>
                        <a class="btn btn-secondary" href="books.php"><i class="bi bi-box-arrow-left"></i> Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        } else {
            ?>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-12">
                <header>
                    <h1>
                        Delete book from the list
                    </h1>
                </header>
            </div>
        </div>

        <div class="row">
                    <div class="col-md-12">
                        <div class="card border-danger">
                            <div class='card-header'>
                                Illegal page access: no or wrong book ID has been used!
                            </div>
                            <div class='card-body'>
                                <p>Something <strong>wrong</strong> happened while accessing this page</p>
                                <p><a class="btn btn-danger" href="books.php"><i class="bi bi-box-arrow-left"></i> Back to books list</a></p>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <?php
        }
        ?>
</body>
</html>