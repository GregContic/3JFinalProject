<?php
    include "db.php";

    if (isset($_GET['id'])){
        $id =$_GET['id'];

        $sql= "SELECT * FROM units WHERE id=$id";
        $result=$conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc ();
            $model =$row ['model'];
            $brand =$row ['brand'];
            $year =$row ['year'];
            $price =$row ['price'];

        }else{
            echo "NO RECORDS FOUND";
        }

    }
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $model=$_POST['model'];
    $brand=$_POST['brand'];
    $year=$_POST['year'];
    $price=$_POST['price'];
    
    if (!empty($model)&& !empty ($brand)&& !empty ($year)&& !empty ($price)){
        $sql= "UPDATE units SET model=$model, brand=$brand, year=$year, price=$price";

        if ($conn->query($sql)=== TRUE){
            echo "UPDATED!";
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
    <title>Update Car</title>
</head>
<body>
    <h2>Update Rides</h2>

    <form method = "post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">>
        Model: <input type="text" name="model" value="<?php echo $model; ?>"><br><br>
        Make: <input type="text" name="brand" value="<?php echo $brand; ?>"><br><br>
        Year: <input type="text" name="year" value="<?php echo $year; ?>"><br><br>
        Price: <input type="text" name="price" value="<?php echo $price; ?>"><br><br>
        <input type="submit" value ="Submit"><br><br>
    </form>
    <a href="index.php">Back to List</a>
    </body>
</html>