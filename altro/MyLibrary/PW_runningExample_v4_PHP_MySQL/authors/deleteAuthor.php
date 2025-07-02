<?php
require_once ('../utils/XHTML_functions.php');
include_once ('../models/Author.php');
include_once ('../models/Book.php');
include_once ('../models/DataLayer.php');
$dl = new DataLayer();

if (isset ($_GET['confirm'])) {
    if (isset ($_GET['id'])) {
        $dl->deleteAuthor($_GET['id']);
    }
    header("location: authors.php");
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
echo html_head("Biblios :: Delete Author from the List");
?>

<body>
    <?php
        // Caricamento del menu
        $menuItems = [
            ["name" => "Home", "link" => "../index.php"],
            ["name" => "My Library", "link" => "#", "submenu" => [
                ["name" => "Books List", "link" => "../books/books.php"],
                ["name" => "Authors List", "link" => "authors.php"]
            ]]
        ];
        $activeIndex = [0, 1]; // My Library è attivo

        generateMenu($menuItems, $activeIndex);
    ?>

    <div class="container-fluid d-flex justify-content-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="authors.php">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="authors.php">Authors</a></li>
                <li class="breadcrumb-item active" aria-current="page">Delete author</li>
            </ol>
        </nav>
    </div>

    <?php
    $author = null;
    if (isset ($_GET['id'])) {
        $author = $dl->findAuthorById($_GET['id']);
    }
    if(!is_null($author)) {
        ?>
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-md-12">
                    <header>
                        <h1>
                            <?php
                            echo 'Delete author "' . $author->getFirstName() . ' ' . $author->getLastName() . '" from the list';
                            ?>
                        </h1>
                    </header>
                    <p class="confirm">
                        Deleting author. Confirm?
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
                                The author <strong>will be permanently removed</strong> from the data base
                            </p>
                            <?php
                            echo '<a class="btn btn-danger" href="deleteAuthor.php?id=' . $_GET['id'] . '&confirm=confirm"><i class="bi bi-trash"></i> Delete</a>';
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
                                The author <strong>will not be removed</strong> from the data base
                            </p>
                            <a class="btn btn-secondary" href="authors.php"><i class="bi bi-box-arrow-left"></i> Cancel</a>
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
                            Delete author from the list
                        </h1>
                    </header>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card border-danger">
                        <div class='card-header'>
                        Illegal page access: no or wrong author ID has been used!
                        </div>
                        <div class='card-body'>
                            <p>Something <strong>wrong</strong> happened while accessing this page</p>
                            <p><a class="btn btn-danger" href="authors.php"><i class="bi bi-box-arrow-left"></i> Back to
                                    authors' list</a></p>
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