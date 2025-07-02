<?php
require_once ('../utils/XHTML_functions.php');
include_once ('../models/Author.php');
include_once ('../models/Book.php');
include_once ('../models/DataLayer.php')
    ?>
<!DOCTYPE html>
<html>
<?php
if (isset ($_GET['id'])) {
    echo html_head("Biblios :: Error page");
} else {
    echo html_head("Biblios :: Error page");
}
?>

<body>
    <?php
        // Caricamento del menu
        $menuItems = [
            ["name" => "Home", "link" => "../index.php"],
            ["name" => "My Library", "link" => "#", "submenu" => [
                ["name" => "Books List", "link" => "../books/books.php"],
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
                <li class="breadcrumb-item active" aria-current="page"><a href="authors.php">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="authors.php">Authors</a></li>
                <li class="breadcrumb-item active" aria-current="page">Author error page</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-danger">
                    <div class='card-header'>
                        Illegal page access: wrong author ID has been used!
                    </div>
                    <div class='card-body'>
                        <p>Something <strong>wrong</strong> happened while accessing this page</p>
                        <p><a class="btn btn-danger" href="../authors/authors.php"><i class="bi bi-box-arrow-left"></i> Back to books
                                list</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>