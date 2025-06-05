<?php
session_start();
require 'controller/artistController.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtGallery - Artist</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0&icon_names=menu" />
    <style>
        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 50;
        }

        a {
            text-decoration: none;
        }
</style>
</head>
<body d-flex flex-column min-vh-100>

<div class="d-flex bg-light flex-grow-1"> 

    <?php require 'components/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="main flex-grow-1 d-flex flex-column">
        <nav class="navbar navbar-expand">
            <button class="toggler-btn" type="button">
            <span class="material-symbols-outlined">
                <img class="" src="assets/grid2.svg" alt="grid" width="30" height="30">
            </span>
            </button>
        </nav>
        <main class="p-3 flex-grow-1">
            <div class="container-fluid">
                <!-- START HERE -->
                <div class="container mt-4">
                    <h2 class="text-center mb-4">Daftar Artis</h2>
                    <div class="row">
                        <?php while ($artist = $result->fetch_assoc()): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm">
                                    <img src="<?= !empty($artist['profile_picture']) ? $artist['profile_picture'] : 'assets/default-avatar.png'; ?>" 
                                        class="card-img-top" alt="Profile Picture" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($artist['name']); ?></h5>
                                        <p class="card-text"><?= !empty($artist['bio']) ? htmlspecialchars($artist['bio']) : "Belum ada bio"; ?></p>
                                        <p><strong>Karya:</strong> <?= $artist['total_artworks']; ?></p>
                                        <a href="/profile/<?= $artist['user_id']; ?>" class="btn btn-primary btn-sm">Lihat Profil</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                
            </div>
        </main>

        <?php require 'components/footer.php'; ?>
    </div>

</div>   
<script src="js/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>