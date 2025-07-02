<?php
    require_once ('../utils/XHTML_functions.php');
    include_once ('../models/Author.php');
    include_once ('../models/Book.php');
    include_once ('../models/DataLayer.php');
    $dl = new DataLayer();
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
echo html_head("Biblios :: Authors' List");
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
                <li class="breadcrumb-item active" aria-current="page">Library</li>
                <li class="breadcrumb-item active" aria-current="page">Authors</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <header class="header-sezione">
            <h1>
                Authors List
            </h1>
        </header>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6 d-flex justify-content-end">
                <p>
                    <a class="btn btn-success" href="editAuthor.php">
                        <i class="bi bi-database-add"></i>
                        Create new author</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-responsive">
                    <col width='80%'>
                    <col width='10%'>
                    <col width='10%'>
                    <thead>
                        <tr>
                            <th>Author's name</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        foreach ($authors_list as $author) {
                            echo '<tr>';
                            echo '<td>' . $author->getFirstName() . ' ' . $author->getLastName() . '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-primary" href="editAuthor.php?id=' . $author->getId() . '"><i class="bi bi-pencil-square"></i> Edit</a>';
                            echo '</td>';
                            if (!$dl->findBooksByAuthorID($author->getId())) {
                                echo '<td>';
                                echo '<a class="btn btn-danger" href="deleteAuthor.php?id=' . $author->getId() . '"><i class="bi bi-trash"></i> Delete</a>';
                                echo '</td>';
                            } else {
                                echo '<td>';
                                echo '<a class="btn btn-secondary" disabled="disabled" href="#"><i class="bi bi-ban"></i> Delete</a>';
                                echo '</td>';
                            }
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