<?php
    require_once('../utils/XHTML_functions.php');
    include_once('../models/Author.php');
    include_once('../models/Book.php');
    include_once('../models/DataLayer.php');
    $dl = new DataLayer();
    $books_list = $dl->listBooks();
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
        echo html_head("Biblios :: Books' List");
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
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                    <li class="breadcrumb-item active" aria-current="page">Books</li>
                </ol>
            </nav>
        </div>
        
        <div class="container-fluid">
            <header class="header-sezione">
                <h1>
                    My Books List
                </h1>
            </header>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6 d-flex justify-content-end">
                    <p>
                        <a class="btn btn-success" 
                           href="editBook.php">
                           <i class="bi bi-database-add"></i> 
                            Create new book</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover">
                        <col width='50%'>
                        <col width='30%'>
                        <col width='10%'>
                        <col width='10%'>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                foreach ($books_list as $book)
                                {
                                    echo '<tr>';
                                    echo '<td>'.$book->getTitle().'</td>';
                                    echo '<td>'.$book->getAuthor().'</td>';
                                    echo '<td>';
                                    echo '<a class="btn btn-primary" href="editBook.php?id='.$book->getId().'"><i class="bi bi-pencil-square"></i> Edit</a>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<a class="btn btn-danger" href="deleteBook.php?id='.$book->getId().'"><i class="bi bi-trash"></i> Delete</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </body>
</html>
