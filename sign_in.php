<?php
    include 'db.php';
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name =$_POST['name'];
        $email =$_POST['email'];
        $ph_number =$_POST['ph_number'];
        $password =$_POST['password'];
        $role=$_POST['role'];

        if (!empty($name)&& !empty ($email)){
            $sql= "INSERT INTO cars (name, email, ph_number, password, role) VALUES ('$name','$email','$ph_number','$password', '$role')";

            if ($conn->query($sql)=== TRUE){
                echo "DONE!";
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
        Name: <input type="text" name="name"><br><br>
        E-mail: <input type="text" name="email"><br><br>
        Contact Number: <input type="text" name="ph_number"><br><br>
        Password: <input type="text" name="password"><br><br>
        Role: <input type="text" name="role"><br><br>
        <input type="submit" value ="Submit"><br><br>
    </form>
    <a href="index.php">Back to List</a>
    </body>
</html>
