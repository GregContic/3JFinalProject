<?php
include 'db.php';
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
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
