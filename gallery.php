<?php 
session_start();

 require 'controller/db.php';
 $sql = "SELECT gallery.id_gallery, gallery.title, gallery.image_path, profile.name AS artist_name FROM gallery JOIN profile ON gallery.user_id = profile.user_id";
 $result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtGallery - Gallery</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .art-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .art-card img:hover {
            transform: scale(1.05);
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<div class="d-flex bg-light flex-grow-1"> 
    <?php require 'components/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="main flex-grow-1 d-flex flex-column">
        <nav class="navbar navbar-expand">
            <button class="toggler-btn" type="button">
                <span class="material-symbols-outlined">
                    <img src="assets/grid2.svg" alt="grid" width="30" height="30">
                </span>
            </button>
        </nav>
        <main class="p-3 flex-grow-1">
            <div class="container-fluid">

                

                
                <div class="row">
                    <div class="col-md-4 border rounded-start border-dark p-4 border-opacity-50">
                        <h2 class="text-start mb-4">Share Your Arts!</h2>
                        <?php if(!isset($_SESSION['session_username'])) { ?>
                        <a href="/login" class=""><button class="btn btn-dark">Login</button></a>
                        <a href="/register" class=""><button class="btn btn-dark">Register</button></a>
                        <?php } else { ?>
                        <a href="/dashboard.php" class=""><button class="btn btn-dark">Upload</button></a>
                        <?php } ?>
                    </div>

                    <div class="col-md-8 border rounded-end border-dark p-4 border-opacity-50">
                        <h2 class="text-start mb-4">Why Share Your Art?</h2>
                        <p class="text-start">
                            Showcase your creativity to the world! Upload your artwork and connect with fellow artists. 
                            Sharing your art not only helps you gain exposure but also inspires others in the community.
                        </p>
                        <!-- <button class="btn btn-success">Upload</button> -->
                    </div>


                    <h2 class="mb-4 text-center mt-4">Gallery</h2>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card art-card shadow-sm">
                                <img src="<?= htmlspecialchars($row['image_path']) ?>" 
                                    class="card-img-top art-thumbnail" 
                                    alt="<?= htmlspecialchars($row['title']) ?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#artworkModal"
                                    data-title="<?= htmlspecialchars($row['title']) ?>"
                                    data-artist="<?= htmlspecialchars($row['artist_name']) ?>"
                                    data-image="<?= htmlspecialchars($row['image_path']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                                    <p class="card-text">By <?= htmlspecialchars($row['artist_name']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No artworks found.</p>
                <?php endif; ?>
                </div>
            </div>
        </main>
        <?php require 'components/footer.php'; ?>
    </div>
</div>   

<!-- MODAL ARTWORK -->
<div class="modal fade" id="artworkModal" tabindex="-1" aria-labelledby="artworkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="artworkModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalArtworkImage" src="" class="img-fluid mb-3" style="max-height: 400px; object-fit: contain;">
                <p id="modalArtworkArtist"></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var artworkModal = document.getElementById("artworkModal");
        artworkModal.addEventListener("show.bs.modal", function(event) {
            var button = event.relatedTarget;
            var title = button.getAttribute("data-title");
            var artist = button.getAttribute("data-artist");
            var imageSrc = button.getAttribute("data-image");

            document.getElementById("artworkModalLabel").textContent = title;
            document.getElementById("modalArtworkArtist").textContent = "By " + artist;
            document.getElementById("modalArtworkImage").src = imageSrc;
        });
    });
</script>

<script src="js/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
