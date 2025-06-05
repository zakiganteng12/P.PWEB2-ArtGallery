
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-toggle border-end border-dark pe-2" style="--bs-border-opacity: .2;">
            <div class="sidebar-logo">
                <a class="text-dark" id="font-logo" href="#">ArtGallery</a>
            </div>
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav p-0">
                <!-- <li class="sidebar-header">
                    Main
                </li> -->
                <li class="sidebar-item">
                    <a href="/" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/gallery" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Gallery</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/artist" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Artist</span>
                    </a>
                </li>
                <!-- <li class="sidebar-header">
                    Pages
                </li> -->
                <?php if(!isset($_SESSION['session_username'])) {
                         ?>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="true" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/login" class="sidebar-link">Login</a>
                        </li>
                        
                        <li class="sidebar-item">
                            <a href="/register" class="sidebar-link">Register</a>
                        </li>
                        
                    </ul>
                </li>
                <?php } ?>
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Notification</span>
                    </a>
                </li> -->
                <li class="sidebar-item">
                    <a href="/dashboard" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <?php if(isset($_SESSION['session_username'])) { ?>
                <li class="sidebar-item">
                        <i class="lni lni-cog"></i>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal" style="margin-left: 25px;">Logout</button>
                </li>
                <?php } ?>
            </ul>
        </aside>

        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="/logout"><button type="button" class="btn btn-danger">Yes</button></a>
                </div>
                </div>
            </div>
        </div>
        <!-- Sidebar Ends -->