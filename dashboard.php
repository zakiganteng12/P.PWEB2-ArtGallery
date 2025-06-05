<?php 

require 'controller/dashboardController.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtGallery - Dashboard</title>
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

        .carousel-item img {
            height: 600px; 
            object-fit: cover; 
        }

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
        
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<div class="d-flex bg-light flex-grow-1"> 

    <?php require 'components/sidebar.php'; ?>
    
    <div class="main flex-grow-1 d-flex flex-column">
        <nav class="navbar navbar-expand">
            <button class="toggler-btn" type="button">
                <span class="material-symbols-outlined">
                    <img class="" src="assets/grid2.svg" alt="grid" width="30" height="30">
                </span>
            </button>
        </nav>
        <main class="p-3 flex-grow-1">
            <div class="container text-center">
                <?php if($success == 1) { ?>
                <div class="alert alert-primary" role="alert">
                    Profile has successfully updated!
                </div>
                <?php } ?>
                <?php if($success == 2) { ?>
                <div class="alert alert-danger" role="alert">
                    Profile has failed to update! Check your file format!
                </div>
                <?php } ?>
                <h1>Welcome to the Dashboard</h1>
                
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-secondary text-white text-center">
                                <h5 class="mb-0">User Profile</h5>
                            </div>
                            <div class="card-body text-center">
                                
                                <div class="mb-3">
                                    <?php if (!empty($user_profile['profile_picture'])): ?>
                                        <img src="<?php echo $user_profile['profile_picture']; ?>" 
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
                                    <?php echo !empty($user_profile['bio']) ? htmlspecialchars($user_profile['bio']) : 'Update your profile to add a bio.'; ?>
                                </p>

                                
                                <button class="btn btn-outline-primary px-4 mt-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                    <i class="bi bi-pencil-square"></i> Edit Profile
                                </button>
                                <button class="btn btn-outline-primary px-4 mt-2" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                    <i class="bi bi-pencil-square"></i>Upload Your Artwork
                                </button>
                            </div>
                        </div>
                            <div class="card mt-4 shadow-lg border-0">
                                <div class="card-header bg-secondary text-white text-center">
                                    <h5 class="mb-0">Artworks by <?php echo htmlspecialchars($user_profile['name']); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    <?php if ($result_gallery->num_rows > 0): ?>
                                        <?php while ($row = $result_gallery->fetch_assoc()): ?>
                                            <div class="col-md-4 mb-4">
                                                <div class="card art-card shadow-sm">
                                                    <img src="<?= htmlspecialchars($row['image_path']) ?>" 
                                                        class="card-img-top art-thumbnail" 
                                                        alt="<?= htmlspecialchars($row['title']) ?>" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#artworkModal"
                                                        data-title="<?= htmlspecialchars($row['title']) ?>"
                                                        data-artist="<?= htmlspecialchars($row['artist_name']) ?>"
                                                        data-image="<?= htmlspecialchars($row['image_path']) ?>"
                                                        data-artwork-id="<?= $row['id_gallery']; ?>">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                                                        <p class="card-text"> <?= htmlspecialchars($row['artist_name']) ?></p>
                                                        <p class="card-text"> <?= htmlspecialchars($row['id_gallery']) ?></p>
                                                        <form id="deleteForm" method="POST">
                                                        <input type="hidden" name="id_gallery" value="<?= htmlspecialchars($row['id_gallery']) ?>">
                                                        <button type="submit" name="deleteForm" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <p>No artworks found.</p>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once 'components/footer.php'; ?>
    </div>

</div>   

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user_profile['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" id="bio" name="bio"><?php echo htmlspecialchars($user_profile['bio']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Current Profile Picture</label>
                        <br>
                        <img src="<?php echo $user_profile['profile_picture']; ?>" alt="Profile Picture" class="img-thumbnail" style="width: 100px; height: 100px;">
                    </div>

                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Upload New Profile Picture</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                    </div>

                    <button type="submit" name="save_changes" value="save_changes" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

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

<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Your Artwork</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Artwork Title" required>
                    </div>
                    <!-- <div class="mb-3">
                        <input type="text" name="artist_name" class="form-control" placeholder="Artist Name" required>
                    </div> -->
                    <div class="mb-3">
                        <input type="file" name="image_path" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" name="upload" class="btn btn-success">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this artwork?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    <input type="hidden" name="id_gallery" id="artworkId" value="<?php $row['id_gallery'] ?>"> 
                    <button type="submit" name="deleteForm" class="btn btn-danger">Delete</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div> -->



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

<script>
function confirmDelete(event, form) {
    event.preventDefault(); // Hentikan submit form otomatis

    let confirmation = confirm("Apakah Anda yakin ingin menghapus artwork ini?");
    if (confirmation) {
        form.submit(); // Jika user menekan "OK", kirim form
    }
}
</script>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
    let deleteButtons = document.querySelectorAll(".btn-delete");
    let artworkIdInput = document.getElementById("artworkId");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            let artworkId = this.getAttribute("data-artwork-id");
            artworkIdInput.value = artworkId;
        });
    });
});


</script> -->



<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
<script src="js/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
