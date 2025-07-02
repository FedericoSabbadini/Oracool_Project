<?php
require_once ('../utils/XHTML_functions.php');
include_once ('../models/Author.php');
include_once ('../models/Book.php');
include_once ('../models/DataLayer.php');
$dl = new DataLayer();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset ($_POST['id'])) {
        // edit
        $dl->editBook($_POST['id'], $_POST['title'], $_POST['author_id']);
        header("location: books.php");
    } else {
        // create
        $dl->addBook($_POST['title'], $_POST['author_id']);
        header("location: books.php");
    }
} elseif (isset ($_GET['id'])) {
    $book = $dl->findBookById($_GET['id']);
    if(is_null($book))
    {
        header("location: ../errors/errorPageBook.php");
    }
}

$authors_list = $dl->listAuthors();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<?php
if (isset ($_GET['id'])) {
    echo html_head("Biblios :: Edit Book");
} else {
    echo html_head("Biblios :: Create new Book");
}
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
                <li class="breadcrumb-item active" aria-current="page">
                    <?php
                    if (isset ($_GET['id'])) {
                        echo 'Edit book';
                    } else {
                        echo 'Add book';
                    }
                    ?>
                </li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <header class="header-sezione">
            <h1>
                <?php
                if (isset ($_GET['id'])) {
                    echo 'Edit Book';
                } else {
                    echo 'Create new Book';
                }
                ?>
            </h1>
        </header>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" name="book" method="post" action="#">
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Title</label>
                        </div>
                        <div class="col-md-10">
                            <?php
                            if (isset ($_GET['id'])) {
                                echo '<input class="form-control" type="text" name="title" placeholder="Book title" value="' . $book->getTitle() . '">';
                            } else {
                                echo '<input class="form-control" type="text" name="title" placeholder="Book title">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="author_id">Author</label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" name="author_id">
                                <?php
                                foreach ($authors_list as $author) {
                                    if ((isset ($_GET['id'])) && ($author->getId() == $book->getAuthorID())) {
                                        echo '<option value="' . $author->getId() . '" selected="selected">' . $author->getLastName() . '</option>';
                                    } else {
                                        echo '<option value="' . $author->getId() . '">' . $author->getLastName() . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            <?php
                                if (isset ($_GET['id'])) {
                                    echo '<input type="hidden" name="id" value="' . $book->getId() . '"/>';
                                    echo '<label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> Save</label>';
                                    echo '<input id="mySubmit" class="d-none" type="submit" value=\'Save\'/>';
                                } else {
                                    echo '<label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> Create</label>';
                                    echo '<input id="mySubmit" class="d-none" type="submit" value=\'Create\'/>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            <a class="btn btn-danger w-100" href="books.php"><i class="bi bi-box-arrow-left"></i>
                                Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>