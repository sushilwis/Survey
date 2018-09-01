<?php 
/* Main page with two forms: sign up and log in */
// include_once 'checkLogin.php';
session_start();
// echo 'session id : '.$_SESSION['id'];
// echo '<br>logged-in status : '.$_SESSION['logged_in'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>


<div class="w-50 mx-auto">

    <?php if($_SESSION['message'] && $_SESSION['message'] != ''){ ?>
    <div id="message" class="alert alert-primary">
        <?php
        echo $_SESSION['message'];
        $_SESSION['message'] = '';
        ?>
    </div>
    <?php } ?>


    



    <h1 class="h1 mb-4">upload csv here</h1>

    <form class="form-horizontal" action="upload.php" method="post" enctype="multipart/form-data">

        <div class="input-row">
            <label class="col-md-4 control-label">Choose CSV File</label> <input type="file" name="file" id="file" accept=".csv">
            <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
            <!-- <br /> -->

        </div>
        <!-- <div id="labelError"></div> -->
    </form>



<?php if($_SESSION['match_found_arr'] && $_SESSION['match_found_arr'] != ''){ ?>
<div id="message" class="mt-3">
        <?php
            // print_r($_SESSION['match_found_arr']);
            // $_SESSION['match_found_arr'] = '';
        ?>

        <h3 class="h3">Match Found</h3>

        <table class="table table-bodered table-sm">
            <thead>
                <tr>
                    <th scope="col">Sl No.</th>
                    <th scope="col">Codes</th>
                </tr>
            </thead>
            <tbody>
                <?php $sl = 0; foreach ($_SESSION['match_found_arr'] as $matchs) { $sl++; ?>
                    <tr>
                        <td scope="row"><?php echo $sl; ?></td>
                        <td scope="row"><?php echo $matchs; ?></td>                              
                    </tr>
                <?php } ?>

                <?php
                    $_SESSION['match_found_arr'] = '';
                ?>
            </tbody>  
        </table>
</div>
<?php } ?>




<?php if($_SESSION['new_codes_arr'] && $_SESSION['new_codes_arr'] != ''){ ?>
<div id="message" class="mt-4">
    <?php
        // print_r($_SESSION['new_codes_arr']);
        // $_SESSION['new_codes_arr'] = '';
    ?>

    <h3 class="h3">New Codes</h3>

    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="">Sl No.</th>
                <th scope="">Codes</th>
            </tr>
        </thead>
        <tbody>

        <?php $sl = 0; foreach ($_SESSION['new_codes_arr'] as $newCode) { $sl++; ?>
            <tr>
                <td scope="row"><?php echo $sl; ?></td>
                <td scope=""><?php echo $newCode; ?></td>
            </tr>
        <?php } ?> 

        <?php
            $_SESSION['new_codes_arr'] = '';
        ?>

        </tbody>  
    </table>
</div>
<?php } ?>

</div>






<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> 
</body>
</html>