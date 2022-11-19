<?php
/*
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['login']))
    {
        header("Location: userDashboard.php");
    }
    
    date_default_timezone_set('Asia/Manila');
    */
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


    <script src="../javascript/linked.js"></script>
    <link rel="stylesheet" href="css/login.css">

    <style>
 


 .form-control{
    border: 0;
}


 @media screen and (max-height: 850px) {

.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height:max-content;
    width:max-content;
    padding: 5px;
    text-align: center;
    border-radius: 15px;
    box-shadow: -1px 1px 20px 6px black;
}
}

@media screen and (max-width: 650px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height:max-content;
    width:max-content;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

@media screen and (max-width: 450px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height:max-content;
    width:max-content;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}


@media screen and (max-width: 360px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height: 890px;
    width: 350px;
    padding: 20px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

/* S8+ */
@media screen and (max-width: 375px) {
body{  
    background-color: #f1f1f1;
}
.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height:max-content;
    width:max-content;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
footer * {
    font-size: 17px;
}

}  

/* S9 */
@media screen and (max-width: 320px) {
body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.container {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height:max-content;
    width:max-content;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
footer * {
    font-size: 17px;
}

}
    </style>
    <link rel="icon" href="asset/appIcon.png">
    <title>Uncluttered - Login</title>
</head>
<body>
    <!-- Image and text Header-->
    <nav class="navbar navbar-light" style="background-color: #6E85B7;">
        <a class="navbar-brand" href="#" style="font-weight:bold; color: whitesmoke; text-shadow: 1px 1px #1C1C1C; font-size:25px">
            <img src="asset/appIcon.png" width="40" height="40" class="d-inline-block align-top" alt="">
            Uncluttered
        </a>
     </nav>

    <div class="row myRow mt-5 pt-5 mx-auto">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-5 py-5">
            <div class="container">
                <div class="d-flex justify-content-center my-3">
                    <form action="controller/login.php" method="post" enctype="multipart/form-data">  
                        <input type="hidden" name="accType" value="visitor">
                        <div class="form-group">
                            <center>
                            <h2>Log in</h2>
                            </center>
                            <hr style="height:2px; border-width:0;background-color: #3466AA">
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <input type="text" class="form-control form-control-sm form-control-plaintext border-primary border-bottom bg-light" id="usernameTb" name="usernameTb" placeholder="Username" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-1 mt-1">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <input type="password" class="form-control form-control-plaintext border-primary border-bottom form-control-sm bg-light" id="passwordTb" name="passwordTb" placeholder="Password" minlength="8" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <button type="submit" class="form-control btn" id="submitLogin" name="submitLogin" style="background-color: #3466AA; color:white;">Login</button>
                                    <small>Don't have any account? <a class="text-primary" href="pages/signup.php">Just Click here</a> to create</small><br>

                                    <small><button type="button" class="text-primary border-0" onclick="gotoFindAccount();">Forgot Password?</button></small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Footer Section-->
    <div class="row no-gutters">
        <footer class=" text-center text-lg-end fixed-bottom">
            <div class="d-flex justify-content-center p-3" style="background-color: #B2C8DF;">
            <!--  <h5 style="background-color:#E78F14;"><a href="https://www.facebook.com/balayan.sti.edu/" target="_blank" class="mx-2" style="background-color:#E78F14;"><i class="bi bi-facebook" style="background-color:#E78F14;"></i></a></h5>
                <h5 style="background-color:#E78F14;"><a href="mailto:richardjohn.encarnacion@batangas.sti.edu" target="_blank" class="mx-2"><i class="bi bi-envelope-fill" style="background-color:#E78F14;"></i></a></h5>
                <h5 style="background-color:#E78F14;"><a href="https://maps.google.com/?q=STI College - Batangas, 865 National Road, Batangas, 4200 Batangas" target="_blank" class="mx-2"><i class="bi bi-geo-alt-fill" style="background-color:#E78F14;"></i></a></h5>
                <h5 style="background-color:#E78F14;"><a href="https://www.sti.edu/campuses-details.asp?campus_id=BAT" target="_blank" class="mx-2"><i class="bi bi-info-square-fill" style="background-color:#E78F14;"></i></a></h5> -->
            </div>
        </footer>
    </div>

    <?php
    if(isset($_GET['signupRes'])==1)
    {
        unset($_GET['signupRes']);
        ?>
            <!-- Alert message container-->
            <div id="successBox" class="alert alert-success alert-dismissible fade show" role="alert" style="display:block;">
                <strong id="successMsg">Account Created Successfully</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php

    }
    else if(isset($_GET['signupRes'])==2)
    {
        ?>
            <!-- Alert message container-->
            <div id="alertBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:block;">
                <strong id="errorMsg">Holy guacamole!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php

    }

    ?>
    
</body>
    <!--alert message script-->
    <script>
        //document.getElementById('successBox').style.display = 'none';
        //document.getElementById('alertBox').style.display = 'none';
        //var successSignal = localStorage.getItem('state');

        if(successSignal==1)
        {
            //if incorrect password
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = 'Incorrect password please try again';
            console.log("okay");

        }
        else if(successSignal==2)
        {
            //if email is already taken
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = 'Sorry, this account is not existing';
            console.log("okay");
        }
        else if(successSignal==3)
        {
            //if password doesn't matched
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = "Password doesn't match!";
            console.log("okay");
        }
        else if(successSignal==4)
        {
            //if password doesn't matched
            document.getElementById('successBox').style.display = 'block';
            document.getElementById('successMsg').innerHTML = "Account Created Successfully!";
            console.log("okay");
        }
        else if(successSignal==5)
        {
            //if the account is locked
            document.getElementById('alertBox').style.display = 'block';
            document.getElementById('errorMsg').innerHTML = "This account is locked, please contact the admin";
            console.log("okay");
        }
        else if(successSignal==6)
        {
            //if the user is successfully reset password
            document.getElementById('successBox').style.display = 'block';
            document.getElementById('successMsg').innerHTML = "Reset Password Successfully!";
            console.log("okay");
        }

        //To make signl back to normmal and to prevent for the success page to appear every time the page was reload or refresh
        //localStorage.setItem('state',0);
    </script>
</html>