<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';


            
    $imgPath = '../upload/userImage/';
    $tempFilename = '';
    $fileExtension = pathinfo($_FILES['imgTb']['name'],PATHINFO_EXTENSION);
    session_start();
    if(isset($_POST['submitBtn']))
    {
        $data = new userAccountModel();
        $data->setUsername($_POST['usernameTb']);

        //this will filter if the username is unchanged
        if($_SESSION['username'] != $_POST['usernameTb'])
        {
        
            $result = ReadUserAccount($conn,$data);
            while($row = mysqli_fetch_assoc($result))
            {
                //this will check if the inputted username is existed
                if($row['username'] == $data->getUsername())
                {
                    //send error message to userdashboard
                    header("location: ../pages/userdashboard.php?editAccRes=1");
                    exit;
                }
        
            }
        }
            
    
        $data->setId($_POST['idTb']);
        $data->setFirstname($_POST['fnameTb']);
        $data->setLastname($_POST['lnameTb']);

        if($_POST['passwordTb']!=null)
        {
            $data->setPassword($_POST['passwordTb']);
        }

        if($_FILES['imgTb']['name'] != "" && $_FILES['imgTb']['size'] != 0)
        {
            $data->setImageName('user'.$_POST['idTb']. "." .$fileExtension);

            $uploadedFile = $_FILES['imgTb']['tmp_name'];
            
            //This will check if the folder is already existed
            if (!file_exists($imgPath))
             {
                mkdir($imgPath, 0755, true);
            }
            copy($uploadedFile,$imgPath.$data->getImageName());//This will move the uploaded file into file directory (web)
        }
        else
        {
            $data->setImageName($_POST['imageNameTb']);
        }

        $data->setEmail($_POST['emailTb']);

        //if the program is occur in this area it means that the username is unique and successfully created
        UpdateUserAccount($conn,$data);
        header("location: ../pages/userdashboard.php?editAccRes=2");
        exit;


    }
    else
    {
        header("location: ../index.php");
    }

?>