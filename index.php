<?php

session_start();
include 'db.php';

if(!isset($_POST['submission_id'])){

    $_SESSION['message'] = "";
    header("Location: ./form.php");

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

        $user = mysqli_fetch_assoc($result1);
        $promoCode = $user['code'];
        $msg = "You are already validated. Your promo code is ".$promoCode;
        // $_SESSION['promo_code'] = $promoCode;
        // exit();
    }else{

        $sql = "INSERT INTO survey_data (submission_id, form_id, ip, first_name, last_name, city, email, phone) VALUES ('$sub_id', '$form_id', '$ip', '$f_name', '$l_name', '$city', '$email', '$phone')";

        if ($conn->query($sql) === TRUE) {

            $id = $conn->insert_id;
            $_SESSION['message'] = "Submit Successfully.";
            
            $sql2 = "SELECT code FROM code WHERE assignable='0'";
            $result = $conn->query($sql2);

            if(mysqli_num_rows($result) > 0){
                // $code = mysqli_fetch_assoc($result);
                $code_arr = [];

                while($code = mysqli_fetch_assoc($result)){        
                    array_push($code_arr, $code['code']);
                    // print_r($code['code']);
                    // print_r($code_arr);
                }

                // print_r($code_arr);
                // exit();

                // echo '<pre>'; print_r($code_arr); echo '</pre>';
                // print_r($code_arr);

                $randomIndex = array_rand($code_arr, 1);
                $randomCode = $code_arr[$randomIndex];
                // print_r($_SERVER);
                // echo $randomCode;
                $sql5 = "SELECT * FROM code WHERE code='$randomCode'";
                $result2 = $conn->query($sql5);

                // echo 'main id : ';
                $codeData = mysqli_fetch_assoc($result2);
                $codeId = $codeData['id'];
                $user_code = $codeData['code'];

                // echo "code id ".$codeId." and code is ".$user_code;

                // exit();

                $sql3 = "UPDATE survey_data SET code_id='$codeId' WHERE id='$id'";

                if ($conn->query($sql3) === TRUE) {
                    // echo 'survey data updated with code id.';
                    $sql4 = "UPDATE code SET assignable='1' WHERE id='$codeId'";
                    if ($conn->query($sql4) === TRUE) {                       
                        $msg = 'Validation successfull. Your promo code is '.$user_code;
                    }
                }
            }else{
                $_SESSION['message'] = "Sorry, There is no promo code to assign.";
            }
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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 

    <link rel="stylesheet" href="./public/main.css">
    <title>Home</title>
</head>
<body>
    <div class="container">
        
        <!-- <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        
        <div>

        </div> -->


        <div class="w-50 mt-4" id="msg-box">
            <?php if($_SESSION['message'] && $_SESSION['message'] != ''){ ?>
                <div id="message" class="alert alert-primary">
                    <?php
                    echo $_SESSION['message'];
                    $_SESSION['message'] = '';
                    ?>
                </div>          
            <?php } ?>
        </div>


        <div>
            <div>
                <h1>Thank You.</h1>
            </div>

            <div>
                <p id="outputMsg">
                    <?php echo $msg; ?>
                </p>
            </div>
        </div>




        <!-- <div class="w-50">
            <form id="email-validation-form">
                <label for="email">
                    Enter Email
                </label>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                </div>
                    <input id="emailToValidate" type="email" class="form-control" placeholder="email" aria-label="email" aria-describedby="basic-addon1">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div> -->
                <!-- <button type="submit" class="btn btn-primary" id="validate-btn">Validate</button> -->
            <!-- </form> -->

            
            <!-- <br>
            <div>
                <p id="outputMsg"></p>
            </div>
        </div> -->
    </div>




    <!-- loading screen -->
    <!-- <div id="loading">
        <div id="load-window">
            <div id="load-window-content">        
                <h5 class="h5 text-center" id="loading-text">Validating .... Please Wait</h5>
                <div class="progress mx-4">
                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>
            </div>
        </div>    
    </div> -->





    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="./public/main.js"></script>
</body>
</html>