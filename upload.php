<?php


// session_start();
session_start();
include 'db.php';
// require 'db.php';

// $conn = mysqli_connect("localhost", "phpmyadmin", "1234", "csv_upload");

if (isset($_POST["import"])) {
    // echo 'posting from upload page.';
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        // echo 'size greater that 0.';

        $file = fopen($fileName, "r");

        $sql = "SELECT code FROM code";
        $result = $conn->query($sql);
        // $codes = mysqli_fetch_assoc($result);
        // print_r($codes['code']);

        $code_arr = [];

        while($codes = mysqli_fetch_assoc($result)){        
            array_push($code_arr, $codes['code']);
            // print_r($code['code']);
            // print_r($code_arr);
        }

        // print_r($code_arr);
        $match_found = 0;
        $new_codes = 0;
        $match_found_arr = [];
        $new_codes_arr = [];

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            // echo 'in the loop.';
          if( strlen($column[0]) == 6 ){ 

            if(in_array($column[0], $code_arr)){
                // echo 'match found';
                $match_found++;
                // array_push($match_found_arr, $column[0]);
            }else{
                // echo 'new entity found.';
                $new_codes++;
                array_push($code_arr, $column[0]);

                $sqlInsert = "INSERT into code (code) values ('" . $column[0] . "')";
                $result = mysqli_query($conn, $sqlInsert);
                
            } 
            
          }else{
                $match_found++;
          }
        }

        // echo 'match found'.$match_found.'<br>';
        // echo 'new entity found'.$new_codes.'<br>';

        $_SESSION['message'] = "New row added ".$new_codes." and discard ".$match_found.".";        
        // $_SESSION['match_found_arr'] = $match_found_arr; 
        // $_SESSION['new_codes_arr'] = $new_codes_arr;
        
        header("location: adminDashboard.php");
    } else {
        $_SESSION['message'] = 'size is zero';
    }
}


?>