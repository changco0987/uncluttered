<?php
    include_once '../db/connection.php';
    include_once '../db/tb_updates.php';
    include_once '../model/updatesModel.php';

    if(isset($_POST['submitPost']))
    {

            
        $imgPath = '../upload/repoId'.$_POST['repoId'].'/';
        $tempFilename = '';

        $data = new updatesModel();
        $data->setUserAccountId($_POST['userId']);
        $data->setRepositoryId($_POST['repoId']);
        $data->setTitle($_POST['titleTb']);
        $data->setNote($_POST['noteTb']);
        $data->setDatetimeCreation();

        
        if(isset($_FILES['fileTb']['name'])!="")
        {
            $fileExtension = pathinfo($_FILES['fileTb']['name'],PATHINFO_EXTENSION);
            if(strlen($_FILES['fileTb']['name']) <= 490)
            {
                $data->setFilename($_FILES['fileTb']['name']);
            }
            else
            {
                $data->setFilename(substr($_FILES['fileTb']['name'], 0, 490). "." .$fileExtension);
            }

        
            $uploadedFile = $_FILES['fileTb']['tmp_name'];
            //This will check if the folder is already existed
            if (!file_exists($imgPath))
            {
                mkdir($imgPath, 0755, true);
            }
            copy($uploadedFile,$imgPath.$data->getFilename());//This will move the uploaded file into file directory (web)
            
        }

        //This will check if the user is log in using their email
        if(isset($_POST['gmail_Id']))
        {
            echo 'pumasok';
            $data->setFilename($_POST['fileTb']);
            $data->setFileId($_POST['postId']);
        }

        CreateUpdate($conn,$data);

        //header("Location: ../pages/repodashboard.php?id=".$_POST['repoId']."&updateRes=1");


        
    }

?>