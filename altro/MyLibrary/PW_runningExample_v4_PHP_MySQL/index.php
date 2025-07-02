<?php
    require_once('utils/XHTML_functions.php');
?>
<!DOCTYPE html>
<html>
    <?php
        echo html_head("Biblios :: Books' List");
    ?>
    <body>
        <?php
            // Caricamento del menu
            $menuItems = [
                ["name" => "Home", "link" => "index.php"],
                ["name" => "My Library", "link" => "#", "submenu" => [
                    ["name" => "Books List", "link" => "books/books.php"],
                    ["name" => "Authors List", "link" => "authors/authors.php"]
                ]]
            ];
            $activeIndex = [1, 0]; // Home è attivo

            generateMenu($menuItems, $activeIndex);
        ?>

        <div class="container-fluid d-flex justify-content-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>
        </div>
        
        <div class="container-fluid">
            <header class="header-sezione">
                <h1>
                    My online Library
                </h1>
            </header>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-sm-12">
                    <div class="citazione">
                        <p>A very simple example of a website created during the Web Programming 
                            and Digital Services course. The site lists the books I am currently 
                            reading or have read, along with the list of authors who have populated 
                            my readings and imagination. The website will continue to grow during 
                            this semester, completing itself gradually thanks to the implementation 
                            of web technologies that will be introduced in the course. Enjoy!
                        </p>
                        <blockquote>
                            <p>Sow an act, and you reap a habit; 
                                sow a habit, and you reap a character; 
                                sow a character, and you reap a destiny. </p>
                            <small>[Indian proverb]</small>
                        </blockquote>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-12">
                    <div class="imgBiblio">
                        <img class="img-thumbnail img-responsive" src="img/pretty-4-th.jpg">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>