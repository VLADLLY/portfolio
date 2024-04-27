<?php 
// Start the session
session_start();

// Include the database connection file
include('../includes/connect.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both email and password are provided
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // Escape user inputs for security
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        // Query to check if the provided credentials match in the database
        $sql = "SELECT * FROM admin_login WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // If credentials match, set session variables and redirect to dashboard.php
            $_SESSION['email'] = $email;
            header("location: ../Admin/landing.php"); // Redirect to the dashboard page
            exit();
        } else {
            // If credentials don't match, redirect back to login.php
            header("location: admin_login.php?error=1"); // Redirect back to the login page with an error parameter
            exit();
        }
    } else {
        // If email or password is not provided, redirect back to login.php
        header("location: admin_login.php?error=2"); // Redirect back to the login page with an error parameter
        exit();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="log.css"> <!-- Make sure this CSS file exists -->
    <title>Admin Login</title>
</head>
<body style="background-image: url(for.png); background-size: cover; height: 100%;">
    <section id="log" class="in">
        <form action="" method="post"> <!-- Make sure this action points to the correct PHP script -->
            <div class="login wrap">
            <img src="../img/removeu.png" alt="" class="logo" style="width: 70px;">
                <div class="h1" style="text-align: center;">Welcome Admin</div>
                <?php 
                    if(isset($_GET['error']) && $_GET['error'] == 1) {
                        echo '<div style="color: red; text-align: center;">Invalid email or password.</div>';
                    } elseif(isset($_GET['error']) && $_GET['error'] == 2) {
                        echo '<div style="color: red; text-align: center;">Email and password are required.</div>';
                    }
                ?>
                <input pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" placeholder="Email" id="email" name="email" type="text" required>
                <input placeholder="Password" id="password"  name="password" required type="password">
                <input value="Login" class="btn2" type="submit"> <!-- Changed type to 'submit' -->
            </div>
        </form>
    </section>
    <div class="context">
    </div>
    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</body>
</html>
