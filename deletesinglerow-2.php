<?php
    session_start();
    include 'db.php';
    $id = $_POST['id']; 
    // echo $id;

    // $sql = "SELECT * FROM survey_data WHERE id=$id";
    // $query = $conn->query($sql);
    // $obj = mysqli_fetch_assoc($query);
    // $code_id =  $obj['code_id'];

    // $sql2 = "UPDATE code SET assignable='0' WHERE id='$code_id'";

    // if ($conn->query($sql2) === TRUE) {
        // echo "Row deleted successfully.";
        // header("Location: http://localhost/student-crud/studentList.php");

        $sql3 = "DELETE FROM code WHERE id=$id";

        if ($conn->query($sql3) === TRUE) {
            echo "true";
            // header("Location: http://localhost/student-crud/studentList.php");
        } else {
            echo "false";
        }
    // } else {
    //     echo "false";
    // }

    // $sql = "DELETE FROM survey_data WHERE id=$id";


    // if ($conn->query($sql) === TRUE) {
    //     echo "Row deleted successfully.";
    //     // header("Location: http://localhost/student-crud/studentList.php");
    // } else {
    //     echo "Error deleting record.";
    // }
?>