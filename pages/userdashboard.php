<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';
    
    include_once '../db/tb_repository.php';
    include_once '../model/repositoryModel.php';
    
    include_once '../db/tb_updates.php';
    include_once '../model/updatesModel.php';

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
        .my-custom-scrollbar {
            position: relative;
            height: 200px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }

        #repoList{
            max-height: 780px;
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
            color: #F1F1F1;
            text-shadow: 1px 1px #1C1C1C;
        }

        .statDiv{
            height: 10rem;
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
            .statDiv{
                height: 10rem;
                box-shadow: none;
            }
            div.content {margin-left: 0;}
        }

        @media screen and (max-width: 400px) {
            .sidebar a {
                    text-align: center;
                    float: none;
            }
            .statDiv{
                height: 10rem;
                box-shadow: none;
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
        label{
            font-size: 12px;
            color: #234471;
        }
        
    </style>
    <link rel="icon" href="../asset/appIcon.png">
    <title>Uncluttered - User Dashboard</title>
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

                if($row['gmail_Id']!=null)
                {
                    ?>
                        <img src="../upload/userImage/<?php echo $row['imageName'];?>" width="100" height="100" class="border border-dark ml-3 my-1" alt="" style="border-radius: 50%;">
                    <?php
                }
                else
                {
                    
                    if($row['imageName']!==null && $row['imageName']!=='')
                    {
                        ?>
                            <img src="../upload/userImage/<?php echo $row['imageName'];?>" width="100" height="100" class="border border-dark ml-3 my-1" alt="" style="border-radius: 50%;">
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
        <h4 class="d-flex justify-content-center mx-auto px-auto mt-2 pt-1" id="nameLabel"><?php echo $row['firstname'].' '.$row['lastname']?></h4>
                    
        <h6 class="d-flex justify-content-center mx-auto px-auto mt-2 pt-1" id="usernameLabel" style="font-size: 12px;"><?php echo $row['username'];?></h6>
        <hr style="height:2px; border-width:0;background-color: #39445c;">
        <a type="button" class="btn btn-sm mt-1 rounded d-flex justify-content-start mainBtn" data-toggle="modal" role="button" data-target="#createRepoModal" style="color: whitesmoke;"><i class="bi bi-folder-plus mr-2"></i>Create Repository</a>
        <a type="button" class="btn btn-sm rounded d-flex justify-content-start mainBtn" data-toggle="modal" role="button" data-target="#accSettModal" style="color: whitesmoke;" id="accSettBtn"><i class="bi bi bi-sliders mr-2"></i>Account Settings</a>        
        <?php
            if($row['gmail_Id']!=null)
            {
                ?>
                    <script>
                        $('#accSettBtn').prop('disabled',true);//this will disable the edit repo button if the user is not the creator
                    </script>
                <?php
            }
        ?>      
        <hr style="height:2px; border-width:0;background-color: #39445c;">
        <a type="button" class="btn btn-sm rounded d-flex justify-content-start mainBtn bg-danger" id="signoutBtn" href="#" role="button" style="background-color: #485d8c;" onclick="return signout()"><i class="bi bi-power mr-2"></i>Sign-out</a>
    </div>

    <script>
        
        var hostedRepoCount = 0;
    </script>
    <div class="content">
        <div class="row no-gutters my-2 py-3 mx-auto px-1 rounded">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 rounded bg-light statDiv border">
                <?php
                    $repo = new repositoryModel();
                    $result = ReadRepo($conn,$repo);
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 rounded mt-2 pt-2">
                    
                    <h5 class="mx-auto" style="font-size: 15px;">Hosted Repository: </h5>
                </div>
                <center>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 rounded mt-4 pt-2">
                        <h2 class="mx-auto" style="font-size: 36px; color:#3466AA;"><i class="bi bi-person-workspace"></i> <span id="hostedCount"></span></h2>
                        <hr style="height:2px; border-width:0;background-color: #39445c;">
                    </div>
                </center>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 rounded bg-light mx-auto statDiv border">
                <?php
                    $updateInRepo = array();//contains repo id
                    $updateInRepoCount = array();//contains 
                    $updateCount = 0;
                    $update = new updatesModel();
                    $update->setUserAccountId($row['id']);

                    $updateResult = ReadUpdate($conn,$update);//This will retrieved all updates that belongs to the current user
                    while($updateRow = mysqli_fetch_assoc($updateResult))
                    {
                        $updateCount++;

                    }
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 rounded mt-2 pt-2">
                    <h5 class="mx-auto" style="font-size: 15px;">Overall Contribution: </h5>
                </div>
                <center>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 rounded mt-4 pt-2">
                        <h2 class="mx-auto" style="font-size: 36px; color:#3466AA;"><i class="bi bi-file-earmark-check-fill"></i> <span id="updatesCount"><?php echo $updateCount;?></span></h2>
                        <hr style="height:2px; border-width:0;background-color: #39445c;">
                    </div>
                </center>

            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 rounded bg-light statDiv border">
            
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 rounded mt-2 pt-2">
                    <h5 class="mx-auto" style="font-size: 15px;">Login Time: </h5>
                </div>
                <center>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 rounded mt-4 pt-2">
                        <h2 class="mx-auto" style="font-size: 36px; color:#3466AA;"><i class="bi bi-calendar-check-fill"></i> <span id="loginTime" style="font-size: 17px;"></span></h2>
                        <hr style="height:2px; border-width:0;background-color: #39445c;">
                    </div>
                </center>
                <script>
                    document.getElementById('loginTime').innerHTML = new Date().toLocaleString([], {year: 'numeric', month: 'numeric', day: 'numeric', hour: '2-digit', minute:'2-digit'});
                </script>
            </div>
        </div>
        <div class="row no-gutters my-1 py-1 mx-auto px-1 rounded">
            <!-- This column is for repository-->
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pb-2 rounded" style="background-color: #6E85B7;">
                <h5 class="pt-2 ml-2" id="pageTitle"><i class="bi bi-folder-fill"></i> Repositories</h5>
                <div class="list-group mx-2 bg-light rounded" style="height: 37rem;" id="repoList">
                    <?php
                        while($repoRow = mysqli_fetch_assoc($result))
                        {
                            $members = array();
                            $members = unserialize($repoRow['members']);
                            
                            //This will check if he/she is the only one in the repository to avoid error in array checking in only 1 element
                            if(is_array($members))
                            {
                                foreach($members as $userId)
                                {
                                    //to filter every repo that has the userid involved
                                    if($userId == $row['id'])
                                    {
                                        //this filter if the current user is the owner/creator of the repository
                                        if($repoRow['userAccountId'] == $row['id'])
                                        {
                                            ?>
                                                <a href="repodashboard.php?id=<?php echo $repoRow['id']?>" class="list-group-item list-group-item-action d-flex justify-content-between"><?php echo $repoRow['repositoryName'];?> <span class="text-success font-weight-bold">Creator <i class="bi bi-person-workspace"></i></span></a>
                                                <script>
                                                hostedRepoCount++;
                                                </script>
                                            <?php 
                                        }
                                        else
                                        {
                                            ?>
                                                <a href="repodashboard.php?id=<?php echo $repoRow['id']?>" class="list-group-item list-group-item-action d-flex justify-content-between"><?php echo $repoRow['repositoryName'];?> <span class="text-success font-weight-bold">Member <i class="bi bi-people-fill"></i></span></a>
                                            <?php 
                                        }
                                    }
                                }
                            }
                            else
                            {
                                //to filter every repo that has the userid involved
                                if($members == $row['id'])
                                {
                                    //this filter if the current user is the owner/creator of the repository
                                    if($repoRow['userAccountId'] == $row['id'])
                                    {
                                        ?>
                                            <a href="repodashboard.php?id=<?php echo $repoRow['id']?>" class="list-group-item list-group-item-action d-flex justify-content-between"><?php echo $repoRow['repositoryName'];?> <span class="text-success font-weight-bold">Creator <i class="bi bi-person-workspace"></i></span> </a>
                                            <script>
                                                hostedRepoCount++;
                                            </script>
                                        <?php 
                                    }
                                    else
                                    {
                                        ?>
                                            
                                            <a href="repodashboard.php?id=<?php echo $repoRow['id']?>" class="list-group-item list-group-item-action d-flex justify-content-between"><?php echo $repoRow['repositoryName'];?> <span class="text-success font-weight-bold">Member <i class="bi bi-people-fill"></i></span> </a>
                                        <?php 
                                    }
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Create Repository Modal -->
    <div class="modal fade" id="createRepoModal" tabindex="-1" role="dialog" aria-labelledby="createRepoModalTitle" aria-hidden="true" style="border-radius:12px;">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="border-radius:12px;">
            <div class="modal-content" style="border-radius:12px;">
                <div class="modal-header" style="background-color: #6E85B7; color:whitesmoke; border-radius:7px;">
                    <h5 class="modal-title" id="createRepoModalLongTitle">Create Repository</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        if($row['gmail_Id']!=null)
                        {
                            ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="gmail_Id" id="gmail_Id" value="<?php echo $row['gmail_Id'];?>">
                            <?php
                        }
                        else
                        {
                            ?>
                                <form action="../controller/createRepo.php" method="post" enctype="multipart/form-data">
                            <?php
                        }
                    ?>
                        <input type="hidden" name="creatorId" id="creatorId" value="<?php echo $row['id'];?>">
                        <input type="hidden" name="memberTb" id="memberTb" value="<?php echo $row['id'];?>">
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" name="repoNameTb" id="repoNameTb" placeholder="Repository Name" maxlength="30" required/>
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
                                                        <th scope="col" >Image</th> 
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
                                    
                                <?php
                                    if($row['gmail_Id']!=null)
                                    {
                                        ?>
                                            <button type="button" class="btn btn-sm bg-success" name="submitRepo" id="submitRepo" style="width: 8rem; color:whitesmoke;" onclick="submitRepoDetails()">Create</button>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <button type="submit" class="btn btn-sm bg-success" name="submitRepo" id="submitRepo" style="width: 8rem; color:whitesmoke;">Create</button>
                                        <?php
                                    }
                                
                                ?>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            
        /**
         *  Sign in the user upon button click.
         */

        function handleAuthClick(folderName, userEmail)
        {
            tokenClient.callback = async (resp) => {
                if (resp.error !== undefined)
                {
                    throw (resp);
                }

                //document.getElementById('signout_button').style.visibility = 'visible';
                //document.getElementById('authorize_button').value = 'Refresh';
                await createFolder(folderName);
                //await uploadFile();

            };
            
            //console.log(tokenClient.callback);

            if (gapi.client.getToken() === null)
            {
                // Prompt the user to select a Google Account and ask for consent to share their data
                // when establishing a new session.
                tokenClient.requestAccessToken({ hint: userEmail });
            }
            else
            {
                // Skip display of account chooser and consent dialog for an existing session.
                tokenClient.requestAccessToken({ hint: userEmail });
            }
        }

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


        function createFolder(folderName)
        {
            /*
            if(localStorage.getItem("access_token") === null)
            {
                localStorage.setItem("access_token",access_token);
            }
            else
            {
                var access_token = localStorage.getItem("access_token");
            }
            */
            var access_token = gapi.auth.getToken().access_token;
            
            var request = gapi.client.request({
                'path': '/drive/v2/files/',
                'method': 'POST',
                'headers': {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + access_token,             
                },
                'body':{
                    "title" : folderName,
                    "mimeType" : "application/vnd.google-apps.folder",
                    'type': 'anyone',
                    'role': 'reader'
                }
            });
        
            request.execute(function(resp)
            { 
                submit(resp.id);
                console.log('Folder'); 
                console.log(resp); 
                insertPermission(resp.id, access_token);
                location.reload();
                //uploadFile(resp.id);
                //console.log(parent);
                //document.getElementById("info").innerHTML = "Created folder: " + resp.title;
            });
        }



        function insertPermission(fileId, oauthToken)
        {
            
            var request1 = gapi.client.request({
                'path': '/drive/v3/files/' + fileId + '/permissions',
                'method': 'POST',
                'headers': {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + oauthToken
                },
                'body':{
                    'type': 'anyone',
                    'role': 'reader'
                }
            });
            request1.execute(function(resp) {
                console.log(resp);
            });
        }



        async function submitRepoDetails()
        {
            $("body").css({"pointer-events": "none", "opacity": "0.5"});//This will disable the click and add gray shade in body

            $('#submitRepo').prop('disabled',true);//To prevent submitting the form multiple times
            var userEmail = <?php echo json_encode($row['email']); ?>;

            var repoName = document.getElementById('repoNameTb').value;
            /*
            var creatorId = document.getElementById('creatorId').value;
            var memberTb = document.getElementById('memberTb').value;
            var gmail_Id = document.getElementById('gmail_Id').value;
            var memberTb = document.getElementById('memberTb').value;
            */
            //var folderId;
            if(repoName)
            {
                //repoName is used for the gdrive folder's name
                //await, is to make the code below of this function wait until this function is finished
                await handleAuthClick(repoName, userEmail);

                //submit(repoName,creatorId, memberTb, gmail_Id);
                //const myTimeout = setTimeout(submit(repoName,creatorId, memberTb, gmail_Id), 2500);
                
                
            }
        }

        //To save repo info to database
        function submit(folderId)
        {

            var repoName = document.getElementById('repoNameTb').value;
            var creatorId = document.getElementById('creatorId').value;
            var memberTb = document.getElementById('memberTb').value;
            var gmail_Id = document.getElementById('gmail_Id').value;
            var memberTb = document.getElementById('memberTb').value;

            //This will ensure that the folder is truely created in the user google drive via checking the folderId
            if(folderId)
            {
                var http = new XMLHttpRequest();
                    http.open("POST", "../controller/createRepo.php", true);
                    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                    console.log(folderId);
                    //This is the form input fields data
                    var params = "repoNameTb=" + repoName+"&creatorId=" + creatorId+"&memberTb=" + memberTb+"&submitRepo=" + submitRepo+"&gmail_Id=" + gmail_Id+"&folderId=" + folderId; // probably use document.getElementById(...).value
                    http.send(params);
                    http.onload = function()
                    {
                        var data = http.responseText;
                        //console.log(data);
                        const myTimeout = setTimeout(reloadPage, 2500);
                    }
            }
            else
            {
                console.log('null folderId');
            }
        }

        function reloadPage()
        {
            location.reload();
        }
        
    </script>


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
                        <input type="hidden" name="idTb" value="<?php echo $row['id'];?>">
                        <input type="hidden" name="imageNameTb" value="<?php echo $row['imageName'];?>">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 pt-2 mt-2 d-flex justify-content-center">
                                    <?php
                                        if($row['imageName'])
                                        {
                                            ?>
                                                <img src="../upload/userImage/<?php echo $row['imageName'];?>" width="90" height="90" class="d-inline-block align-top border border-dark" alt="" style="border-radius: 50%;" id="userImg">
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
                                    <input type="text" class="form-control form-control-sm form-control-plaintext border-primary border-bottom border-top-0 bg-light" id="fnameTb" name="fnameTb" placeholder="Ex. Marie" maxlength="50" required value="<?php echo $row['firstname'];?>">
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 pt-2 mt-2">
                                    <label class="d-flex align-items-start" for="lnameTb">Last name</label> 
                                    <input type="text" class="form-control form-control-sm form-control-plaintext border-primary border-bottom border-top-0 bg-light" id="lnameTb" name="lnameTb" placeholder="Ex. Cruz" maxlength="50" required value="<?php echo $row['lastname'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <label class="d-flex align-items-start" for="usernameTb">Username</label>
                                    <input type="text" class="form-control form-control-sm form-control-plaintext border-primary border-bottom border-top-0 bg-light" id="usernameTb" name="usernameTb" placeholder="Ex. Marie0123" maxlength="20" required value="<?php echo $row['username'];?>">
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
                                    <input type="email" class="form-control form-control-plaintext border-primary border-bottom border-top-0 form-control-sm bg-light" id="emailTb" name="emailTb" placeholder="Ex. myMail@gmail.com" maxlength="100" required  value="<?php echo $row['email'];?>">
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
        if(isset($_GET['editAccRes']))
        {
            if($_GET['editAccRes']==1)
            {
                ?>
                    <script>
                        document.getElementById('alertBox').style.display = 'block';
                        document.getElementById('errorMsg').innerHTML = 'Username already Exist!';
                    </script>
                <?php
            }
            else if($_GET['editAccRes']==2)
            {
                ?>
                    <script>
                        document.getElementById('successBox').style.display = 'block';
                        document.getElementById('successMsg').innerHTML = 'Saved Data successfully!';
                    </script>
                <?php
            }
            ?>
                <script>
                    //to reset the $_GET in URL
                    const url = new URL(window.location.href);
                    url.searchParams.delete('editAccRes');
                    window.history.replaceState(null, null, url); // or pushState
                </script>
            <?php
        }
    ?>
    <!-- Google API -->
    <script type="text/javascript" src="../javascript/googleAPI-Credentials.js"></script>
    <script async defer src="https://apis.google.com/js/api.js"
        onload="gapiLoaded()"></script>
    <script async defer src="https://accounts.google.com/gsi/client"
        onload="gisLoaded()"></script>

</body>
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



    var myName = <?php echo json_encode($row['username'])?>;
    const newMsg = ref(database, 'messages/');
    

    //To wait the data in chat interaction to fetch completely
    const myTimeout = setTimeout(getChat, 500);
    
    function getChat()
    {
        onChildAdded(newMsg, (data) => {


            if(data.val().name != myName)
            {
                //This is for the other member message


                //console.log(data.val().imageName);
                //this will check the file origin of the image of user
                if(data.val().imageName!=null && data.val().imageName!="")
                {
                    var imageFile = '<img class="mr-1" src="../upload/userImage/'+data.val().imageName+'" width="30" height="30" class="border-dark" alt="" style="border-radius: 50%;">';
                }
                else
                {
                    var imageFile = '<img class="mr-1" src="../asset/user.png" width="30" height="30" class="border-dark" alt="" style="border-radius: 50%;">';
                }

                var divData =   '<div class="d-flex justify-content-start my-2">'+
                                                '<div class="px-1 d-flex align-items-end">'+
                                                    imageFile+
                                                '</div>'+
                                                '<div class="otherMsg bg-primary px-2 py-2">'+
                                                    '<p class="chatName">'+data.val().name+'</p>'+
                                                    data.val().message+
                                                '</div>'+
                                            '</div>';


            }
            else if(data.val().name == myName)
            {
                //this function is called to check and update user image
                updateFirebase(data.key);
                    //console.log("myData ");
                    //console.log(data.key);
                //This is for the user message
                

                //this will check the file origin of the image of user
                if(data.val().imageName!=null && data.val().imageName!="")
                {
                    var imageFile = '<img class="mr-1" src="../upload/userImage/'+data.val().imageName+'" width="30" height="30" class="border-dark" alt="" style="border-radius: 50%;">';
                }
                else
                {
                    var imageFile = '<img class="mr-1" src="../asset/user.png" width="30" height="30" class="border-dark" alt="" style="border-radius: 50%;">';
                }

                var divData = '<div class="d-flex justify-content-end my-2">'+
                                                '<div class="myMsg px-2 py-2">'+
                                                    '<p class="chatName">'+data.val().name+'</p>'+
                                                    data.val().message+
                                                '</div>'+
                                                '<div class="px-1 d-flex align-items-end">'+
                                                imageFile+
                                                '</div>'+
                                            '</div>';
                
            }
            
        });
       
    }

    //this will update user image
    function updateFirebase(id)
    {
        var newImg = <?php echo json_encode($row['imageName'])?>;
        update(ref(database, 'messages/' + id),{
            imageName: newImg
        });
    }

</script>

<script>
    
    hostRepoCount(hostedRepoCount);
    function hostRepoCount(count)
    {
        document.getElementById('hostedCount').innerHTML = count;
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


    const members = [];
    members.push(<?php echo json_encode($row['id']);?>);
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

    //this will make a image preview before it was uploaded
    imgTb.onchange = evt => {
    const [file] = imgTb.files
    if (file) {
        userImg.src = URL.createObjectURL(file)
    }
    }
</script>
</html>