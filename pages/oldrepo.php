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
    
    include_once '../db/tb_ideas.php';
    include_once '../model/ideasModel.php';

    include_once '../controller/similarityChecker.php';

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
    
    <!-- Google API -->

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
               
    <!--Add buttons to initiate auth sequence and sign out-->
    <button id="authorize_button" onclick="handleAuthClick()">Authorize</button>
    <button id="signout_button" onclick="handleSignoutClick()">Sign Out</button>
    <pre id="content" style="white-space: pre-wrap;">adsadad</pre> 
    
    <h6 class="d-flex justify-content-center mx-auto px-auto mt-2 pt-1" id="usernameLabel" style="font-size: 12px;"><?php echo $userRow['username'];?></h6>
    <hr style="height:2px; border-width:0;background-color: #39445c;">
    <a type="button" class="btn btn-sm active mt-1 rounded d-flex justify-content-start mainBtn" href="repodashboard.php?id=<?php echo $_GET['id'];?>" role="button"><i class="bi bi-diagram-3 mr-1"></i> Projects</a>
    <a type="button" class="btn btn-sm mt-1 rounded d-flex justify-content-start mainBtn" href="chartdashboard.php?id=<?php echo $_GET['id'];?>" role="button"><i class="bi bi-graph-up-arrow mr-1"></i> Stats</a>
    <a type="button" class="btn btn-sm mt-1 rounded d-flex justify-content-start mainBtn" href="chatbox.php?id=<?php echo $_GET['id'];?>" role="button"><i class="bi bi-chat-dots mr-1"></i> Chat</a>

    <!--Health Record button-->
  <!--a type="button" class="btn btn-sm mt-1 rounded d-flex justify-content-start mainBtn"  href="#healthRecord" role="button" data-toggle="collapse" data-target="#collapseHealthRecord" aria-expanded="true" aria-controls="collapseHealthRecord"><i class="bi bi-card-checklist mr-1"></i> Health Records</a>
    <div id="collapseHealthRecord" class="collapse my-1" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" >
        <div class="py-2 collapse-inner rounded mx-4">
            <h6 class="collapse-header" style="font-size: 13px;"></h6>

              <button type="button" onclick="gotoRecordStudent()" class="collapse-item btn btn-sm my-1 collapseBtn">Students</button><br>

              <button type="button" onclick="gotoRecordFaculty()" class="collapse-item btn btn-sm my-1 collapseBtn">Faculty/Staff</button><br>
              
              <button type="button" onclick="gotoRecordVisitor()" class="collapse-item btn btn-sm my-1 collapseBtn">Visitors</button><br>
          
              <button type="button" onclick="gotoRecordGuardian()" class="collapse-item btn btn-sm my-1 collapseBtn">Guardians</button><br>
      
        </div>
    </div-->
  
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
                    <input class="form-control form-control-sm border-right-0" type="search" placeholder="Search" aria-label="Search">
                    <span class="input-group-append bg-white border-left-0">
                        <span class="input-group-text bg-transparent">
                            <i class="bi bi-search"></i>
                        </span>
                    </span>
                </div>
            </form>
        </div>
    </nav>

    <!-- 2nd main div in content-->
    <div class="row no-gutters my-2 py-2 mx-auto px-1 rounded">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 rounded border bg-light" >
            <h5 class="ml-2 pt-3 pb-1 mb-2" style="font-size: 15px;">Recent Updates</h5>
            <div class="list-group mx-2 bg-light rounded" style="height: 17rem;" id="repoList">
                <?php
                //This will only get the newes 3 updates
                    $count = 0;
                    $data = new userAccountModel();
                    while($latestUpdateRow = mysqli_fetch_assoc($latestResult))
                    {
                        if($count<10)
                        {
                            $data->setId($latestUpdateRow['userAccountId']);
                            $latestUserResult = ReadUserAccount($conn,$data);
                            $latestUserRow = mysqli_fetch_assoc($latestUserResult);
                            ?>
                                <a type="button" class="list-group-item list-group-item-action" role="button" href="#<?php echo $latestUpdateRow['title'];?>" style="font-size: 13px; font-weight:bold;">
                                    <?php
                                        if($latestUserRow['gmail_Id'])
                                        {
                                            ?>
                                                <img class="mr-1" src="../upload/userImage/<?php echo $latestUserRow['imageName'];?>" width="40" height="40" class="border-dark" alt="" style="border-radius: 50%;"> <?php echo $latestUpdateRow['title'];?>
                                            <?php
                                        }
                                        else
                                        {
                                            if($latestUserRow['imageName'])
                                            {
                                                ?>
                                                    <img class="mr-1" src="../upload/userImage/<?php echo $latestUserRow['imageName'];?>" width="40" height="40" class="border-dark" alt="" style="border-radius: 50%;"> <?php echo $latestUpdateRow['title'];?>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <img class="mr-1" src="../asset/user.png" width="40" height="40" class="border-dark" alt="" style="border-radius: 50%;"> <?php echo $latestUpdateRow['title'];?>
                                                <?php
                                            }
                                        }
                                    ?>
                                </a>
                            <?php
                            $count++;
                        }
                    }
                ?>
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 bg-light rounded border">
            <div class="chart-container mx-auto">
                <canvas id="pie1" style="width: 100px; height: 100px;"></canvas>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 bg-light rounded border" style="min-height:20rem;">
        <form action="../controller/submitIdea.php" method="post">
            <input type="hidden" name="userId" value="<?php echo $userRow['id'];?>">
            <input type="hidden" name="repoId" value="<?php echo $repoRow['id'];?>">
            <h5 class="ml-2 mt-2 pt-3 pb-1 mb-2" style="font-size: 16px;"><span class=" d-flex justify-content-between">Ideas <button type="submit" class="btn btn-sm btn-success rounded mr-3" name="submitIdea"><i class="bi bi-clipboard-check"></i></button></span></h5>
            <div class="d-flex justify-content-center">
                <?php
                    $idea = new ideasModel();
                    $idea->setUserAccountId($userRow['id']);
                    $idea->setRepositoryId($repoRow['id']);
                    $ideaResult = ReadIdea($conn,$idea);
                    $ideaRow = mysqli_fetch_assoc($ideaResult);
                    //this will tell if the user has data in idea in this particular repo
                    if(isset($ideaRow['id']))
                    {
                        ?>
                            <input type="hidden" name="ideaId" value="<?php echo $ideaRow['id'];?>">
                            <textarea class="rounded" name="ideaTb" id="ideaTb" cols="35" rows="10" style="background-color:#FADB6F;" maxlength="1000"><?php echo $ideaRow['idea'];?></textarea>
                        <?php
                    }
                    else
                    {
                        ?>
                            <textarea class="rounded" name="ideaTb" id="ideaTb" cols="35" rows="10" style="background-color:#FADB6F;" maxlength="1000"></textarea>
                        <?php
                    }
                ?>
            </div>
        </form>
            
        </div>
    </div>
    <script>
        var myContri = 0;
        var memberContri = 0;
        var dataStat = [];
    </script>
    
    <!-- 3rd main div in content-->
    <div class="row no-gutters my-2 py-2 mx-auto px-1">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 rounded" style="height: 27rem;">
            <div class="table-wrapper-scroll-y my-custom-scrollbar rounded " style="height:25rem;">
                <table class="table table-striped table-hover table-sm text-justify mb-0 rounded" >
                        <caption id="tbCaption"></caption>
                        <thead class="text-light rounded" style="background-color:#234471;">
                            <tr style="font-size: 13px;">
                                <!--th scope="col" >#</th-->
                                <th scope="col">Title</th> 
                                <th scope="col" >Name</th>
                                <th colspan="2" scope="col" >Datetime</th>
                                <th colspan="4" class="text-center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="updateList">
                            
                                <?php
                                    while($updateRow = mysqli_fetch_assoc($result))
                                    {
                                        ?>
                                        
                                            <tr id="<?php echo $updateRow['title'];?>">
                                                <td style="font-size: 14px; font-weight:bold;"><?php echo $updateRow['title'];?></td>
                                                <?php
                                                    $data = new userAccountModel();
                                                    $data->setId($updateRow['userAccountId']);
                                                    $checkUserResult = ReadUserAccount($conn,$data);
                                                    $checkUserRow = mysqli_fetch_assoc($checkUserResult);

                                                    //This will collect the contribution of the current user vs. other members
                                                    if($userRow['id'] == $updateRow['userAccountId'])
                                                    {
                                                        ?>
                                                            <script>myContri++;</script>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                            <script>memberContri++;</script>
                                                        <?php
                                                    }
                                                ?>
                                                <td style="font-size: 13px;"><?php echo $checkUserRow['firstname'].' '.$checkUserRow['lastname'];?></td>
                                                <td style="font-size: 13px;"><?php echo date("M d, Y h:i a", strtotime($updateRow['datetimeCreation']));?></td>
                                                <td></td>
                                                
                                                <!-- Note Button -->
                                                <td style="width:15px;">
                                                    <div class="col-1">
                                                        <?php
                                                            if($updateRow['note'] != "")
                                                            {
                                                                ?>
                                                                    <button class="btn btn-sm btn-primary rounded" data-toggle="modal" data-target="#noteModal<?php echo $updateRow['id'];?>"><i class="bi bi-chat-left-dots"></i></button>

                                                                                                                                    
                                                                    <!-- Note Modal -->
                                                                    <div class="modal fade" id="noteModal<?php echo $updateRow['id'];?>" tabindex="-1" role="dialog" aria-labelledby="accSettModalTitle" aria-hidden="true" style="border-radius:12px;">
                                                                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="border-radius:12px;">
                                                                            <div class="modal-content" style="border-radius:12px;">
                                                                                <div class="modal-header" style="background-color: #6E85B7; color:whitesmoke; border-radius:7px;">
                                                                                    <h5 class="modal-title" id="accSettModalLongTitle">Note</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="../controller/editRepo.php" method="post" enctype="multipart/form-data">
                                                                                        <div class="form-group">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                                                                                    <textarea name="noteTb" id="noteTb" class="col-sm-12 col-xs-12 col-md-12 col-lg-12" rows="10" maxlength="500" placeholder="Write a note....." onclick="getTxtLength(this.id,'null')" disabled><?php echo $updateRow['note'];?></textarea>
                                                                                                    <!--span class="d-flex justify-content-end"><p id="lengthTxt">0/500</p></span-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                    <button class="btn btn-sm btn-secondary rounded disabled"><i class="bi bi-chat-left-dots"></i></button>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </td>

                                                <!-- Edit Button -->
                                                <td style="width:15px;">
                                                    <div class="col-1">
                                                        <?php
                                                            if($userRow['id'] == $updateRow['userAccountId'])
                                                            {
                                                                ?>
                                                                    <button class="btn btn-sm btn-warning rounded" data-toggle="modal" data-target="#editPostModal<?php echo $updateRow['id'];?>"><i class="bi bi-pencil-square"></i></button>
                                                                                                                                        
                                                                        <!-- Edit Post Modal -->
                                                                        <div class="modal fade" id="editPostModal<?php echo $updateRow['id'];?>" tabindex="-1" role="dialog" aria-labelledby="accSettModalTitle" aria-hidden="true" style="border-radius:12px;">
                                                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="border-radius:12px;">
                                                                                <div class="modal-content" style="border-radius:12px;">
                                                                                    <div class="modal-header" style="background-color: #6E85B7; color:whitesmoke; border-radius:7px;">
                                                                                        <h5 class="modal-title" id="accSettModalLongTitle"><i class="bi bi-pen"></i> Edit Post</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form action="../controller/updatePost.php" method="post" enctype="multipart/form-data">
                                                                                            <input type="hidden" name="updateId" id="updateId" value="<?php echo $updateRow['id'];?>">
                                                                                            <input type="hidden" name="repoId" id="repoId" value="<?php echo $repoRow['id'];?>">
                                                                                                <div class="form-group">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                                                                                            <label for="titleTb">Title</label>
                                                                                                            <input type="text" class="form-control form-control-sm" name="titleTb" id="titleTb" placeholder="Write a title" maxlength="50" required value="<?php echo $updateRow['title'];?>"/>
                                                                                                            
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                                                                                            <?php
                                                                                                                if($updateRow['filename'])
                                                                                                                {
                                                                                                                    ?>
                                                                                                                        <label for="fileTb">Attached File:</label>
                                                                                                                        <a class="text-success" href="../upload/repoId<?php echo $repoRow['id'];?>/<?php echo $updateRow['filename'];?>"><?php echo $updateRow['filename'];?></a>
                                                                                                                    <?php

                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                    ?>
                                                                                                                        <label for="fileTb">Attach File:</label>
                                                                                                                        <input type="file" class="form-control-file form-control-sm" id="fileTb" name="fileTb">
                                                                                                                    <?php
                                                                                                                }
                                                                                                            ?>
                                                                                                            
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="form-group">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                                                                                            <textarea name="noteTb" id="noteTb<?php echo $updateRow['id'];?>" class="col-sm-12 col-xs-12 col-md-12 col-lg-12" rows="10" maxlength="500" placeholder="Write a note....." onfocus="getTxtLength(this.id,'lengthTxt<?php echo $updateRow['id'];?>')" oninput="getTxtLength(this.id,'lengthTxt<?php echo $updateRow['id'];?>')"><?php echo $updateRow['title'];?></textarea>
                                                                                                            
                                                                                                            <span class="d-flex justify-content-end"><p id="lengthTxt<?php echo $updateRow['id'];?>">0/500</p></span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
                                                                                                        <button type="button" class="btn btn-sm bg-danger mx-1" name="submitPost" style="width: 8rem; color:whitesmoke;" onclick="deletePost(<?php echo $updateRow['id'];?>);">Delete Post</button>
                                                                                                        <button type="submit" class="btn btn-sm bg-success mx-1" name="submitPost" style="width: 8rem; color:whitesmoke;">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                    <button class="btn btn-sm btn-secondary rounded disabled"><i class="bi bi-pencil-square"></i></button>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </td>

                                                <!-- Version Button -->
                                                <td style="width:15px;">
                                                    <div class="col-1">
                                                        <button class="btn btn-sm rounded" style="background-color: #A020F0; color:whitesmoke;" type="button" data-toggle="collapse" data-target="#collapseVersion<?php echo $updateRow['id'];?>" aria-expanded="true" aria-controls="collapseVersion<?php echo $updateRow['id'];?>"><i class="bi bi-diagram-3"></i></button>
                                                    
                                                    </div>
                                                </td>

                                                <!-- Download and create version Button -->
                                                <td style="width:15px;">
                                                    <div class="col-1">
                                                        <button class="btn border-0 btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#d0d0d0;"><i class="bi bi-three-dots-vertical"></i></button>
                                                        <div class="dropdown-menu rounded" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#versionModal<?php echo $updateRow['id'];?>"><i class="bi bi-diagram-2-fill mr-1"></i>Create a version</a>
                                                            
                                                            <?php
                                                                //This will only trigger if theres a file to download
                                                                if($updateRow['filename']!="")
                                                                {
                                                                    ?>
                                                                        <a class="dropdown-item"  href="../upload/repoId<?php echo $repoRow['id'];?>/<?php echo $updateRow['filename'];?>" target="_blank"><i class="bi bi-download mr-1"></i>Download</a>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <!-- Create Version Modal -->
                                                    <div class="modal fade" id="versionModal<?php echo $updateRow['id'];?>" tabindex="-1" role="dialog" aria-labelledby="accSettModalTitle" aria-hidden="true" style="border-radius:12px;">
                                                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="border-radius:12px;">
                                                            <div class="modal-content" style="border-radius:12px;">
                                                                <div class="modal-header" style="background-color: #6E85B7; color:whitesmoke; border-radius:7px;">
                                                                    <h5 class="modal-title" id="accSettModalLongTitle"><i class="bi bi-diagram-2-fill mr-1"></i>Version: <span class="text-warning" style="font-size: 15px;"><?php echo $updateRow['title'];?></span></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="../controller/createVersion.php" method="post" enctype="multipart/form-data">
                                                                        <input type="hidden" name="updateId" id="updateId" value="<?php echo $updateRow['id'];?>">
                                                                        <input type="hidden" name="repoId" id="repoId" value="<?php echo $repoRow['id'];?>">
                                                                        <input type="hidden" name="userId" id="userId" value="<?php echo $userRow['id'];?>">
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
                                                                                        <textarea name="noteTb" id="versionNoteTb<?php echo $updateRow['id'];?>" class="col-sm-12 col-xs-12 col-md-12 col-lg-12" rows="10" maxlength="500" placeholder="Write a note....." oninput="getTxtLength(this.id,'versionLengthTxt<?php echo $updateRow['id'];?>')"></textarea>
                                                                                        
                                                                                        <span class="d-flex justify-content-end"><p id="versionLengthTxt<?php echo $updateRow['id'];?>">0/500</p></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
                                                                                    <button type="submit" class="btn btn-sm bg-success mx-1" name="submitPost" style="width: 8rem; color:whitesmoke;">Submit</button>
                                                                                </div>
                                                                            </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            <!--Version Row-->
                                                <tr>
                                                    <td colspan="8">
                                                        <div id="collapseVersion<?php echo $updateRow['id'];?>" class="collapse my-1 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 rounded" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="background-color:#b5b9bb;">
                                                        
                                                            <?php
                                                                //Version
                                                                $version = new versionModel();
                                                                $version->setUpdateId($updateRow['id']);
                                                                $versionResult = ReadVersion($conn,$version);
                                                                while($versionRow = mysqli_fetch_assoc($versionResult))
                                                                {
                                                                    //user who owns the version fetched
                                                                    $versionUser = new userAccountModel();
                                                                    $versionUser->setId($versionRow['userAccountId']);
                                                                    $userVersionResult = ReadUserAccount($conn,$versionUser);
                                                                    $userVersionRow = mysqli_fetch_assoc($userVersionResult);
                                                                    ?>
                                                                        <div class="d-flex py-2 collapse-inner rounded col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                            <h6 class="mt-2" style="font-size: 16px; font-weight:bold;"><i class="bi bi-arrow-bar-right mr-2"></i></h6>
                                                                            <h6 class="collapse-item mr-3 pr-3 mt-2" style="font-size: 12px; font-weight:bold;"><?php echo $updateRow['title']; ?></h6>
                                                                            <h6 class="collapse-item mx-3 px-3 mt-2" style="font-size: 12px;"><?php echo $userVersionRow['firstname'].' '.$userVersionRow['lastname']; ?></h6>
                                                                            <h6 class="collapse-item mx-4 px-3 mt-2" style="font-size: 12px;"><?php echo date("M d, Y h:i a", strtotime($versionRow['datetimeCreation'])); ?></h6>
                                                                            <button class="btn border-0 btn-sm rounded collapse-item ml-auto px-2 mt-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#b5b9bb;"><i class="bi bi-three-dots-vertical"></i></button>
                                                                            <div class="dropdown-menu rounded" aria-labelledby="dropdownMenuButton">
                                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#versionNoteModal<?php echo $versionRow['id'];?>"><i class="bi bi-stickies mr-1"></i>Note</a>
                                                                                
                                                                                <?php
                                                                                    //This will only trigger if theres a file to download
                                                                                    if($versionRow['filename'] != "")
                                                                                    {
                                                                                        ?>
                                                                                            <a class="dropdown-item"  href="../upload/repoId<?php echo $repoRow['id'];?>/version/<?php echo $versionRow['filename'];?>" target="_blank"><i class="bi bi-download mr-1"></i>Download</a>
                                                                                        <?php

                                                                                        /*
                                                                                        //Temporary removed
                                                                                        //to check the file extension type that appropriate to be check
                                                                                        $updateExtension = pathinfo($updateRow['filename'],PATHINFO_EXTENSION);
                                                                                        $versionExtension = pathinfo($versionRow['filename'],PATHINFO_EXTENSION);

                                                                                        if(strtolower($updateExtension) == 'txt' ||
                                                                                           strtolower($updateExtension) == 'doc' || 
                                                                                           strtolower($updateExtension) == 'docx' ||
                                                                                           strtolower($updateExtension) == 'pdf')
                                                                                        {
                                                                                            if(strtolower($versionExtension) == 'txt' ||
                                                                                               strtolower($versionExtension) == 'doc' || 
                                                                                               strtolower($versionExtension) == 'docx' ||
                                                                                               strtolower($versionExtension) == 'pdf')
                                                                                            {
                                                                                                $fileData1 = file_get_contents("../upload/repoId". $repoRow['id'] ."/". $updateRow['filename']);
                                                                                                $fileData2 = file_get_contents("../upload/repoId". $repoRow['id'] ."/version/". $versionRow['filename']);

                                                                                                
                                                                                                echo checkSimilarity($fileData1,$fileData2);

                                                                                            }
                                                                                        }
                                                                                        */
                                 

                                                                                    }
                                                                                ?>
                                                                            </div>


                                                                            <!-- Note Modal for version-->
                                                                            <div class="modal fade" id="versionNoteModal<?php echo $versionRow['id'];?>" tabindex="-1" role="dialog" aria-labelledby="accSettModalTitle" aria-hidden="true" style="border-radius:12px;">
                                                                                <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="border-radius:12px;">
                                                                                    <div class="modal-content" style="border-radius:12px;">
                                                                                        <div class="modal-header" style="background-color: #6E85B7; color:whitesmoke; border-radius:7px;">
                                                                                            <h5 class="modal-title" id="accSettModalLongTitle">Note</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form action="../controller/editRepo.php" method="post" enctype="multipart/form-data">
                                                                                                <div class="form-group">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                                                                                            <textarea name="noteTb" id="noteTb<?php echo $versionRow['id'];?>" class="col-sm-12 col-xs-12 col-md-12 col-lg-12" rows="10" maxlength="500" placeholder="Empty....." disabled><?php echo $versionRow['note'];?></textarea>
                                                                                                            <!--span class="d-flex justify-content-end"><p id="lengthTxt">0/500</p></span-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            </tr>
                                        <?php
                                    }
                                ?>
                        </tbody>
                </table>
                
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

                        <?php
                            //This will identify if the user is log in using their email then it will create a folder in their google drive
                            if($userRow['gmail_Id']!=null)
                            {
                                ?>
                                
                                    <input type="hidden" name="gmailId" id="gmailId" value="<?php echo $userRow['gmail_Id'];?>">
                                    <script>
                                            /* exported gapiLoaded */
                                            /* exported gisLoaded */
                                            /* exported handleAuthClick */
                                            /* exported handleSignoutClick */

                                            // TODO(developer): Set to client ID and API key from the Developer Console
                                            const CLIENT_ID = '509002600811-8ht8f7pc6hufkis14h82o1klij3k0797.apps.googleusercontent.com';
                                            const API_KEY = 'AIzaSyA1sWrq5rW03TVeWoPorXXxIQzr9VAkeOc';
                                            // Discovery doc URL for APIs used by the quickstart
                                            const DISCOVERY_DOC = 'https://www.googleapis.com/discovery/v1/apis/drive/v3/rest';

                                            // Authorization scopes required by the API; multiple scopes can be
                                            // included, separated by spaces.
                                            const SCOPES = 'https://www.googleapis.com/auth/drive.metadata.readonly https://www.googleapis.com/auth/userinfo.profile';

                                            let tokenClient = localStorage.getItem("response");
                                            var access_token;
                                            let gapiInited = false;
                                            let gisInited = false;

                                            const resToken = localStorage.getItem('response');
                                            document.getElementById('authorize_button').style.visibility = 'hidden';
                                            document.getElementById('signout_button').style.visibility = 'hidden';

                                            /**
                                             * Callback after api.js is loaded.
                                             */
                                            function gapiLoaded() 
                                            {
                                                gapi.load('client', initializeGapiClient);
                                                
                                                //gapi.client.setToken(localStorage.getItem("token"));
                                                //console.log(localStorage.getItem("token"));
                                            }

                                            /**
                                             * Callback after the API client is loaded. Loads the
                                             * discovery doc to initialize the API.
                                             */
                                            async function initializeGapiClient() {
                                                await gapi.client.init({
                                                apiKey: API_KEY,
                                                discoveryDocs: [DISCOVERY_DOC],
                                                });
                                                gapiInited = true;
                                                maybeEnableButtons();
                                            }

                                            /**
                                             * Callback after Google Identity Services are loaded.
                                             */
                                            function gisLoaded()
                                            {
                                                tokenClient = google.accounts.oauth2.initTokenClient({
                                                client_id: CLIENT_ID,
                                                scope: SCOPES,
                                                prompt: '',
                                                callback: (tokenResponse) => {
                                                    access_token = tokenResponse.access_token;
                                                }, // defined later
                                                });
                                                //console.log(access_token);
                                                gisInited = true;
                                                maybeEnableButtons();
                                            }

                                            /**
                                             * Enables user interaction after all libraries are loaded.
                                             */
                                            function maybeEnableButtons() {
                                                if (gapiInited && gisInited) {
                                                document.getElementById('authorize_button').style.visibility = 'visible';
                                                }
                                            }

                                            /**
                                             *  Sign in the user upon button click.
                                             */
                                            
                                            function handleAuthClick() {
                                                tokenClient.callback = async (resp) => {
                                                    if (resp.error !== undefined) 
                                                    {
                                                        throw (resp);
                                                    }
                                                    document.getElementById('signout_button').style.visibility = 'visible';
                                                    document.getElementById('authorize_button').innerText = 'Refresh';
                                                    await listFiles();
                                                };

                                                if (gapi.client.getToken() === null) 
                                                {
                                                    console.log('true');
                                                    // Prompt the user to select a Google Account and ask for consent to share their data
                                                    // when establishing a new session.
                                                    tokenClient.requestAccessToken();
                                                }
                                                else
                                                {
                                                    console.log('false');
                                                    // Skip display of account chooser and consent dialog for an existing session.
                                                    tokenClient.requestAccessToken();
                                                }
                                            }

                                            /**
                                            *  Sign out the user upon button click.
                                            */
                                            function handleSignoutClick() {
                                                const token = gapi.client.getToken();
                                                if (token !== null) {
                                                google.accounts.oauth2.revoke(token.access_token);
                                                gapi.client.setToken('');
                                                document.getElementById('content').innerText = '';
                                                document.getElementById('authorize_button').innerText = 'Authorize';
                                                document.getElementById('signout_button').style.visibility = 'hidden';
                                                }
                                            }

                                            /**
                                            * Print metadata for first 10 files.
                                            */
                                            async function listFiles() {
                                                let response;
                                                try {
                                                response = await gapi.client.drive.files.list({
                                                    'pageSize': 10,
                                                    'fields': 'files(id, name)',
                                                });
                                                } catch (err) {
                                                document.getElementById('content').innerText = err.message;
                                                return;
                                                }
                                                const files = response.result.files;
                                                if (!files || files.length == 0) {
                                                document.getElementById('content').innerText = 'No files found.';
                                                return;
                                                }
                                                // Flatten to string to display
                                                const output = files.reduce(
                                                    (str, file) => `${str}${file.name} (${file.id}\n`,
                                                    'Files:\n');
                                                document.getElementById('content').innerText = output;
                                                //console.log('token: '+Object.values(gapi.client.getToken()));
                                                localStorage.setItem("token",Object.values(gapi.client.getToken()));
                                                
                                            }
                                            handleAuthClick();
                                    </script>
                                    <script async defer src="https://apis.google.com/js/api.js" onload="gapiLoaded()"></script>
                                    <script async defer src="https://accounts.google.com/gsi/client" onload="gisLoaded()"></script>
                                <?php
                            }
                        ?>
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
    
    <!-- Google API -->
    <script type="text/javascript" src="../javascript/googleAPI-CreateFolder.js"></script>
    <script async defer src="https://apis.google.com/js/api.js"
        onload="gapiLoaded()"></script>
    <script async defer src="https://accounts.google.com/gsi/client"
        onload="gisLoaded()"></script>

</body>

<script>


    //To get my contribution
    var total = myContri+memberContri;
    var percentage = myContri/total;
    percentage = percentage*100;
    dataStat.push(Math.round(percentage));

    //To get member contribution
    percentage = memberContri/total;
    percentage = percentage*100;
    dataStat.push(Math.round(percentage));

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


/*
    var ctx2 = document.getElementById("line1").getContext('2d');
    var datasets = [43,54];
    var mybar = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['Locked','Unlocked'],
            datasets: [{
                label: 'HEADCOUNT',
                data: datasets,
                backgroundColor: [
                    '#FF0000',
                    '#008000',
                    '#FFFF00',
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
                borderColor: 'green',
                tension: 0.4,
                fill: false,
                spanGaps: true
            },
            {
                label: 'Percent',
                data: dataStat,
                backgroundColor: [
                    '#FF0000',
                    '#008000',
                    '#FFFF00',
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
                borderColor: 'blue',
                tension: 0.4,
                fill: false,
                spanGaps: true
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: "das",
                    fontSize: 300
                },
                legend:{
                    display: true
                }
            }
        }
    });
    */

   
    //this will make a image preview before it was uploaded
    imgTb.onchange = evt => {
    const [file] = imgTb.files
    if (file) {
        userImg.src = URL.createObjectURL(file)
    }
    }
</script>
</html>