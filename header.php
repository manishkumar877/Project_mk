<!doctype html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <img src="logo.png" width="200" height="70">
        </ul>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle">
                <img src="mk.jpeg" alt="hugenerd" width="30" height="30" class="rounded-circle">
            </a>
            <a class="dropdown-item" href="logout.php">Sign out</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <?php
                   
include "dbname.php";
include('authentication.php');

                 
                    $sql = "SELECT * FROM menu_items";
                    $result = mysqli_query($conn, $sql);

                    $navItems = [];

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $navItems[$row['parent_id']][] = $row;
                        }
                    } else {
                        echo "No menu items found.";
                    }

                 
                    mysqli_close($conn);

                    function display_nav($parent_id, $navItems) {
                        if (isset($navItems[$parent_id])) {
                            echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
                            foreach ($navItems[$parent_id] as $item) {
                                if (isset($navItems[$item['id']])) {
                                    echo '<li class="nav-item dropdown">';
                                    echo '<a class="nav-link dropdown-toggle" href="' . $item['url'] . '" id="navbarDropdown' . $item['id'] . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $item['name'] . '</a>';
                                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown' . $item['id'] . '">';
                                    display_nav($item['id'], $navItems);
                                    echo '</ul>';
                                    echo '</li>';
                                } else {
                                    echo '<li class="nav-item">';
                                    echo '<a class="nav-link" href="' . $item['url'] . '">' . $item['name'] . '</a>';
                                    echo '</li>';
                                }
                            }
                            echo '</ul>';
                        }
                    }

                    display_nav(0, $navItems);
                    ?>
                </ul>
                <hr>
            </div>
        </div>
        <div class="col py-3">
            <!-----------------------header Navbar-------------------------------------------------------->
        
