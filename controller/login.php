<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';


    if(isset($_POST['submitLogin']))
    {
        $data = new userAccountModel();
        $data->setUsername($_POST['usernameTb']);
        $data->setPassword($_POST['passwordTb']);

        $result = ReadUserAccount($conn,$data);

        $row = mysqli_fetch_assoc($result);
   
        if(isset($row['password']) == $data->getPassword())
        {
            echo '1';
        }
        else
        {
            echo '2';
        }

        

    }


?>