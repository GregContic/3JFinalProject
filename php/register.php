<?php
require 'config.php';
// Database configuration
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$database = "cit17servicesandshit"; // Replace with your database name

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_POST["submit"])) {
    // Sanitize and validate input
    $name = $connection->real_escape_string($_POST["name"]);
    $email = $connection->real_escape_string($_POST["email"]);
    $number = $connection->real_escape_string($_POST["number"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Check for duplicate email or name
    $stmt = $connection->prepare("SELECT * FROM regislog WHERE email = ? OR name = ?");
    $stmt->bind_param("ss", $email, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Name or Email already exists');</script>";
    } else {
        if ($password === $confirmPassword) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert into the database
            $stmt = $connection->prepare("INSERT INTO regislog (name, email, phone_number, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $number, $hashedPassword);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful');</script>";
            } else {
                echo "<script>alert('Registration failed. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match. Please try again.');</script>";
        }
    }

    $stmt->close();
}

$connection->close();
?>




<!DOCTYPE html>
<!-- Source Codes By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Mind & Mingle</title>
    <link rel="stylesheet" href="/cit17finalproject/css/register.css">
</head>
<body>
    <div class="register_form">
    <form action="register.php" method="POST">
    <h3>Create Account</h3>
    <div class="input_box">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your full name" required />
    </div>
    <div class="input_box">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email address" required />
    </div>
    <div class="input_box">
        <label for="number">Phone Number</label>
        <input type="number" id="number" name="number" placeholder="Enter your phone number" required />
    </div>
    <div class="input_box">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Create a password" required />
    </div>
    <div class="input_box">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required />
    </div>
    <button type="submit" name="submit">Register</button>
    <p class="sign_up">Already have an account? <a href="/cit17finalproject/php/login.php" style="font-weight: bold;">Log In</a></p>
</form>

    </div>
</body>
</html>
