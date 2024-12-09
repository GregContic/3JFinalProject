<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION["user_id"])) {
    header("Location: /cit17finalproject/php/login.php");
    exit();
}

require_once '../php/config.php';

// Fetch statistics
$userCount = $connection->query("SELECT COUNT(*) as count FROM regislog")->fetch_assoc()['count'];
$appointmentCount = $connection->query("SELECT COUNT(*) as count FROM appointments")->fetch_assoc()['count'];

// Fetch recent users
$recentUsers = $connection->query("SELECT * FROM regislog ORDER BY created_at DESC LIMIT 5");

// Fetch recent appointments
$recentAppointments = $connection->query("SELECT a.*, u.name as client_name 
                                        FROM appointments a 
                                        JOIN regislog u ON a.user_id = u.id 
                                        ORDER BY a.created_at DESC LIMIT 5");
?>

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
    <!--made css for dashboards (its called dash.css)-->
    <style>
        :root {
            --primary-color: #7C9A92;
            --secondary-color: #F4EBE2;
            --accent-color: #ac7b4a;
            --text-color: #2C3639;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: var(--primary-color);
            color: white;
            padding: 2rem;
            position: fixed;
            height: 100vh;
            width: 250px;
        }

        .sidebar h2 {
            font-family: 'Sarala', sans-serif;
            margin-bottom: 2rem;
            font-size: 1.5rem;
        }

        .nav-links {
            list-style: none;
            font-weight: 500;
        }

        .nav-links li {
            margin-bottom: 0.3rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-links i {
            width: 20px;
        }

        /* Main Content Styles */
        .main-content {
            padding: 2rem;
            margin-left: 250px;
        }

        .welcome-header {
            margin-bottom: 2rem;
            margin-right: 200px;
        }

        .welcome-header h1 {
            font-family: 'Sarala', sans-serif;
            color: #346356;
            margin-bottom: 0.5rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            text-align: center;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .stat-card h2{
            color: #346356;
        }
        .stat-card h3 {
            color: var(--accent-color);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            color: var(--text-color);
            opacity: 0.8;
        }

        /* Recent Activity Sections */
        .recent-section {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .recent-section h2 {
            color: #346356;
            margin-bottom: 1rem;
            font-family: 'Sarala', sans-serif;
        }

        .activity-list {
            list-style: none;
        }

        .activity-list li {
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .activity-list li:last-child {
            border-bottom: none;
        }

        .activity-list .date {
            color: var(--accent-color);
            font-size: 0.9rem;
        }

        /* Logout Button */
        .logout-btn {
            position: absolute;
            bottom: 2rem;
            width: calc(100% - 4rem);
            padding: 1rem;
            font-weight: 500;
            font-size: 0.9rem;
            text-align: left;
            background-color: var(--primary-color);
            color: white;
            border: 1px solid transparent;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: white;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Mind & Mingle</h2>
            <nav>
                <ul class="nav-links">
                    <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="bookings.php"><i class="fa-solid fa-book"></i> Bookings </a></li>
                    <li><a href="services.php"><i class="fa-solid fa-heart"></i> Services </a></li>
                    <li><a href="schedules.php"><i class="fa-solid fa-calendar-days"></i> Schedule</a></li>
                    <li><a href="transactions.php"><i class="fa-solid fa-file-invoice-dollar"></i> Payments <br>& Reports</a></li>
                </ul>
            </nav>
            <form action="logout.php" method="POST">
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="welcome-header">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?></h1>
                <p>Here's what's happening with your clinic today</p>
            </div>

            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3><?php echo $userCount; ?></h3>
                    <p>Total Users</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $appointmentCount; ?></h3>
                    <p>Total Appointments</p>
                </div>
                <!-- Add more stat cards as needed -->
            </div>

            <!-- Recent Users -->
            <section class="recent-section">
                <h2>Recent Users</h2>
                <ul class="activity-list">
                    <?php while($user = $recentUsers->fetch_assoc()): ?>
                    <li>
                        <div class="user-info">
                            <strong><?php echo htmlspecialchars($user['name']); ?></strong>
                            <span class="date"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></span>
                        </div>
                        <div><?php echo htmlspecialchars($user['email']); ?></div>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </section>

            <!-- Recent Appointments -->
            <section class="recent-section">
                <h2>Recent Appointments</h2>
                <ul class="activity-list">
                    <?php while($appointment = $recentAppointments->fetch_assoc()): ?>
                    <li>
                        <div class="appointment-info">
                            <strong><?php echo htmlspecialchars($appointment['client_name']); ?></strong>
                            <span class="date"><?php echo date('M d, Y', strtotime($appointment['appointment_date'])); ?></span>
                        </div>
                        <div><?php echo htmlspecialchars($appointment['service_type']); ?></div>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        </main>
    </div>
</body>
</html>
