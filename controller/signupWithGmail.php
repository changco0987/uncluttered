<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';


    if(isset($_POST['submitBtn']))
    {
        $data = new userAccountModel();
        $data->setGmail_Id($_POST['gmail_IdTb']);
        
        $result = ReadGmailUser($conn,$data);
        while($row = mysqli_fetch_assoc($result))
        {
            //this will check if the inputted username is existed
            if($row['gmail_Id'] == $data->getGmail_Id())
            {
                //send error message to signup page
                //This is the equivalent of signupRes = 1
                echo '1';
                exit;
            }
        }
            
    
        $data->setFirstname($_POST['fnameTb']);
        $data->setLastname($_POST['lnameTb']);
        $data->setUsername($_POST['usernameTb']);
        $data->setPassword($_POST['passwordTb']);
        $data->setEmail($_POST['emailTb']);
        $randId = rand(11111111, 99999999);
        copy($_POST['imageName'], "../upload/userImage/img$randId.jpg");
        $data->setImageName("img$randId.jpg");

        //if the program is occur in this area it means that the username is unique and successfully created
        CreateGmailUser($conn,$data);
        //This is the equivalent of signupRes = 2
        echo '2';
        exit;
    }
    else
    {
        header("location: ../pages/signup.php");
    }

?>