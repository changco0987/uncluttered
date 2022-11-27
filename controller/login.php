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
            if(isset($row['password']) == $data->getPassword())
            {
                $_SESSION['username'] = $row['username'];
                header("location: ../pages/userdashboard.php");
                exit;
            }
        }
            //show a error message
            header("location: ../index.php?loginRes=1");
            exit;
        

        

    }


?>