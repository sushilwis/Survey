<?php 
/* Main page with two forms: sign up and log in */
session_start();
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

<div class="w-50 mx-auto">
    <div id="msg-box">
        <?php if(isset($_SESSION['message']) && $_SESSION['message'] != ''){ ?>
        <div id="message" class="alert alert-primary">
            <?php
            echo $_SESSION['message'];
            $_SESSION['message'] = '';
            ?>
        </div>
        <?php } ?>
    </div>


    <form action="./login.php" method="post">
        <div class="form-group">
            <label for="exampleFormControlInput1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>      
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>    
<script src="./public/main.js"></script>
</body>
</html>