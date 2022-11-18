<?php

use JetBrains\PhpStorm\NoReturn;

if (!function_exists('renderErrorView')) {
    function renderErrorView($code, $path, $array = []): bool
    {
        if ($array) {
            foreach ($array as $key => $item) {
                $$key = $item;
            }
        }
        http_response_code($code);
        ob_start();
        require_once __DIR__ . "/../views/$path";

        return ob_flush();
    }
}

if (!function_exists('view')) {
    function view($path, $array = [])
    {
        if ($array) {
            foreach ($array as $key => $item) {
                $$key = $item;
            }
        }
        ob_start();
        require_once __DIR__ . "/../views/$path";

        return ob_flush();
    }
}

if (!function_exists('dd')) {
    function dd(...$vars)
    {
        foreach ($vars as $var) {
            echo '<pre>';
            var_dump($var);
            echo '<pre>';
        }
        exit();
    }
}

if (!function_exists('error')) {
    function error($name)
    {
        if (key_exists("$name", $_SESSION)) {
            echo $_SESSION["$name"];
        }
    }
}

if (!function_exists('routes')) {
    function routes($routes)
    {
        include_once __DIR__ . "/../routes/$routes";
    }
}

if (!function_exists('image')) {
    function image($request, $directory)
    {
        $imgName = $_FILES[$request]['name'];
        $imgType = $_FILES[$request]['type'];
        $tmpName = $_FILES[$request]['tmp_name'];

        $extensions = ["image/jpeg", "image/png", "image/jpg"];
        $newImgName = time() . $imgName;
        if (in_array($imgType, $extensions)) {
            move_uploaded_file($tmpName, "$directory/" . $newImgName);
            return $newImgName;
        }
    }
}

if (!function_exists('assets')) {
    function assets($path): void
    {
        echo BASE_URI . "/$path";
    }
}