<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';
    
    include_once '../db/tb_repository.php';
    include_once '../model/repositoryModel.php';
    
    include_once '../db/tb_updates.php';
    include_once '../model/updatesModel.php';
    
    include_once '../db/tb_version.php';
    include_once '../model/versionModel.php';

    session_start();
    if(!isset($_SESSION['username']))
    {
        header("location: ../login.php");
    }
    else
    {
        if(isset($_GET['id']))
        {
            $data = new userAccountModel();
            $data->setUsername($_SESSION['username']);
    
            $result = ReadUserAccount($conn,$data);
    
            $userRow = mysqli_fetch_assoc($result);
    

            $repo = new repositoryModel();
            $repo->setId($_GET['id']);
    
            $result = ReadRepo($conn,$repo);
    
            $repoRow = mysqli_fetch_assoc($result);


            
            $updates = new updatesModel();
            $updates->setRepositoryId($_GET['id']);

            $latestResult = ReadUpdate($conn,$updates);
            $result = ReadUpdate($conn,$updates);

        }
        else 
        {
            header("location: userdashboard.php");
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Bootstrap icon--> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
    
    <!-- JQuery for chat system in firebase -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!--Chart.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.min.js" integrity="sha512-zjlf0U0eJmSo1Le4/zcZI51ks5SjuQXkU0yOdsOBubjSmio9iCUp8XPLkEAADZNBdR9crRy3cniZ65LF2w8sRA==" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../css/defaultStyle.css">

    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 200px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }

        #repoList{
            max-height: 700px;
            overflow-y:scroll;
            -webkit-overflow-scrolling: touch;
            border-radius: 5px;
        }
        .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #6E85B7;
            position: fixed;
            height: 100%;
            overflow: auto;
        }

        #nameLabel{
            font-weight: bolder;
            color: #82B7DC;
            text-shadow: 1px 1px #1C1C1C;
        }
        
        #usernameLabel{
            font-weight: lighter;
            color: whitesmoke;
            text-shadow: 1px 1px #1C1C1C;
        }

        #pageTitle{
            font-weight: bold;
            color: #F1F1F1;
            text-shadow: 1px 1px #1C1C1C;
        }


        .sidebar a {
            display: block;
            color: #F1F1F1;
            padding: 16px;
            text-decoration: none;
        }
        
        .sidebar a.active {
            background-color: #5d73a3;
            color: white;
        }

        .sidebar a:hover:not(.active) {
            background-color: #5d73a3;
            color: white;
        }
        
        div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: max-content;
        }
        
        @media screen and (max-width: 700px) {
            .sidebar {
                    width: 100%;
                    height: auto;
                    position: relative;
            }
            div.content {margin-left: 0;}
        }

        @media screen and (max-width: 400px) {
            .sidebar a {
                    text-align: center;
                    float: none;
            }
        }



        #collapseUtilities, #collapseMaintenance, #collapseHealthRecord{
            background-color:#5d73a3 ;
        }

        .collapseBtn{
            color:whitesmoke;
            background-color: #485d8c;
            width: 150px;
            text-shadow: 1px 1px #1C1C1C;
        }
        .collapseBtn:hover {
            background-color:#5d73a3;
        }

        .mainBtn{
            color:whitesmoke;
            text-shadow: 1px 1px #1C1C1C;
        }

  


    
    </style>
    <link rel="icon" href="../asset/appIcon.png">
    <title>Uncluttered - Repository Dashboard</title>
</head>
<body>
<!-- Alert message container-->
<div id="successBox" class="alert alert-success alert-dismissible fade show" role="alert" style="position:absolute; display:none; z-index: 1;">
    <strong id="successMsg"></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<!-- Alert message container-->
<div id="alertBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute; display:none; z-index: 1;">
    <strong id="errorMsg"></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
    
<div class="sidebar text-center">
    <div class="navbar-brand d-flex justify-content-center">
        <?php
        
            if($userRow['gmail_Id']!=null)
            {
                ?>
                    <img src="../upload/userImage/<?php echo $userRow['imageName'];?>" width="100" height="100" class="border border-dark ml-3 my-1" alt="" style="border-radius: 50%;">
                <?php
            }
            else
            {
                if($userRow['imageName']!==null && $userRow['imageName']!=='')
                {
                    ?>
                        <img src="../upload/userImage/<?php echo $userRow['imageName'];?>" width="100" height="100" class="border border-dark ml-3 my-1" alt="" style="border-radius: 50%;">
                    <?php
                }
                else 
                {
                    ?>
                        <img src="../asset/user.png" width="100" height="100" class="border border-dark ml-3 my-1" alt="" style="border-radius: 50%;">
                    <?php
                }
            }
        ?>
    </div>
    <h4 class="d-flex justify-content-center mx-auto px-auto mt-2 pt-1" id="nameLabel"><?php echo $userRow['firstname'].' '.$userRow['lastname']?></h4>
                
    <h6 class="d-flex justify-content-center mx-auto px-auto mt-2 pt-1" id="usernameLabel" style="font-size: 12px;"><?php echo $userRow['username'];?></h6>
    <hr style="height:2px; border-width:0;background-color: #39445c;">
    <a type="button" class="btn btn-sm mt-1 rounded d-flex justify-content-start mainBtn" href="repodashboard.php?id=<?php echo $_GET['id'];?>" role="button"><i class="bi bi-diagram-3 mr-1"></i> Projects</a>
    <a type="button" class="btn btn-sm active mt-1 rounded d-flex justify-content-start mainBtn" href="chartdashboard.php?id=<?php echo $_GET['id'];?>" role="button"><i class="bi bi-graph-up-arrow mr-1"></i> Stats</a>
    <a type="button" class="btn btn-sm mt-1 rounded d-flex justify-content-start mainBtn" href="chatbox.php?id=<?php echo $_GET['id'];?>" role="button"><i class="bi bi-chat-dots mr-1"></i> Chat</a>

  
  <a type="button" class="btn btn-sm mt-1 rounded d-flex justify-content-start mainBtn"  href="#about" role="button" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities"><i class="bi bi-tools mr-1"></i> Utilities</a>
    <div id="collapseUtilities" class="collapse my-1" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" >
        <div class="py-2 collapse-inner rounded mx-4">
            <h6 class="collapse-header text-light" style="font-size: 13px;">Settings</h6>

            <button type="button" class="collapse-item btn btn-sm my-1 collapseBtn"  data-toggle="modal" data-target="#accSettModal" style="color: whitesmoke;" id="accSettBtn"><i class="bi bi-gear"></i> Account</button><br>
             
              <button type="button" class="collapse-item btn btn-sm my-1 collapseBtn" id="repoSettBtn" data-toggle="modal" data-target="#editRepoModal"><i class="bi bi-wrench-adjustable-circle"></i> Repository</button><br>
              <?php
                if($repoRow['userAccountId'] != $userRow['id'])
                {
                    ?>
                        <script>
                            $('#repoSettBtn').prop('disabled',true);//this will disable the edit repo button if the user is not the creator
                        </script>
                    <?php
                }
              ?>
      
        </div>
    </div>
    <hr style="height:2px; border-width:0;background-color: #39445c;">
    <a type="button" class="btn btn-sm rounded d-flex justify-content-start mainBtn" href="userdashboard.php" role="button" style="background-color: #485d8c;"><i class="bi bi-arrow-left mr-1"></i> Return</a>
</div>

<div class="content">
    <!--Header of the page-->
    <nav class="navbar navbar-expand-lg navbar-light rounded"   style="background-color: #6E85B7;">
        
        <h3 class="navbar-brand d-flex justify-content-center mt-2 pt-1" id="pageTitle" style="overflow:hidden; white-space: nowrap; text-overflow: ellipsis; "> <?php echo $repoRow['repositoryName'];?></h3>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a type="button" class="btn btn-sm nav-link bg-success rounded text-light" role="button" data-toggle="modal" data-target="#createPostModal"><i class="bi bi-plus-lg"></i> Create Post <span class="sr-only">(current)</span></a>
                </li>
                <!--li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li-->
            </ul>
            <form class="form my-2 my-lg-0">
                <div class="input-group">
                    <a type="button" class="form-control form-control-sm btn btn-sm nav-link bg-danger rounded text-light" id="signoutBtn" href="#" role="button" style="background-color: #485d8c;" onclick="return signout()"><i class="bi bi-power mr-2"></i>Sign-out</a>
                </div>
            </form>
        </div>
    </nav>
    <script>

     
        var myContri = 0;
        var memberContri = 0;
        var dataStat = [];
        var memberUpdates = [];
        var repoMember = [];
        var updateTotal = 0;
        var chatInteraction = [];
        var interactionPercent = [];
        var chatTotal = 0;
        //console.log(repoMember);
    </script>
    <?php
        //This will get the total update in the current repository
        $data = new updatesModel();
        $data->setRepositoryId($repoRow['id']);
        $totalUpdateResult = ReadUpdate($conn,$data);
        $totalUpdateRow = mysqli_num_rows($totalUpdateResult);
        ?>
            <script>
                updateTotal = <?php echo $totalUpdateRow;?>;
                //console.log(updateTotal);
            </script>
        <?php

        $members = array();
        $members = unserialize($repoRow['members']);

        //check if the data is array
        if(is_array($members))
        {
            foreach($members as $userId)
            {
                //To get the member details such as name
                $data = new userAccountModel();
                $data->setId($userId);
                $memberResult = ReadUserAccount($conn,$data);
                $memberRow = mysqli_fetch_assoc($memberResult);

                //To get the member update in the currect repository
                $data = new updatesModel();
                $data->setUserAccountId($userId);
                $data->setRepositoryId($repoRow['id']);
                $memberUpdateResult = ReadUpdate($conn,$data);
                $memberUpdateRow = mysqli_num_rows($memberUpdateResult);


                //To get the member update in the currect repository
                /*$data = new versionModel();
                $data->setUserAccountId($userId);
                $data->setRepositoryId($repoRow['id']);
                $memberUpdateResult = ReadUpdate($conn,$data);
                $memberUpdateRow = mysqli_num_rows($memberUpdateResult);*/
                ?>
                    <script>
                        //this will get the percentage of the contribution
                        var percent = <?php echo $memberUpdateRow;?>/updateTotal;
                        percent = percent*100;
                        //console.log(Math.round(percent));
                        memberUpdates.push(Math.round(percent));
                        chatInteraction.push(0);//This will only inserted to make the chatInteraction array have a same array length as the repoMember
                        interactionPercent.push(0);//This will only inserted to make the interactionPercent array have a same array length as the repoMember
                        repoMember.push(<?php echo json_encode($memberRow['username']); ?>);
                    </script>
                <?php
            }
        }
        else
        {
            $data = new userAccountModel();
            $data->setId($members);
            $memberResult = ReadUserAccount($conn,$data);

            $memberRow = mysqli_fetch_assoc($memberResult);
            ?>
                <script>
                    repoMember.push(<?php echo json_encode($memberRow['lastname']); ?>);
                </script>
            <?php
        }
    
    ?>

    <!-- 2nd main div in content-->
    <div class="row no-gutters my-2 py-2 mx-auto px-1 rounded">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-light rounded border">
            <div class="chart-container mx-auto">
                <canvas id="line1" style="width: 100px; height: 35px;"></canvas>
            </div>
        </div>
    </div>
    <style>
                
        .loadingUl{
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,50%);
            margin:0;
            padding:0;
            display:flex;

        }

        .loadingUl li {
            list-style:none;
            width:20px;
            height:20px;
            background:#2169ce;
            margin:0 5px;
            border-radius:50%;
            animation:animate 1.4s linear infinite;
        }

        @keyframes animate{
            0%{
                transform:translateY(0);
            }
            60%{
                transform:translateY(0);
            }
            80%{
                transform:translateY(-20px);
            }
            
            100%{
                transform:translateY(0px);
            }
        }

        .loadingUl li:nth-child(1){
            animation-delay:-1.2s;
        }

        .loadingUl li:nth-child(2){
            animation-delay:-1.0s;
        }

        .loadingUl li:nth-child(3){
            animation-delay: -.8s;
        }

        .loadingUl li:nth-child(4){
            animation-delay:-0.6s;
        }


    </style>
    
    <!-- 3rd main div in content-->
    <div class="row no-gutters my-2 py-2 mx-auto px-1 rounded">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-light rounded border" id="barChartDiv" style="height: 24rem;">
            <div class="chart-container mx-auto">
                
                <canvas id="bar1"style="width: 100px; height: 35px;"></canvas>
                
            
                <div id="loadingDiv">
                    <ul class="loadingUl">
                        <li class="loadingLi"> </li>
                        <li class="loadingLi"> </li>
                        <li class="loadingLi"> </li>
                        <li class="loadingLi"> </li>
                    </ul>
                </div>

            </div>
        </div>
        
    </div>
    
</div>



    
    <!-- Create Post Modal -->
    <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="accSettModalTitle" aria-hidden="true" style="border-radius:12px;">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="border-radius:12px;">
            <div class="modal-content" style="border-radius:12px;">
                <div class="modal-header" style="background-color: #6E85B7; color:whitesmoke; border-radius:7px;">
                    <h5 class="modal-title" id="accSettModalLongTitle"><i class="bi bi-pen"></i> Create Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controller/createPost.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="repoId" value="<?php echo $repoRow['id'];?>">
                        <input type="hidden" name="userId" id="userId" value="<?php echo $userRow['id'];?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                        <label for="titleTb">Title</label>
                                        <input type="text" class="form-control form-control-sm" name="titleTb" id="titleTb" placeholder="Write a title" maxlength="50" required/>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                        <label for="fileTb">Attach File:</label>
                                        <input type="file" class="form-control-file form-control-sm" id="fileTb" name="fileTb">
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                        <textarea name="noteTb" id="notePostTb" class="col-sm-12 col-xs-12 col-md-12 col-lg-12" rows="10" maxlength="500" placeholder="Write a note....." oninput="getTxtLength(this.id,'postLengthTxt')"></textarea>
                                        <span class="d-flex justify-content-end"><p id="postLengthTxt">0/500</p></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-sm bg-success" name="submitPost" style="width: 8rem; color:whitesmoke;">Submit</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    
    <!-- Repository settings Modal -->
    <div class="modal fade" id="editRepoModal" tabindex="-1" role="dialog" aria-labelledby="accSettModalTitle" aria-hidden="true" style="border-radius:12px;">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="border-radius:12px;">
            <div class="modal-content" style="border-radius:12px;">
                <div class="modal-header" style="background-color: #6E85B7; color:whitesmoke; border-radius:7px;">
                    <h5 class="modal-title" id="accSettModalLongTitle">Edit Repository</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controller/editRepo.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="repoId" value="<?php echo $repoRow['id'];?>">
                        <input type="hidden" name="memberTb" id="memberTb">
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" name="repoNameTb" id="repoNameTb" placeholder="Repository Name" maxlength="100" required value="<?php echo $repoRow['repositoryName'];?>"/>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="border-0 rounded btn btn-sm"><i class="bi bi-search"></i></button> 
                                        </div>
                                        <input class="form-control form-control-sm" type="text" name="searchNameTb" placeholder="Search" onkeyup="showResult(this.value)">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="table-wrapper-scroll-y my-custom-scrollbar border rounded" style="height:15rem;">
                                        <table class="table table-striped table-hover table-sm text-justify mb-0"  style="font-size:small;">
                                                <caption id="tbCaption"></caption>
                                                <thead class="text-light" style="background-color:#234471;">
                                                    <tr>
                                                        <th scope="col" >#</th>
                                                        <th scope="col">Image</th> 
                                                        <th scope="col" >Name</th>
                                                        <th scope="col" ></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="userList">
                                                <!-- user first and last name shows here after the search result-->
                                                    
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-sm bg-success" name="submitRepo" style="width: 8rem; color:whitesmoke;">Submit Changes</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     
    <!-- Account Settings Modal -->
    <div class="modal fade" id="accSettModal" tabindex="-1" role="dialog" aria-labelledby="accSettModalTitle" aria-hidden="true" style="border-radius:12px;">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="border-radius:12px;">
            <div class="modal-content" style="border-radius:12px;">
                <div class="modal-header" style="background-color: #6E85B7; color:whitesmoke; border-radius:7px;">
                    <h5 class="modal-title" id="accSettModalLongTitle">Account Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controller/editAccount.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="idTb" value="<?php echo $userRow['id'];?>">
                        <input type="hidden" name="imageNameTb" value="<?php echo $userRow['imageName'];?>">
                        <input type="hidden" name="userPassTb" value="<?php echo $userRow['password'];?>">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 pt-2 mt-2 d-flex justify-content-center">
                                    <?php
                                        if($userRow['imageName'])
                                        {
                                            ?>
                                                <img src="../upload/userImage/<?php echo $userRow['imageName'];?>" width="90" height="90" class="d-inline-block align-top border border-dark" alt="" style="border-radius: 50%;" id="userImg">
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <img src="../asset/user.png" width="90" height="90" class="d-inline-block align-top border border-dark" alt="" style="border-radius: 50%;" id="userImg">
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 pt-2 mt-2 d-flex justify-content-center">
                                    <div class="custom-file" style="width:fit-content;">
                                        <input type="file" accept=".jpg, .png, .jpeg" class="custom-file-input" id="imgTb" name="imgTb">
                                        <label class="custom-file-label text-left mt-2 pt-2" for="imgTb">Upload Photo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 pt-2 mt-2">
                                    <label class="d-flex align-items-start" for="fnameTb">First name</label>
                                    <input type="text" class="form-control form-control-sm form-control-plaintext border-primary border-bottom border-top-0 bg-light" id="fnameTb" name="fnameTb" placeholder="Ex. Marie" maxlength="50" required value="<?php echo $userRow['firstname'];?>">
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 pt-2 mt-2">
                                    <label class="d-flex align-items-start" for="lnameTb">Last name</label> 
                                    <input type="text" class="form-control form-control-sm form-control-plaintext border-primary border-bottom border-top-0 bg-light" id="lnameTb" name="lnameTb" placeholder="Ex. Cruz" maxlength="50" required value="<?php echo $userRow['lastname'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="usernameTb">Username</label>
                                    <input type="text" class="form-control form-control-sm form-control-plaintext border-primary border-bottom border-top-0 bg-light" id="usernameTb" name="usernameTb" placeholder="Ex. Marie0123" maxlength="20" required value="<?php echo $userRow['username'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="passwordTb">Current Password</label>
                                    <input type="password" class="form-control form-control-sm form-control-plaintext border-primary border-bottom border-top-0 bg-light" id="currentPassTb" name="currentPassTb" placeholder="Ex. CMarie123" minlength="8" maxlength="20">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="passwordTb">New Password</label>
                                    <input type="password" class="form-control form-control-sm form-control-plaintext border-primary border-bottom border-top-0 bg-light" id="passwordTb" name="passwordTb" placeholder="Ex. CMarie123" minlength="8" maxlength="20">
                                    <small class="d-flex align-items-start" style="color:red;">Use at least 8 or up to 15 characters for your password </small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="emailTb">Email Address</label>
                                    <input type="email" class="form-control form-control-plaintext border-primary border-bottom border-top-0 form-control-sm bg-light" id="emailTb" name="emailTb" placeholder="Ex. myMail@gmail.com" maxlength="100" required  value="<?php echo $userRow['email'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pb-1 mb-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <button type="submit" class="form-control btn btn-sm" id="submitBtn" name="submitBtn" style="background-color: #3466AA; color:white;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    



    
    

    <?php
        if(isset($_GET['updateRes']))
        {
            if($_GET['updateRes']==1)
            {
                ?>
                    <script>
                        document.getElementById('successBox').style.display = 'block';
                        document.getElementById('successMsg').innerHTML = 'Update Posted!';
                    </script>
                <?php
            }
            else if($_GET['updateRes']==2)
            {
                ?>
                    <script>
                        document.getElementById('successBox').style.display = 'block';
                        document.getElementById('successMsg').innerHTML = 'Repository Update Successfully!';
                    </script>
                <?php
            }
            else if($_GET['updateRes']==3)
            {
                ?>
                    <script>
                        document.getElementById('successBox').style.display = 'block';
                        document.getElementById('successMsg').innerHTML = 'Version Created!';
                    </script>
                <?php
            }
            ?>
                <script>
                    //to reset the $_GET in URL
                    const url = new URL(window.location.href);
                    url.searchParams.delete('updateRes');
                    window.history.replaceState(null, null, url); // or pushState
                </script>
            <?php
        }
    ?>

    <script>
        
        /**
         *  Sign out the user upon button click.
         */
        function signout()
        {
            const token = gapi.client.getToken();
            if (token !== null)
            {
                google.accounts.oauth2.revoke(token.access_token);
                gapi.client.setToken('');
            }

            setTimeout(window.location = '../controller/wipedata.php',2000);
        }
    </script>
    <!-- Google API -->
    <script type="text/javascript" src="../javascript/googleAPI-Credentials.js"></script>
    <script async defer src="https://apis.google.com/js/api.js"
        onload="gapiLoaded()"></script>
    <script async defer src="https://accounts.google.com/gsi/client"
        onload="gisLoaded()"></script>

</body>

<!-- Script for chat system-->
<script type="module">
// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.13.0/firebase-app.js";
import { getDatabase, set, ref, push, child, onValue, onChildAdded, update } from "https://www.gstatic.com/firebasejs/9.13.0/firebase-database.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.13.0/firebase-analytics.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyAS14_LkpIZA55I1BlI0PfTNVkSxuShWCE",
    authDomain: "collaboratorychat.firebaseapp.com",
    projectId: "collaboratorychat",
    storageBucket: "collaboratorychat.appspot.com",
    messagingSenderId: "843037096034",
    appId: "1:843037096034:web:8bbec1e76e2a2c3d28393b",
    measurementId: "G-LXPLGYM2Q6",
    databaseURL: "https://collaboratorychat-default-rtdb.asia-southeast1.firebasedatabase.app/"
};


// Initialize Firebase
const app = initializeApp(firebaseConfig);
const database = getDatabase(app);
const analytics = getAnalytics(app);

//console.log(new Date().toLocaleString());

    //var message = $('#message').val();
    var myId = <?php echo $userRow['id']?>;
    var currRepoId = <?php echo $repoRow['id']?>;
    var myName = <?php echo json_encode($userRow['username'])?>;
    var myLastName = <?php echo json_encode($userRow['lastname'])?>;
    var myImage = <?php echo json_encode($userRow['imageName'])?>;

    /*
        console.log(message);
        console.log(myId);
        console.log(currRepoId);
        console.log(myName);
        console.log(myImage);
    */


    $("#sendMsg").click(function(){
        
        var id = push(child(ref(database), 'messages')).key;
        var message = document.getElementById('message').value;
        if(message.length>0 && message.replace(/\s/g, '').length!=0)
        {
            set(ref(database, 'messages/' + id),{
                repoId: currRepoId,
                userId: myId,
                name: myName,
                lastname: myLastName,
                message: message,
                imageName: myImage,
                time: new Date().toLocaleString()
            });

            $('#message').val('');
        }
            //alert('message has sent');
    });

    const newMsg = ref(database, 'messages/');
    onChildAdded(newMsg, (data) => {

        //This will filter all messages that belongs to this repository
        if(data.val().repoId == currRepoId)
        {

            if(data.val().userId != myId)
            {
                //This is for the other member message

                //This will get the index position of the name in the array
                chatInteraction[repoMember.indexOf(data.val().name)] += 1;
                chatTotal++;


            }
            else if(data.val().userId == myId)
            {
                //This is for the user message

                //This will get the index position of the name in the array
                chatInteraction[repoMember.indexOf(data.val().name)] += 1;
                chatTotal+=1;
                
            }

            $('#msgBody1').animate({scrollTop: 9999});
            
            $('#msgBody1').stop(false,true);
            

        }
    });
    /*
    var delayInMilliseconds = 1000; //1 second

    setTimeout(function() {
    //your code to be executed after 1 second
    }, delayInMilliseconds);
    
    console.log('Mem: '+chatInteraction);
    for(var count = 0; count < repoMember.length;count++)
    {
        var chatPercentage = chatInteraction[count]/chatTotal;
        console.log("Total: "+chatInteraction.reduce(function(chatInteraction, val) { return chatInteraction + val; }, 0));
        chatPercentage = chatPercentage*100;
        interactionPercent[count] = Math.round(chatPercentage);
    }
    */

    //To wait the data in chat interaction to fetch completely
    const myTimeout = setTimeout(barChart, 1500);
</script>
<script>
   /* var total = myContri+memberContri;
    var percentage = myContri/total;
    percentage = percentage*100;
    dataStat.push(Math.round(percentage));

    percentage = memberContri/total;
    percentage = percentage*100;
    dataStat.push(Math.round(percentage));*/

    //for deleting attached files
    function deletePost(postId) 
    {
        try
        {
            var http = new XMLHttpRequest();
            http.open("POST", "../controller/deletePost.php", true);
            http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            //This is the form input fields data
            var params = "postId="+postId; // probably use document.getElementById(...).value
            http.send(params);
            http.onload = function() 
            {
                var data = http.responseText;
                //console.log(data);

                if(data=='deleted')
                {
                    location.reload();
                }
                //returnDate();
                //console.log(params);
            }
        }
        catch(err)
        {
            //this will reload the page if an error has occur
            location.reload();
        }
    }


    //for searching user realtime
    function showResult(str) 
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() 
        {
            if (this.readyState==4 && this.status==200)
            {
                document.getElementById("userList").innerHTML=this.responseText;
                preserveBtnColor();
            }
        }
        xmlhttp.open("GET","../controller/userSearch.php?search="+str,true);
        xmlhttp.send();
    }


    //This is to get the current repository members and assign it to id=memberTb
    var members = [];
    members = <?php echo json_encode(unserialize($repoRow['members']));?>;
    document.getElementById('memberTb').value = JSON.stringify(members);

    //console.log(members);
    //for adding user as member
    function addUser(userId)
    {
        //This will add userid to array members and check if its already added
        if(members.includes(userId)==false)
        {
            members.push(userId);
            document.getElementById(userId).style.backgroundColor = "red";
        }
        else
        {
            index = members.indexOf(userId);
            if(index > -1)
            {  
                //This will remove userid if already existed inside array members
                members.splice(index,1);
                document.getElementById(userId).style.backgroundColor = "green";
            }
        }
        const vala = document.getElementById('memberTb').value = JSON.stringify(members);
        //console.log(vala);
    }

    //This is to preserve the added color 'red' to every button
    function preserveBtnColor()
    {
        var length = members.length-1;
      
        while(length>=0)
        {
            //console.log('inside while');
            if(members.includes(members[length]))
            {
                //console.log('inside if '+ members[length]);
                var btnColor = document.getElementById(members[length]);
                if(btnColor!=null)
                {
                    document.getElementById(members[length]).style.backgroundColor = "red";
                }
            }
            length--;
        }
    }


    function getTxtLength(noteId,txtLength)
    {
        var length = document.getElementById(noteId).value;
        document.getElementById(txtLength).innerHTML = length.length+'/500';
    }

/*
    var ctx = document.getElementById("pie1").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['My contribution(%)','Other members(%)'],
            datasets: [{
                label: 'Status',
                data: dataStat,
                backgroundColor: [
                    
                    '#50C878',
                    '#EE4B2B',
                    '#8b0000',
                    '#234471',
                    '#AEC6CF',
                    '#0000FF',
                    '#FF00FF',
                    '#00FFFF',
                    '#ffa500',
                    '#9400d3',
                    '#808080',
                    '#00ffff',
                    '#8fbc8f',
                    '#1e90ff'

                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Project Contribution',
                    fontSize: 300
                },
                legend:{
                    position: 'bottom'
                }
            }
        }
    });
*/

//console.log(interactionPercent);
//console.log(repoMember);
    var ctx2 = document.getElementById("line1").getContext('2d');
    var datasets = [43,54,45,32,16,15,51,18];
    var dataStats = [31,32,22,32,34,21,23,12];
    var mybar = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: repoMember,
            datasets: [{
                label: 'Post (%)',
                data: memberUpdates,
                backgroundColor: [
                    '#BE1818',
                    '#0047AB',
                    '#FF00FF',
                    '#925cff',
                    '#008000',
                    '#fff75c',
                    '#00FFFF',
                    '#ffa500',
                    '#9400d3',
                    '#808080',
                    '#00ffff',
                    '#8fbc8f',
                    '#1e90ff'

                ],
                borderColor: '#BE1818',
                tension: 0.4,
                fill: false,
                spanGaps: true
            }/*,
            {
                label: 'Version (%)',
                data: dataStats,
                backgroundColor: [
                    '#BE1818',
                    '#0047AB',
                    '#FF00FF',
                    '#925cff',
                    '#008000',
                    '#fff75c',
                    '#00FFFF',
                    '#ffa500',
                    '#9400d3',
                    '#808080',
                    '#00ffff',
                    '#8fbc8f',
                    '#1e90ff'

                ],
                borderColor: '#0047AB',
                tension: 0.4,
                fill: false,
                spanGaps: true
            }*/]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: "Participation Report",
                    fontSize: 300
                },
                legend:{
                    display: true
                }
            }
        }
    });

    function barChart()
    {
        $('#loadingDiv').hide();
        $('#barChartDiv').css("height","");
        for(var count = 0; count < repoMember.length;count++)
        {
            var chatPercentage = chatInteraction[count]/chatTotal;
            //console.log("Total: "+chatInteraction.reduce(function(chatInteraction, val) { return chatInteraction + val; }, 0));
            chatPercentage = chatPercentage*100;
            interactionPercent[count] = Math.round(chatPercentage);
        }

     

        var ctx3 = document.getElementById("bar1").getContext('2d');
        var myline = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: repoMember,
                datasets: [{
                    label: 'Actual Messages',
                    data: chatInteraction,
                    backgroundColor: [
                        '#BE1818',
                        '#0047AB',
                        '#FF00FF',
                        '#925cff',
                        '#008000',
                        '#fff75c',
                        '#00FFFF',
                        '#ffa500',
                        '#9400d3',
                        '#808080',
                        '#00ffff',
                        '#8fbc8f',
                        '#1e90ff'

                    ],
                    borderColor: 'black',
                    borderWidth: 1,
                    fill: true,
                    spanGaps: true
                },
                {
                    label: 'Percentage (%)',
                    data: interactionPercent,
                    backgroundColor: [
                        '#BE1818',
                        '#0047AB',
                        '#FF00FF',
                        '#925cff',
                        '#008000',
                        '#fff75c',
                        '#00FFFF',
                        '#ffa500',
                        '#9400d3',
                        '#808080',
                        '#00ffff',
                        '#8fbc8f',
                        '#1e90ff'

                    ],
                    borderColor: 'black',
                    borderWidth: 1,
                    fill: true,
                    spanGaps: true
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Interaction',
                        fontSize: 300
                    },
                    legend:{
                        display: true
                    }
                }
            }
        });
    }
    
    

        
    //this will make a image preview before it was uploaded
    imgTb.onchange = evt => {
    const [file] = imgTb.files
    if (file) {
        userImg.src = URL.createObjectURL(file)
    }
    }
</script>
</html>