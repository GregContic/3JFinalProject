<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "cit17servicesandshit";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_POST["submit"])) {
    $email = $connection->real_escape_string($_POST["email"]);
    $password = $_POST["password"];

    // Prepare statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM regislog WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            session_start();
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            header("Location: /cit17finalproject/index.html");
            exit();
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('User not registered');</script>";
    }
    $stmt->close();
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Mind & Mingle</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Actor&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Sarala:wght@400;700&display=swap" rel="stylesheet">
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
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login_form {
            background: white;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            margin-top: -50px;
        }

        .login_form h3 {
            color: var(--primary-color);
            font-family: 'Sarala', sans-serif;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .input_box {
            margin-bottom: 1.5rem;
        }

        .input_box label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            font-weight: 500;
        }

        .input_box input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .input_box input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        button[type="submit"] {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #346356;
        }

        .sign_up {
            text-align: center;
            margin-top: 1rem;
        }

        .sign_up a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
        }

        .sign_up a:hover {
            text-decoration: underline;
        }

        .back-to-home {
            position: absolute;
            top: 20px;
            left: 20px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color 0.3s ease;
        }

        .back-to-home:hover {
            color: var(--accent-color);
        }
    </style>
    
</head>
<body>
    <a href="/cit17finalproject/index.html" class="back-to-home">
        ← Back to Home
    </a>
    <div class="login_form">
        <form action="login.php" method="POST">
            <h3>Welcome Back</h3>
            <div class="input_box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required />
            </div>
            <div class="input_box">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required />
            </div>
            <button type="submit" name="submit">Login</button>
            <p class="sign_up">Don't have an account? <a href="/cit17finalproject/php/register.php">Register</a></p>
        </form>
    </div>
</body>
</html>
