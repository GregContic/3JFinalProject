<?php
    include 'db.php';
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $service_name =$_POST['service_name'];
        $description =$_POST['description'];
        $duration =$_POST['duration'];
        $price =$_POST['price'];

        if (!empty($service_name)&& !empty ($description)&& !empty ($duration)&& !empty ($price)){
            $sql= "INSERT INTO units (service_name, description, duration, price) VALUES ('$service_name','$description','$duration','$price')";

            if ($conn->query($sql)=== TRUE){
                echo "New Service Added!";
            }else{
                echo "FAILED";
            }
        }else{
            echo "Incomplete Details";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service</title>
</head>
<body>
    <h2>Add new Service</h2>

    <form method = "post" action="add.php">
        Service Name: <input type="text" name="service_name"><br><br>
        Description: <input type="text" name="description"><br><br>
        Duration: <input type="text" name="duration"><br><br>
        Price: <input type="text" name="price"><br><br>
        <input type="submit" value ="Submit"><br><br>
    </form>
    <a href="index.php">Back to List</a>
    </body>
</html>
