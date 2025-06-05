<?php
require_once('controller/registerController.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtGallery - Register</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0&icon_names=menu" />
    <style>
        body {
            background-image: url('assets/login-bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;

            
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(10px);
            z-index: -1;
        }
    </style>
</head>
<body d-flex min-vh-100 mb-3 >
    <!-- wrapper -->
    <div class="d-flex justify-content-center align-items-center vh-100">
        <!-- Main -->
        <div class="container bg-light">
            <!-- Login -->
            <div class="row border border-dark rounded border-opacity-50">
                <!-- Left Box -->
                <div class="col-md-6 p-3 border rounded">
                    <div class="">
                        <img class="w-100 border rounded" src="assets/login-image.jpg">
                    </div>
                </div>
                <!-- Right Box -->
                <div class="col-md-6 p-4">
                    <div class="text-center pb-4">
                        <h1>Register</h1>
                    </div>
                    <?php if($err) { ?>
                        <div class="alert alert-danger" id="loginalert">
                            <ul><?php echo $err ?></ul>
                        </div>
                    <?php } ?>
                    <form id="loginform" method="post" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <!-- <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1" >
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div> -->
                        <button type="submit" name="register" value="register" class="btn btn-success mb-3">Register</button>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="/home"><button type="button" class="btn btn-dark">Home</button></a>
                            <div class="d-flex align-items-center">
                                <span class="fs-6 mx-2">Already registered?</span>
                                <a id="regbtn" href="/login">
                                    <button type="button" class="btn btn-dark">Login</button>
                                </a>  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
   
 
<script src="js/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>