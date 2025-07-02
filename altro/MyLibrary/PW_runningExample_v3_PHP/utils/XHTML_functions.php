<?php

function html_head($titolo) {
    $result = '  <head>';
    $result .= '    <title>'.$titolo.'</title>';
    $result .= '    <meta charset="UTF-8">';
    $result .= '    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">';
    $result .= '    <!-- Fogli di stile -->';
    $result .= '    <link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/PW_runningExample_v3_PHP/css/bootstrap.css">';
    $result .= '    <link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/PW_runningExample_v3_PHP/css/style.css">';
    $result .= '    <!-- jQuery e plugin JavaScript -->';
    $result .= '    <script src="http://code.jquery.com/jquery.js"></script>';
    $result .= '    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>';
    $result .= '    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>';    
    $result .= '    <script src="http://' . $_SERVER['HTTP_HOST'] . '/PW_runningExample_v3_PHP/js/bootstrap.min.js"></script>';
    $result .= '    <!-- Bootstrap Icons -->';
    $result .= '    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">';
    $result .= '  </head>';
    
    return $result;
}   
function generateMenu($menuItems, $activeIndex) {
    echo '<nav class="navbar navbar-expand-lg bg-body-tertiary">';
    echo '    <div class="container-fluid">';
    echo '        <a class="navbar-brand" href="#">Biblios</a>';
    echo '        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
    echo '            <span class="navbar-toggler-icon"></span>';
    echo '        </button>';
    echo '        <div class="collapse navbar-collapse" id="navbarSupportedContent">';
    echo '            <ul class="navbar-nav me-auto mb-2 mb-lg-0">';
    
    foreach ($menuItems as $index => $item) {
        $activeClass = ($activeIndex[$index] == 1) ? ' active' : '';
        
        if (isset($item['submenu']) && is_array($item['submenu'])) {
            echo "<li class='nav-item dropdown'>";
            echo "<a class='nav-link dropdown-toggle$activeClass' href='".$item["link"]."' role='button' data-bs-toggle='dropdown' aria-expanded='false'>".$item['name']."</a>";
            echo "<ul class='dropdown-menu'>";
            foreach ($item['submenu'] as $subItem) {
                if (is_array($subItem) && isset($subItem['name']) && isset($subItem['link'])) {
                    echo "<li><a class='dropdown-item' href='".$subItem['link']."'>".$subItem['name']."</a></li>";
                }
            }
            echo "</ul></li>";
        } else {
            echo "<li class='nav-item'><a class='nav-link$activeClass' href='".$item['link']."'>".$item['name']."</a></li>";
        }
    }
    
    echo '            </ul>';
    echo '        </div>';
    echo '    </div>';
    echo '</nav>';
}
?>



