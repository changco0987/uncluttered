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

    <!--Google API (GSI)-->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <!--My CSS and JS-->
    <!--link type="text/css" rel="stylesheet" href="../css/signup.css"/-->
    <!--script src="../javascript/index.js"></script-->
    <style>
    body{
        background-color: whitesmoke;
        font-family:"Bahnschrift", Times, serif;
    }

label{
    font-size: 12px;
    color: #234471;
}

.containerForm{
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height: max-content;
    width: max-content;
    padding: 20px;
    text-align: center;
    border-radius: 15px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    
}


.form-control{
    border: 0;
}


@media screen and (max-height: 850px) {

.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height: max-content;
    width: max-content;
    padding: 15px;
    text-align: center;
    border-radius: 15px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
}

@media screen and (max-width: 650px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 35%;
    left: 50%;
    transform: translateX(-50%) translateY(-35%);
    height: 750px;
    width: 385px;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

/* S20 Ultra and iphone6/7/8 Plus*/
@media screen and (max-width: 450px) {
    body{  
    background-color: #f1f1f1;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translateX(-50%) translateY(-40%);
    height: 700px;
    width: 385px;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

/* S8+ */
@media screen and (max-width: 360px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 35%;
    left: 50%;
    transform: translateX(-50%) translateY(-35%);
    height: 890px;
    width: 350px;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

/* S9 */
@media screen and (max-width: 320px) {
body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 25%;
    left: 50%;
    transform: translateX(-50%) translateY(-25%);
    height: 750px;
    width: 300px;
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
    <title>Uncluttered - Terms and Conditions</title>
</head>
<body>
    <script>
        
        const url = new URL(window.location.href);
    </script>
    
    <!-- Image and text Header-->
    <nav class="navbar navbar-light" style="background-color: #6E85B7;">
        <a class="navbar-brand" href="#" style="font-weight:bold; color: whitesmoke; text-shadow: 1px 1px #1C1C1C; font-size:25px">
            <img src="asset/appIcon.png" width="40" height="40" class="d-inline-block align-top" alt="">
            Uncluttered
        </a>
    </nav>
     <div class="container">
        <div class="row my-4 pb-4">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 mt-1 pt-2 d-flex align-items-center">
                <img src="asset/burst.png" width="80" height="80" class="img-fluid mb-2 mr-2" alt="" srcset=""><h1>Be productive with Uncluttered</h1></img>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 mt-1 pt-2 d-flex align-items-center">
                <h6 style="font-weight:lighter;">A web-based application that will serve as a digital working environment for group or individual projects to enhance user productivity. This can be a tool for exterminating unorganized important files and tracking the unresponsive members wherever they are participating or not.</h6>
            </div>
        </div>
        <div class="row my-4 pb-4">
            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6 mt-1 pt-2">
                <img src="asset/folder.png" width="50" height="50"  class="img-fluid mr-2" alt="" srcset=""><h4>Organized files</h4></img>
                <h6 style="font-size: 15px; font-weight:lighter;">Uncluttered has the capability to securely store Important files in one place, thanks to integrated Google Drive storage file system.</h6>
            </div>
            
            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6 mt-1 pt-2">
                <img src="asset/bar-chart.png" width="50" height="50"  class="img-fluid mr-2" alt="" srcset=""><h4>Track Members</h4></img>
                <h6 style="font-size: 15px; font-weight:lighter;">This can also be used to monitor all member's participation and to track individual contributions to a team project.</h6>
            </div>
            
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 mt-1 pt-2">
                <img src="asset/communication.png" width="50" height="50"  class="img-fluid mr-2" alt="" srcset=""><h4>Communication</h4></img>
                <h6 style="font-size: 15px; font-weight:lighter;">Uncluttered has a built-in chat system that you can use to brainstorm and share ideas with other members of your team.</h6>
            
                <hr style="height:1px; border-width:0;background-color: #3466AA">
            </div>
        </div>
        <div class="row my-4 pb-4">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 mt-1 pt-2 d-flex justify-content-center">
                <h4>Get Started:</h4>
            </div>
            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6 mt-1 pt-2 d-flex justify-content-md-end">
                <a type="button" class="btn btn-sm nav-link rounded text-light col-md-3" id="siginBtn" href="pages/signup.php" role="button" style="background-color: #485d8c;" onclick="return signout()"><i class="bi bi-pencil-square mr-2"></i>Sign-in</a>
            </div>
            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6 mt-1 pt-2">
                <a type="button" class="btn btn-sm nav-link rounded text-light col-md-3" id="loginBtn" href="login.php" role="button" style="background-color: #3466AA; color:white;" onclick="return signout()"><i class="bi bi-box-arrow-in-right mr-2"></i>Log in</a>
            </div>
        </div>
        <div class="row my-4 pb-4">
            <!-- This is just a blank row to act like a spacing -->
        </div>
     </div>
    <!--Footer Section-->
    <div class="row no-gutters">
        <footer class=" text-center text-lg-end fixed-bottom">
            <div class="d-flex justify-content-center p-3" style="background-color: #B2C8DF;">
            <a href="privacy.php" class="mx-2" target="_blank" rel="noopener noreferrer">Privacy and Policy</a>
            <a href="terms.php" class="mx-2">Terms and condition</a>
            <!--  <h5 style="background-color:#E78F14;"><a href="https://www.facebook.com/balayan.sti.edu/" target="_blank" class="mx-2" style="background-color:#E78F14;"><i class="bi bi-facebook" style="background-color:#E78F14;"></i></a></h5>
                <h5 style="background-color:#E78F14;"><a href="mailto:richardjohn.encarnacion@batangas.sti.edu" target="_blank" class="mx-2"><i class="bi bi-envelope-fill" style="background-color:#E78F14;"></i></a></h5>
                <h5 style="background-color:#E78F14;"><a href="https://maps.google.com/?q=STI College - Batangas, 865 National Road, Batangas, 4200 Batangas" target="_blank" class="mx-2"><i class="bi bi-geo-alt-fill" style="background-color:#E78F14;"></i></a></h5>
                <h5 style="background-color:#E78F14;"><a href="https://www.sti.edu/campuses-details.asp?campus_id=BAT" target="_blank" class="mx-2"><i class="bi bi-info-square-fill" style="background-color:#E78F14;"></i></a></h5> -->
            </div>
        </footer>
    </div>
    <script>
        
        function handleCredentialResponse(response)
        {
            const responsePayload = decodeJwtResponse(response.credential);
            console.log('ID: '+responsePayload.sub);
            console.log('Full Name: '+responsePayload.name);
            console.log('Given Name: '+responsePayload.given_name);
            console.log('Family Name: '+responsePayload.family_name);
            console.log('Image URL: '+responsePayload.picture);
            console.log('Email: '+responsePayload.email);

            var http = new XMLHttpRequest();
                http.open("POST", "controller/signupWithGmail.php", true);
                http.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                //This is the form input fields data
                var params = "submitBtn="+true+
                            "&usernameTb="+responsePayload.email+
                            "&passwordTb="+responsePayload.sub+
                            "&fnameTb="+responsePayload.given_name+
                            "&lnameTb="+responsePayload.family_name+
                            "&emailTb="+responsePayload.email+
                            "&imageName="+responsePayload.picture+
                            "&gmail_IdTb="+responsePayload.sub; // probably use document.getElementById(...).value

                http.send(params);
                http.onload = function() 
                {
                    var signupRes = http.responseText;
                    console.log(signupRes);

                    if(signupRes =='1')
                    {
                        url.searchParams.set('signupRes', signupRes);
                        window.history.replaceState(null, null, url); // or pushState
                        location.reload();
                        
                    }
                    else if(signupRes =='2')
                    {
                        url.searchParams.set('signupRes', signupRes);
                        window.history.replaceState(null, null, url); // or pushState
                        window.location = 'login.php';
                    }
                    //returnDate();
                    //console.log(params);
                }
        }

        function decodeJwtResponse(data)
        {
            var tokens = data.split(".");
            return JSON.parse(atob(tokens[1]));
        }
    </script>
<?php
    if(isset($_GET['response'])==1)
    {
        ?>
        <!-- Alert message container-->
        <div id="alertBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:block ;">
            <strong id="errorMsg">Username doesn't exist!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            //to reset the $_GET in URL
            url.searchParams.delete('response');
            window.history.replaceState(null, null, url); // or pushState
        </script>
        <?php

    }

?>
</body>
</html>

