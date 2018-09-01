<?php 

    session_start();
    include 'db.php';
    $ids = $_POST['ids'];
    $flag=0;
    // print_r($ids);

    foreach($ids as $id){
        // echo $id;
        $sql = "SELECT * FROM survey_data WHERE id=$id";
        $query = $conn->query($sql);
        $obj = mysqli_fetch_assoc($query);
        $code_id =  $obj['code_id'];

        $sql2 = "UPDATE code SET assignable='0' WHERE id='$code_id'";

        if ($conn->query($sql2) === TRUE) {
            // echo "Row deleted successfully.";
            // header("Location: http://localhost/student-crud/studentList.php");

            $sql3 = "DELETE FROM survey_data WHERE id=$id";

            if (!$conn->query($sql3) === TRUE) {
                $flag=1;
                // header("Location: http://localhost/student-crud/studentList.php");
            }
        }


    }
    echo $flag==1? 'error':'success';
    exit();

?>