<?php session_start(); ?>
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
                $code = rand(11111111, 99999999);
                $_SESSION['email'] = $row['email'];
                $_SESSION['code'] = $code;
                
                $data->setResetCode($code);
                UpdateUserAccount($conn,$data);

                header("Location: ../pages/reset.php?username=".$row['username']);
                //echo "<script>window.location = '../pages/reset.php?username=".$row['username'].";</script>";
                exit;
            }
    
        }
            

        //if the program is occur in this area it means that the username is unique and successfully created
        //CreateUserAccount($conn,$data);
        header("location: ../pages/findAccount.php?response=1");
        exit;



    }
    else
    {
        header("location: ../pages/signup.php");
    }

?>