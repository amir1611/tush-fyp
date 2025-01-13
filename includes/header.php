<?php
session_start();
?>

<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <h2>Hijrah Ku <em>Travel</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="packages.php">Packages</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li> -->

                    <!-- Dynamic Login/Signup or Profile Dropdown -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profile
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.php">My Profile</a>
                                <a class="dropdown-item" href="booking.php">My Bookings</a>
                                <a class="dropdown-item" href="reviews.php">Reviews</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="settings.php">Settings</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger ml-3" href="logout.php" role="button">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="btn btn-primary ml-3" href="login.php" role="button">Login</a>
                            <a class="btn btn-outline-primary ml-2" href="signup.php" role="button">Signup</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
