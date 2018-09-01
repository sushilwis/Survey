<?php

/* Main page with two forms: sign up and log in */
// echo 'this is login php<br>';
session_start();
include 'db.php';


/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$pass = $_POST['password'];
// echo $pass.'<br>';

$sql = "SELECT * FROM password WHERE password='$pass'";
$result = $conn->query($sql);

// print_r($result);

// exit();

// mysqli_num_rows($result1) > 0

// $ = mysqli_query($conn, "SELECT * FROM password WHERE password='$pass'");


// echo $result->num_rows.'<br>';
// $result->num_rows == 0

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "Password doesn't exist!";
    header("location: admin.php");
} else { // User exists
    $data = $result->fetch_assoc();
    // if ( password_verify($_POST['password'], $user['password']) ) {
        
        // $_SESSION['email'] = $user['email'];
        // $_SESSION['first_name'] = $user['first_name'];
        // $_SESSION['last_name'] = $user['last_name'];
        // $_SESSION['active'] = $user['active'];
        
        // This is how we'll know the user is logged in
        $_SESSION['id'] = $data['id'];
        $_SESSION['logged_in'] = 'true';

        $_SESSION['message'] = "Successfully Logged in.";
        header("location: adminDashboard.php");
}



?>