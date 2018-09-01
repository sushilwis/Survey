<?php

    session_start();
    include 'db.php';

    // echo $_SESSION['id'];
    // echo $_SESSION['logged_in'];

    if(!$_SESSION['id'] && !$_SESSION['logged_in']){
        header("location: admin.php");
    }    

    $sql = "SELECT c.code, s.* FROM code as c INNER JOIN survey_data as s ON c.id = s.code_id";    
    $result = $conn->query($sql);
    // $obj = mysqli_fetch_assoc($result);
    // print_r($obj);

    // exit();

    $sql2 = "SELECT * FROM code WHERE assignable ='0'";    
    $result2 = $conn->query($sql2);

    $sql3 = "SELECT * FROM code";    
    $result3 = $conn->query($sql3);
    $count = mysqli_num_rows($result3);

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
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <!------ Include the above in your HEAD tag ---------->
    <title>Document</title>
</head>
<body>



    <!-- ###  navbar  ### -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">Administrator</a>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <div class="" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active" id="dash-menu">
                    <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" id="upload-menu">
                    <a class="nav-link" href="#">CSV Upload</a>
                </li>
            </ul>
        </div>
    </nav>



    <div class="w-50 mx-auto" id="msg-box">
        <?php if($_SESSION['message'] && $_SESSION['message'] != ''){ ?>
            <div id="message" class="alert alert-primary">
                <?php
                echo $_SESSION['message'];
                $_SESSION['message'] = '';
                ?>
            </div>    
        <?php } ?>
    </div>




    <!-- ###  promo code table  ### -->

    <section class="mt-4" id="code-table-section">
        <div class="container">


            <!-- total promo code counts -->
            <div class="card mb-4" style="width: 16rem;">
            <div class="card-body">
                <h4 class="card-title text-right">Total Promo Codes</h4>
                <p class="h5 card-text text-muted text-right"><?php echo $count; ?></p>
            </div>
            </div>



            <div class="row">        
                <div class="col-md-12">
                <h4>Promo Code Table With Emails</h4>

                <input type="checkbox" id="checkall"/> <label>Select All</label>
                <button class="btn btn-sm" id="delete-selected-1" style="display: none">Delete Selected</button>

                <div class="table-responsive">                    
                    <table id="mytable" class="table table-bordered table-sm">                   
                        <thead>                   
                            <th></th>
                            <th>Email</th>
                            <th>Promo Code</th>                      
                            <th>Delete</th>
                        </thead>

                        <tbody>  
                            <?php foreach($result as $row){ ?>  
                                <tr id="<?php echo $row['id']; ?>">
                                    <td>
                                        <input type="checkbox" class="checkthis" value="<?php echo $row['id']; ?>"/>
                                    </td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['code']; ?></td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                                        <button class="btn btn-danger btn-sm" id="delete-btn" onclick="deleteSingleRow('<?php echo $row['id']; ?>')">
                                            <!-- <i class="far fa-times-circle"></i> -->
                                            <span class="far fa-times-circle"></span>
                                        </button>
                                        </p>
                                    </td>
                                </tr>
                            <?php } ?>     
                        </tbody> 

                    </table>
                        
                </div>            
                </div>



                <div class="col-md-12 mt-4">
                <h4>Promo Codes</h4>

                <input type="checkbox" id="checkall-2"/> <label>Select All</label>
                <button class="btn btn-sm" id="delete-selected-2" style="display: none">Delete Selected</button>

                <div class="table-responsive">                    
                    <table id="mytable-2" class="table table-bordered table-sm">                   
                        <thead>                   
                            <th></th>
                            <th>Promo Code</th>
                            <th>Email</th>                      
                            <th>Delete</th>
                        </thead>

                        <tbody>  
                            <?php foreach($result2 as $row){ ?>  
                                <tr id="<?php echo $row['id']; ?>">
                                    <td>
                                        <input type="checkbox" class="checkthis" value="<?php echo $row['id']; ?>"/>
                                    </td>
                                    <td><?php echo $row['code']; ?></td>
                                    <td>Not Assigned</td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                                        <button class="btn btn-danger btn-sm" id="delete-btn" onclick="deleteSingleRow2('<?php echo $row['id']; ?>')">
                                            <!-- <i class="far fa-times-circle"></i> -->
                                            <span class="far fa-times-circle"></span>
                                        </button>
                                        </p>
                                    </td>
                                </tr>
                            <?php } ?>     
                        </tbody> 

                    </table>
                        
                </div>            
                </div>
            </div>
        </div>
    </section>




    
    <!-- CSV Upload -->

    <section class="container mt-4" id="upload-section">
        <h4 class="h4 mb-4 text-capitalize">upload csv here</h4>

        <form class="form-horizontal" action="upload.php" method="post" enctype="multipart/form-data">

            <div class="input-row">
                <label class="col-md-4 control-label">Choose CSV File</label> <input type="file" name="file" id="file" accept=".csv">
                <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
                <!-- <br /> -->
            </div>
            <!-- <div id="labelError"></div> -->
        </form>
    </section>
</div>



    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="./public/main.js"></script>
</body>
</html>