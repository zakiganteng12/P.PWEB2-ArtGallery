<div class="row mb-4 gx-3 border border-dark rounded">
    <div class="col-md-6 p-3">
        <h2>Welcome to ArtGallery</h2>
        <p>Jelajahi dunia seni dengan koleksi terbaik dari berbagai seniman berbakat. 
        Temukan inspirasi melalui lukisan, patung, dan karya seni digital yang penuh makna. 
        Bergabunglah dengan komunitas kami untuk berbagi dan mengapresiasi keindahan seni.</p>
        <?php if(!isset($_SESSION['session_username'])) {  ?>
            <a href="/login"><button class="btn btn-dark">Login</button></a>
            <a href="/register"><button class="btn btn-dark">Register</button></a>
        <?php } ?>
    </div>
    <div class="col-md-6 p-3 ">
        <h2>Artists</h2>
        <p>Temukan karya seni terbaik dari seniman-seniman berbakat di seluruh dunia.</p>
        <a href="/artist"><button class="btn btn-dark">Explore</button></a>
    </div>
</div>

<!-- Carousel -->

<div class="row border border-dark p-3 rounded">
    <div class="col-md-12 text-center p-3">
        <h1 class="mb-4">Showcase</h1>
        <div id="carouselExample" class='carousel slide' data-bs-ride="carousel">
            <div class="carousel-inner border rounded">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="carousel-item active">
                    <img src="<?= htmlspecialchars($row['image_path']) ?>" class="d-block w-100" alt="...">
                </div>
                <?php endwhile; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
