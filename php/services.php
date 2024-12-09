<?php
include 'db.php'; // Ensure this file is correctly included

// SQL query to select all services
$result = $conn->query("SELECT * FROM services");

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Fetch all services
$services = $result->fetch_all(MYSQLI_ASSOC);

// Close the connection
$conn->close();

// Display the services
foreach ($services as $service) {
    echo $service['service_name'] . "<br>";
    echo $service['service_description'] . "<br><br>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services</title>
    <link rel="stylesheet" href="css\styles.css">
</head>
<body>
    <header><h1>Our Services</h1></header>
    <div class="container">
        <table border="1">
            <tr>
                <th>Service Name</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['service_name']; ?></td>
                    <td><?= $row['description']; ?></td>
                    <td><?= $row['duration']; ?> mins</td>
                    <td>$<?= $row['price']; ?></td>
                    <td><a href="booking.php?service_id=<?= $row['service_id']; ?>" class="btn">Book Now</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
