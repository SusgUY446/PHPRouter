<?php
    // Constant Value's
    $pages_dir = "/pages/"; // the directory where your pages are located (For example views, pages)

    // get the requested url
    $request = $_SERVER['REQUEST_URI'];

    // get all files in the pages dir
    $files = scandir(__DIR__ . $pages_dir);
    

    // remove the first 2 items of the array because they are . and .. which we do not want
    array_splice($files, 0, 2);

    // if the root page is visited, serve home.php, index.php, or main.php
    if ($request == '/') {
        if (file_exists(__DIR__ . $pages_dir . 'index.php')) {
            echo "index.php exists.<br>";
            require __DIR__ . $pages_dir . 'index.php';
            exit();
        } elseif (file_exists(__DIR__ . $pages_dir . 'home.php')) {
            echo "home.php exists.<br>";
            require __DIR__ . $pages_dir . 'home.php';
            exit();
        } elseif (file_exists(__DIR__ . $pages_dir . 'main.php')) {
            echo "main.php exists.<br>";
            require __DIR__ . $pages_dir . 'main.php';
            exit();
        } else {
            echo "No root page found.<br>";
            exit();
        }
    }

    // go trough yeah file found and check if they match the request
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'php' && '/' . pathinfo($file, PATHINFO_FILENAME) == $request) {
            require __DIR__ . $pages_dir . $file;
            break;
        }
    }
?>
