<?php

session_start();
include 'db.php';

$email = $_POST['email'];



class Responce {
    var $code;
    var $msg;
    function __construct($res_code, $res_msg) {		
        $this->code = $res_code;		
        $this->msg = $res_msg;		
    }
}

// $res = new Responce('1', 'Validation successfull. Your promo code is 232325');
// // $res->code = '1';
// // $res->msg = 'Validation successfull. Your promo code is 232325';
// $res1 = json_encode($res);
// echo $res1;
// exit();

// echo $email;

// exit();

// $sql1 = "SELECT c.code, s.*
// FROM code as c
// JOIN survey_data as s
// ON c.id = s.code_id WHERE s.email='$email'";

$sql1 = "SELECT * FROM survey_data WHERE email='$email'";
$result1 = $conn->query($sql1);

// print_r($result1->num_rows());
// $rows = mysqli_num_rows($result1);
// echo $rows;

if(mysqli_num_rows($result1) > 0) {

    
    $user = mysqli_fetch_assoc($result1);
    $id = $user['id'];

    if($user['code_id'] === null){
        // echo "code_id is null";
        // exit();
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
            // echo 'code table updated with assign value 1.';
            // header("Location: ");
            // header("Location: thank_you.php");
            $msg = 'Validation successfull. Your promo code is '.$user_code;
            $res = new Responce('1', $msg);
            // $res->code = '1';
            // $res->msg = 'Validation successfull. Your promo code is 232325';
            $res1 = json_encode($res);
            echo $res1;
            // exit();
            
            // $res->code = '1';
            // $res->msg = 'Validation successfull. Your promo code is '.$user_code;
            // echo $res;
        }
    }

    }else {
        // $sql = "SELECT c.code, s.*
        // FROM code as c
        // JOIN survey_data as s
        // ON c.id = s.code_id WHERE s.email='$email'";

        // $result = $conn->query($sql);
        // $user = mysqli_fetch_assoc($result);
        // $promoCode = $user['code'];

        // $msg = "You are already validated. Your promo code is ".$promoCode;
        // $res = new Responce('2', $msg);
        // $res1 = json_encode($res);
        // echo $res1;

        $msg = "There is no promo code to assign.";
        $res = new Responce('3', $msg);
        $res1 = json_encode($res);
        echo $res1;
    } 

  }else{
        // echo "There is no promo code to assign.";
        // $msg = "There is no promo code to assign.";
        // $res = new Responce('3', $msg);
        // $res1 = json_encode($res);
        // echo $res1;

        $sql = "SELECT c.code, s.*
        FROM code as c
        JOIN survey_data as s
        ON c.id = s.code_id WHERE s.email='$email'";

        $result = $conn->query($sql);
        $user = mysqli_fetch_assoc($result);
        $promoCode = $user['code'];

        $msg = "You are already validated. Your promo code is ".$promoCode;
        $res = new Responce('2', $msg);
        $res1 = json_encode($res);
        echo $res1;
  }

}else{
    // echo 'Validation unsuccessful.';
        $msg = 'Validation unsuccessful.';
        $res = new Responce('4', $msg);
        $res1 = json_encode($res);
        echo $res1;
}

?>