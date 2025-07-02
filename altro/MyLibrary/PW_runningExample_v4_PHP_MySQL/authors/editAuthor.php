<?php
require_once ('../utils/XHTML_functions.php');
include_once ('../models/Author.php');
include_once ('../models/Book.php');
include_once ('../models/DataLayer.php');
$dl = new DataLayer();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset ($_POST['id'])) {
        // edit
        $dl->editAuthor($_POST['id'], $_POST['firstName'], $_POST['lastName']);
        header("location: authors.php");
    } else {
        // create
        $dl->addAuthor($_POST['firstName'], $_POST['lastName']);
        header("location: authors.php");
    }
}

if (isset ($_GET['id'])) {
    $author = $dl->findAuthorById($_GET['id']);
    if(is_null($author)) {
        header("location: ../errors/errorPageAuthor.php");
    }
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
if (isset ($_GET['id'])) {
    echo html_head("Biblios :: Edit Author");
} else {
    echo html_head("Biblios :: Create new Author");
}
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
                <li class="breadcrumb-item active" aria-current="page">
                    <?php
                    if (isset ($_GET['id'])) {
                        echo 'Edit author';
                    } else {
                        echo 'Add author';
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
                    echo 'Edit Author';
                } else {
                    echo 'Create new Author';
                }
                ?>
            </h1>
        </header>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form name="author" method="post" action="#">
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">First Name</label>
                        </div>
                        <div class="col-md-10">
                            <?php
                            if (isset ($_GET['id'])) {
                                echo '<input class="form-control" type="text" name="firstName" placeholder="First Author\'s Name" value="' . $author->getFirstName() . '">';
                            } else {
                                echo '<input class="form-control" type="text" name="firstName" placeholder="First Author\'s Name">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Last Name</label>
                        </div>
                        <div class="col-md-10">
                            <?php
                            if (isset ($_GET['id'])) {
                                echo '<input class="form-control" type="text" name="lastName" placeholder="Last Author\'s Name" value="' . $author->getLastName() . '">';
                            } else {
                                echo '<input class="form-control" type="text" name="lastName" placeholder="Last Author\'s Name">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            <?php
                            if (isset ($_GET['id'])) {
                                echo '<input type="hidden" name="id" value="' . $author->getId() . '"/>';
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
                            <a class="btn btn-danger w-100" href="authors.php"><i class="bi bi-box-arrow-left"></i>
                                Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>