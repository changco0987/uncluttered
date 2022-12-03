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
        .my-custom-scrollbar {
            position: relative;
            height: 200px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }
        .modal-xl {
            max-width: 50% !important;
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
        label{
            font-size: 12px;
            color: #234471;
        }
    </style>
    <link rel="icon" href="../asset/appIcon.png">
    <title>Uncluttered - User Dashboard</title>
</head>
<body>
        
    <div class="sidebar text-center">
                <!-- Alert message container-->
                <div id="successBox" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
                    <strong id="successMsg"></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Alert message container-->
                <div id="alertBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none ;">
                    <strong id="errorMsg"></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <a class="navbar-brand d-flex justify-content-center" href="#">
            <?php

                if($row['gmail_Id']!=null)
                {
                    ?>
                        <img src="<?php echo strval($row['imageName']);?>" width="100" height="100" class="border border-dark ml-3 my-1" alt="" style="border-radius: 50%;">
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
        </a>
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
        <a type="button" class="btn btn-sm rounded d-flex justify-content-start mainBtn bg-danger" id="signoutBtn" href="../controller/wipedata.php" role="button" style="background-color: #485d8c;"><i class="bi bi-box-arrow-left mr-2"></i>Sign-out</a>
    </div>

    <div class="content">
        <div class="row no-gutters my-2 py-3 mx-auto px-1 rounded">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 rounded d-flex align-items-center bg-light" style="height: 10rem; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            <?php
                $repo = new repositoryModel();
                $result = ReadRepo($conn,$repo);
            ?>
                <h5 class="mx-auto">Repository: </h5>

            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-3 rounded d-flex align-items-center bg-light mx-auto" style="height: 10rem; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
        
                <h5 class="mx-auto">Repository: </h5>

            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 rounded d-flex align-items-center bg-light" style="height: 10rem; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            
                <h5 class="mx-auto">Repository: </h5>

            </div>
        </div>
        <div class="row no-gutters my-1 py-1 mx-auto px-1 rounded" style="background-color: #6E85B7;">
            <!-- This column is for repository-->
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pb-2">
                <h5 class="pt-2 ml-2" id="pageTitle"><i class="bi bi-folder-fill"></i> Repositories</h5>
                <div class="list-group mx-2 bg-light rounded" style="height: 37rem;" id="repoList">
                    <?php
                        while($repoRow = mysqli_fetch_assoc($result))
                        {
                            $members = array();
                            $members = unserialize($repoRow['members']);
                            
                            //This will check if he is the only one in the repository to avoid error in array checking in only 1 element
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
                    <form action="../controller/createRepo.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="creatorId" value="<?php echo $row['id'];?>">
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
                                    <button type="submit" class="btn btn-sm bg-success" name="submitRepo" style="width: 8rem; color:whitesmoke;">Create</button>
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
</body>
<script>



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
        console.log(vala);
    }

    //This is to preserve the added color 'red' to every button
    function preserveBtnColor()
    {
        var length = members.length-1;
      
        while(length>=0)
        {
            console.log('inside while');
            if(members.includes(members[length]))
            {
                console.log('inside if '+ members[length]);
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