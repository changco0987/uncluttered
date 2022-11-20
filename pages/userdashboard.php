<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';
    
    include_once '../db/tb_repository.php';
    include_once '../model/repositoryModel.php';

    session_start();
    if(!isset($_SESSION['username']))
    {
        header("location: ../index.php");
    }
    else
    {
        $data = new userAccountModel();
        $data->setUsername($_SESSION['username']);

        $result = ReadUserAccount($conn,$data);

        $row = mysqli_fetch_assoc($result);
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Bootstrap icon--> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../css/defaultStyle.css">

    <style>
        #repoList{
            max-height: 780px;
            overflow-y:scroll;
            -webkit-overflow-scrolling: touch;
            border-radius: 5px;
        }
    </style>
    <link rel="icon" href="../asset/appIcon.png">
    <title>Uncluttered - User Dashboard</title>
</head>
<body>
    <div class="container-fluid ">

        <div class="row my-2 py-2 flex-grow-1 mx-1 px-1 ">

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 mx-auto bg-primary d-flex  justify-content-center">
                <div class="bg-success rounded  mb-2 ">
                    <div class="userImage mt-5 pt-5 mb-2 text-center">
                        <?php
                            if($row['imageName']!==null && $row['imageName']!=='')
                            {
                                ?>
                                    <img src="../upload/<?php echo $row['username'];?>/<?php echo $row['imageName'];?>" width="60" height="60" class="border border-dark ml-3 my-1" alt="" style="border-radius: 50%;">
                                <?php
                            }
                            else 
                            {
                                ?>
                                    <img src="../asset/user.png" width="200" height="200" class="border border-dark ml-3 my-1" alt="" style="border-radius: 50%;">
                                <?php
                            }
                        
                        ?>
                        <h5 class="my-2"><?php echo $row['firstname'].' '.$row['lastname']?></h5>
                        <p><?php echo $row['username'];?></p>
                        <button type="button" class="form-control btn d-flex justify-content-center my-2" data-toggle="modal" data-target="#accSettModal" id="accSettBtn" style="background-color: #3466AA; color:white;"><i class="bi bi-folder-plus mr-2"></i>Create Repository</button>
                        <button type="button" class="form-control btn d-flex justify-content-center my-2" data-toggle="modal" data-target="#accSettModal" id="accSettBtn" style="background-color: #3466AA; color:white;"><i class="bi bi bi-sliders mr-2"></i>Account Settings</button>
                        <button type="button" class="form-control btn d-flex justify-content-center bg-danger my-2" data-toggle="modal" data-target="#accSettModal" id="accSettBtn" style="color:white;"><i class="bi bi-box-arrow-left mr-2"></i>Sign-out</button>
                    </div>
                    
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-9 col-xl-9 mx-auto">
                <div class="bg-warning rounded  pb-2">
                    <h2 class="pt-2 ml-2"><i class="bi bi-folder-fill"></i> Repositories</h2>
                    <div class="list-group mx-2 bg-light" style="height: 50rem;" id="repoList">
                        <?php
                            $repo = new repositoryModel();
                            $repo->setUserAccountId($row['id']);
                            
                        ?>
                        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                        <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                        <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                    
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>