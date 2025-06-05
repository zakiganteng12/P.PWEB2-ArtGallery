<?php 

$request = trim($_SERVER['REQUEST_URI'], "/");
$segments = explode("/", $request);

// Pastikan segmen pertama selalu ada
$page = isset($segments[0]) ? $segments[0] : "home";
switch ($page) {
    case "":
    case "home":
        require "home.php";
        break;

    case "login":
        require "login.php";
        break;

    case "register":
        require "register.php";
        break;

    case "artist":
        require "artist.php";
        break;

    case "gallery":
        require "gallery.php";
        break;

    case "dashboard":
        require "dashboard.php";
        break;

    case "logout":
        require "logout.php";
        break;

    case "deleteArtwork":
        if (isset($segments[1]) && is_numeric($segments[1])) {
            $_GET['id_gallery'] = intval($segments[1]); // Simpan ID di $_GET
            require "controller/deleteArtwork.php";
        } else {
            require "404.php";
        }
        break;

    case "profile":
        if (isset($segments[1]) && is_numeric($segments[1])) {
            $_GET['user_id'] = intval($segments[1]); // Simpan user_id di $_GET
            require "profile.php";
        } else {
            require "404.php";
        }
        break;

    default:
        require "404.php";
}

?>