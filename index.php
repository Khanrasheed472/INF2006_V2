<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start(); // Start or resume the session

// Include database info
include "/var/www/inc/dbinfo.inc"; // Adjust the path as necessary

try {
    // Establish database connection using PDO
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Include your classes after establishing the PDO connection
    include_once 'user.php'; // Adjust paths as necessary for your class files
    // Initialize User object with PDO connection
    $getFromU = new User($pdo);

} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}

// User login check
if (isset($_SESSION['UserId'])) {
    header('Location: templates/3-Dashboard.php');
    exit();
}

// Validate credentials and log the user in
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Assuming User class has login method that returns user ID on success or false on failure
    $userId = $getFromU->login($username, $password);
    
    if ($userId) {
        $_SESSION['UserId'] = $userId; // Set user ID in session
        header('Location: templates/3-Dashboard.php'); // Redirect to dashboard
        exit();
    } else {
        $error = "The username or password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="static/images/wallet.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="static/css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <title>Expense Management</title>
</head>

<body>
    <div class="container">

        <div class="mob-hidden">
            <h1>EMS</h1>
        </div>

        <div class="top-heading">
            <h1>Expense Management System</h1>
        </div>
        <form action="index.php" method="post" onsubmit = "return validate()" id="form1">

            <div class="group">


                <div class="form-controller">
                <i class="fa fa-user-plus u3" aria-hidden="true"></i>
                <input type="text" name="username" placeholder="Username" id="user1" required>
                <br>
                <small></small>
                </div>

                <div class="form-controller">
                <i class="fa fa-key u4" aria-hidden="true"></i>
                <input type="password" name="password" placeholder="Password" id="pass1" autocomplete="on" required>
                <br>
                <small></small>
                </div>

            </div>
            <button type="submit" class="sign-in" name="login">Log In</button>

            <br>
            <?php
                if (isset($error)) {
                    $font = "Source Sans Pro";
                    echo '<div style="color:  red;font-family:'.$font.';">'.$error.'</div>';
                }
            ?>
            
            <div class="new-account">
                <span style="color: rgba(0, 0, 0, 0.54); font-weight: bolder; font-family: 'Source Sans Pro';">Don't have an account?</span> 
                <a href="templates/2-sign-up.php" style="text-decoration: none;"><span style="color: rgba(5, 0, 255, 0.81); font-weight: bolder; font-family: 'Source Sans Pro';">Sign Up Now</span></a>
            </div>

        </form>

        <div class="img-container">
            <img src="static/images/login.png" alt="Login-screen-picture">
        </div>
    </div>

<script src="static/js/index.js"></script>
</body>

</html>