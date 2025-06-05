<?php

session_start();

require 'db.php';

// Check Connection
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

$err = '';
$username = '';
$remember = '';


if (isset($_COOKIE['cookie_username'])) {
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_password = $_COOKIE['cookie_password'];

    
    $sql1 = "SELECT * FROM users WHERE username = ?";
    $query1 = $koneksi->prepare($sql1);
    $query1->bind_param("s", $cookie_username);
    $query1->execute();
    $result1 = $query1->get_result();
    $user1 = $result1->fetch_assoc();

   
    if ($user1 && password_verify($cookie_password, $user1['password'])) {
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['user_id'] = $user1['id']; 
        header('Location: /dashboard');
        exit();
    }
}


if (isset($_SESSION['session_username'])) {
    header('Location: /dashboard');
    exit();
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? 1 : 0;

    
    if (empty($username) || empty($password)) {
        $err = "<li class='text-center'>Please insert your username and password</li>";
    } else {
        
        $sql = "SELECT * FROM users WHERE username = ?";
        $query = $koneksi->prepare($sql);
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();

        
        if (!$user) {
            $err = "<li class='text-center'>Username is not valid</li>";
        } elseif (!password_verify($password, $user['password'])) {
            $err = "<li class='text-center'>Password is not valid</li>";
        }

        
        if (empty($err)) {
            $_SESSION['session_username'] = $username;
            $_SESSION['user_id'] = $user['id_user'];

           
            if ($remember) {
                setcookie('cookie_username', $username, time() + (60 * 60 * 24 * 30), '/');
                setcookie('cookie_password', $user['password'], time() + (60 * 60 * 24 * 30), '/');
            }

            header('Location: /dashboard');
            exit();
        }
    }
}

?>