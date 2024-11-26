<?php
    include 'db.php';
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $model =$_POST['model'];
        $brand =$_POST['brand'];
        $year =$_POST['year'];
        $price =$_POST['price'];

        if (!empty($model)&& !empty ($brand)&& !empty ($year)&& !empty ($price)){
            $sql= "INSERT INTO units (model, brand, year, price) VALUES ('$model','$brand','$year','$price')";

            if ($conn->query($sql)=== TRUE){
                echo "New Data Acquired!";
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
    <title>Add New Car</title>
</head>
<body>
    <h2>Add new Rides</h2>

    <form method = "post" action="add.php">
        Model: <input type="text" name="model"><br><br>
        Make: <input type="text" name="brand"><br><br>
        Year: <input type="text" name="year"><br><br>
        Price: <input type="text" name="price"><br><br>
        <input type="submit" value ="Submit"><br><br>
    </form>
    <a href="index.php">Back to List</a>
    </body>
</html>