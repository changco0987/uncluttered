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
    </style>
    <link rel="icon" href="../asset/appIcon.png">
    <title>Uncluttered - User Dashboard</title>
</head>
<body>

    <div class="container-fluid ">
        
        <div class="row my-2 py-2 flex-grow-1 mx-1 px-1 ">
            <!-- Profile column-->
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
                        <button type="button" class="form-control btn d-flex justify-content-center my-2" data-toggle="modal" data-target="#createRepoModal" id="accSettBtn" style="background-color: #3466AA; color:white;"><i class="bi bi-folder-plus mr-2"></i>Create Repository</button>
                        <button type="button" class="form-control btn d-flex justify-content-center my-2" data-toggle="modal" data-target="#accSettModal" id="accSettBtn" style="background-color: #3466AA; color:white;"><i class="bi bi bi-sliders mr-2"></i>Account Settings</button>
                        <a type="button" class="form-control btn d-flex justify-content-center bg-danger my-2" id="signoutBtn" style="color:white;" href="../controller/wipedata.php"><i class="bi bi-box-arrow-left mr-2"></i>Sign-out</a>
                    </div>
                    
                </div>
            </div>
    
            <!-- This column is for repository-->
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-9 col-xl-9 mx-auto">
                <div class="bg-warning rounded  pb-2">
                    <h2 class="pt-2 ml-2"><i class="bi bi-folder-fill"></i> Repositories</h2>
                    <div class="list-group mx-2 bg-light" style="height: 50rem;" id="repoList">
                        <?php
                            $repo = new repositoryModel();
                            $result = ReadRepo($conn,$repo);

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
                                            if($repoRow['userAccountId']==$row['id'])
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
                                        if($repoRow['userAccountId']==$row['id'])
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
    </div>

    
    <!-- Account Settings Modal -->
    <div class="modal fade" id="createRepoModal" tabindex="-1" role="dialog" aria-labelledby="accSettModalTitle" aria-hidden="true" style="border-radius:12px;">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="border-radius:12px;">
            <div class="modal-content" style="border-radius:12px;">
                <div class="modal-header" style="background-color: #6E85B7; color:whitesmoke; border-radius:7px;">
                    <h5 class="modal-title" id="accSettModalLongTitle">Create Repository</h5>
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
                                        <input type="text" class="form-control form-control-sm" name="repoNameTb" id="repoNameTb" placeholder="Repository Name" maxlength="100" required/>
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
</script>
</html>