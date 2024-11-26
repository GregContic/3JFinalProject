<?php
    include "db.php";

    $sql="Select * from units";
    $result=$conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>
</head>
<body>
    <h2>CARS</h2>

    <table border="1">
        <tr>
            <th>Model</th>
            <th>Make</th>
            <th>Year</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php
            if ($result->num_rows >0){
                while ($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['brand'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td><a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
                    echo "<td><a href='edit.php?id=" . $row['id'] . "'>Update</a></td>";

                }
            }else{
                echo "<tr><td colspan='3'>NO DISPLAY</td><tr>";
            }

        ?>
    </table>
    <a href="add.php">Add New</a>
</body>
</html>