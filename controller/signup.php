<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';


    if(isset($_POST['submitBtn']))
    {
        $data = new userAccountModel();
        $result = ReadUserAccount($conn,$data);
        $data->setUsername($_POST['usernameTb']);

        while($row = mysqli_fetch_assoc($result))
        {

            //this will check if the inputted username is existed
            if($row['username']==$data->getUsername())
            {
                header("location: ../pages/signup.php?signupRes=1");
            }

        }

        $data->setFirstname($_POST['fnameTb']);
        $data->setLastname($_POST['lnameTb']);
        $data->setPassword($_POST['passwordTb']);
        $data->setEmail($_POST['emailTb']);
        //if the program is occur in this area it means that the username is unique
        CreateUserAccount($conn,$data);

        header("location: ../index.php?signupRes=2");

    }
    else
    {
        header("location: ../pages/signup.php");
    }

?>