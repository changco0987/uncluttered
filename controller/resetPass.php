
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
            //this will check if the inputted code is correct
            if($row['resetCode'] == $_POST['resetCodeTb'])
            {
                
                $data->setPassword($_POST['passwordTb']);
                UpdateUserAccount($conn,$data);//This will input the new password
                
                header("location: ../login.php");
            }
            else
            {
                //This will trigger if the user inputted incorrect reset code
                header("location: ../pages/reset.php?resetRes=1&username=".$_POST['usernameTb']);
            }
    
        }
            
        exit;



    }
    else
    {
        header("location: ../pages/findAccount.php");
    }

?>