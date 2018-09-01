<?php

session_start();
include 'db.php';

if(!isset($_POST['submission_id'])){

    $_SESSION['message'] = "Error. Blank data found.";

}else{

    $sub_id = $_POST['submission_id'];
    $form_id = $_POST['formID'];
    $ip = $_POST['ip'];
    $f_name = $_POST['name']['0'];
    $l_name = $_POST['name']['1'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql1 = "SELECT c.code, s.*
    FROM code as c
    JOIN survey_data as s
    ON c.id = s.code_id WHERE s.email='$email'";

    $result1 = $conn->query($sql1);

    if(mysqli_num_rows($result1) > 0){

        $_SESSION['message'] = "You are already registered.";

    }else{

        $sql = "INSERT INTO survey_data (submission_id, form_id, ip, first_name, last_name, city, email, phone) VALUES ('$sub_id', '$form_id', '$ip', '$f_name', '$l_name', '$city', '$email', '$phone')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Submit Successfully.";   
        } else {

            $_SESSION['message'] = "Submit Unsuccessfull.";
        }

    }

}

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/main.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="w-50 mx-auto mt-4">

            <?php if($_SESSION['message'] && $_SESSION['message'] != ''){ ?>
                <div id="message" class="alert alert-primary">
                    <?php
                    echo $_SESSION['message'];
                    $_SESSION['message'] = '';
                    ?>
                </div>          
            <?php } ?>



            <div>
                <h1>Thank You.</h1>
            </div>
        </div>
    </div>



    <!-- loading screen
    <div id="loading">
        <div id="load-window">
            <div id="load-window-content">       
                <h3 class="h3 text-center" id="loading-text-2">Redirecting .... Please Wait</h3>
            </div>
        </div>    
    </div> -->


<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="./public/main.js"></script>

<!-- <script>

    setTimeout(function(){
        $('#loading').show();

        setTimeout(function(){
            
            // var host = window.location.hostname;
            var route= "/csv-upload/";
            window.location = route;            
            $('#loading').hide();

        }, 3000)

    }, 4000);

</script> -->

</body>
</html>