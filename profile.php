<?php
require 'controller/profileController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($user_profile['name']); ?> - Profile</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .art-thumbnail {
            cursor: pointer;
            transition: transform 0.2s;
        }
        .art-thumbnail:hover {
            transform: scale(1.05);
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="d-flex bg-light flex-grow-1"> 

    <?php require 'components/sidebar.php'; ?>
    
    <div class="main flex-grow-1 d-flex flex-column">
        <nav class="navbar navbar-expand">
            <button class="toggler-btn" type="button">
                <span class="material-symbols-outlined">
                    <img src="../assets/grid2.svg" alt="grid" width="30" height="30">
                </span>
            </button>
        </nav>
        <main class="p-3 flex-grow-1">
            <div class="container-fluid">
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-success text-white text-center">
                                <h5 class="mb-0">Artist Profile</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <?php if (!empty($user_profile['profile_picture'])): ?>
                                        <img src="<?php echo $imagepath; ?>" 
                                            alt="Profile Picture" 
                                            class="img-fluid rounded-circle border" 
                                            style="width: 120px; height: 120px; object-fit: cover;">
                                    <?php else: ?>
                                        <img src="default-avatar.png" 
                                            alt="Default Profile Picture" 
                                            class="img-fluid rounded-circle border" 
                                            style="width: 120px; height: 120px; object-fit: cover;">
                                        <p class="text-muted mt-2">No profile picture uploaded</p>
                                    <?php endif; ?>
                                </div>
                                <h4 class="fw-bold">
                                    <?php echo !empty($user_profile['name']) ? htmlspecialchars($user_profile['name']) : '<span class="text-muted">Your Name</span>'; ?>
                                </h4>
                                <p class="text-muted">
                                    <?php echo !empty($user_profile['bio']) ? htmlspecialchars($user_profile['bio']) : 'User belum menambah bio'; ?>
                                </p>
                            </div>
                        </div>

                        <div class="card mt-4 shadow-lg border-0">
                            <div class="card-header bg-secondary text-white text-center">
                                <h5 class="mb-0">Artworks by <?php echo htmlspecialchars($user_profile['name']); ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    if ($result_gallery->num_rows > 0): ?>
                                        <?php while ($artwork = $result_gallery->fetch_assoc()): ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="card">
                                                    <img src="<?php echo "../" . htmlspecialchars($artwork['image_path']); ?>" 
                                                        alt="<?php echo htmlspecialchars($artwork['title']); ?>" 
                                                        class="card-img-top art-thumbnail" 
                                                        style="height: 150px; object-fit: cover;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#artworkModal"
                                                        data-title="<?php echo $artwork['title']; ?>"
                                                        data-image="<?php echo "../" . $artwork['image_path']; ?>">
                                                    <div class="card-body text-center">
                                                        <h6 class="card-title"><?php echo $artwork['title']; ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <p class="text-muted text-center">No artworks available yet.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <a href="/artist" class="">
                            <button class="btn btn-secondary">Back</button>
                        </a>
                    </div>
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
                <p id="modalArtworkDescription"></p>
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
            var description = button.getAttribute("data-description");
            var imageSrc = button.getAttribute("data-image");

            document.getElementById("artworkModalLabel").textContent = title;
            document.getElementById("modalArtworkDescription").textContent = description;
            document.getElementById("modalArtworkImage").src = imageSrc;
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
