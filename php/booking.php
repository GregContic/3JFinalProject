<?php
include 'db.php';
$service_id = $_GET['service_id'];
// Fetch service details
$sql = "SELECT * FROM services WHERE service_id = $service_id";
$result = $conn->query($sql);
$service = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="css\styles.css">
</head>
<body>
    <header><h1>Book Your Appointment</h1></header>
    <div class="container">
        <h2><?= $service['service_name']; ?></h2>
        <p><?= $service['description']; ?></p>
        <form action="confirm_booking.php" method="POST">
            <input type="hidden" name="service_id" value="<?= $service['service_id']; ?>">
            <label for="date">Select Date:</label>
            <input type="date" name="date" required>
            <label for="time">Select Time:</label>
            <input type="time" name="time" required>
            <button type="submit" class="btn">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
