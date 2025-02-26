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
            require __DIR__ . $pages_dir . 'index.php';
            exit();
        } elseif (file_exists(__DIR__ . $pages_dir . 'home.php')) {
            require __DIR__ . $pages_dir . 'home.php';
            exit();
        } elseif (file_exists(__DIR__ . $pages_dir . 'main.php')) {
            require __DIR__ . $pages_dir . 'main.php';
            exit();
        } else {
            if (file_exists(__DIR__ . $pages_dir . '404.php')) {
                require __DIR__ . $pages_dir . '404.php';
            } else {
                echo 'Page not found.<br>';
            }
            exit();
        }
    }

    // go trough each file found and check if they match the request
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'php' && '/' . pathinfo($file, PATHINFO_FILENAME) == $request) {
            require __DIR__ . $pages_dir . $file;
            exit();
        }
    }

    if (file_exists(__DIR__ . $pages_dir . '404.php')) {
        require __DIR__ . $pages_dir . '404.php';
    } else {
        echo 'Page not found.<br>';
    }
?>
