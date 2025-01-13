<?php

// Include the database connection
include '../includes/db_connection.php';

// Check the agency verification status
$verification_status = 'pending';
if (isset($_SESSION['user_id'])) {
    $agency_id = $_SESSION['user_id'];
    $query = "SELECT verification FROM agency_profiles WHERE agency_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $agency_id);
    $stmt->execute();
    $stmt->bind_result($verification_status);
    $stmt->fetch();
    $stmt->close();
}
?>

<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="agency.php">
                <h2>Hijrah Ku <em>Agency</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_profile.php">Manage Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $verification_status === 'pending' ? 'disabled' : ''; ?>"
                            href="<?php echo $verification_status === 'pending' ? '#' : 'manage_packages.php'; ?>"
                            onclick="<?php echo $verification_status === 'pending' ? 'return alert(\'Waiting for admin approval.\')' : ''; ?>">
                            Manage Packages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $verification_status === 'pending' ? 'disabled' : ''; ?>"
                            href="<?php echo $verification_status === 'pending' ? '#' : 'manage_update.php'; ?>"
                            onclick="<?php echo $verification_status === 'pending' ? 'return alert(\'Waiting for admin approval.\')' : ''; ?>">
                            Packages Update
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Book
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="booking.php">Book</a>
                            <a class="dropdown-item" href="review.php">Review</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-danger ml-3" href="logout.php" role="button">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>