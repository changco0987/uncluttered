<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';


    if(isset($_POST['submitBtn']))
    {
        $data = new userAccountModel();
        $data->setUsername($_POST['usernameTb']);
        
        $result = ReadUserAccount($conn,$data);
        while($row = mysqli_fetch_assoc($result))
        {
            //this will check if the inputted username is existed
            if($row['username'] == $data->getUsername())
            {
                //send error message to signup page
                header("location: ../pages/signup.php?signupRes=1");
                exit;
            }
    
        }
            
    
        $data->setFirstname($_POST['fnameTb']);
        $data->setLastname($_POST['lnameTb']);
        $data->setPassword($_POST['passwordTb']);
        $data->setEmail($_POST['emailTb']);

        //if the program is occur in this area it means that the username is unique and successfully created
        CreateUserAccount($conn,$data);
        header("location: ../login.php?signupRes=2");
        exit;



    }
    else
    {
        header("location: ../pages/signup.php");
    }

?>