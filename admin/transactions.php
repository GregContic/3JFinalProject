<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Mind & Mingle</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Sarala:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dash.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Mind & Mingle</h2>
            <nav>
                <ul class="nav-links">
                    <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="bookings.php"><i class="fa-solid fa-book"></i> Bookings </a></li>
                    <li><a href="services.php"><i class="fa-solid fa-heart"></i> Services </a></li>
                    <li><a href="schedules.php"><i class="fa-solid fa-calendar-days"></i> Schedule</a></li>
                    <li><a href="#"><i class="fa-solid fa-file-invoice-dollar"></i> Payments & Reports</a></li>
                </ul>
            </nav>
            <form action="logout.php" method="POST">
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </aside>
        <!--Main Content-->
        <main>
            <header class="welcome-header">
                <h1>Payments & Reports</h1>
            </header>
            <div class="list-container">
                <!--add list here-->
            </div>
        </main>
    </div>
</body>