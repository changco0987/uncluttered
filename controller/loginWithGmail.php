<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';


    session_start();
    if(isset($_POST['submitLogin']))
    {
        $data = new userAccountModel();
        $data->setUsername($_POST['usernameTb']);
        $data->setPassword($_POST['passwordTb']);

        $result = ReadUserAccount($conn,$data);

        while($row = mysqli_fetch_assoc($result))
        {
            if($row['password'] == $data->getPassword())
            {
                $_SESSION['gmail_Id'] = $row['gmail_Id'];
                $_SESSION['username'] = $row['username'];
                echo '3';
                //header("location: ../pages/userdashboard.php");
                exit;
            }
            else
            {
                //show a error message - incorrect password
                echo '1';
                exit;
            }
        }

        //show a error message - username doesn't exist
        echo '2';
        exit;
        

    }
    else
    {
        header("location: ../login.php");
        exit;
    }


?>