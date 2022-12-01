<?php
    include_once '../db/connection.php';
    include_once '../db/tb_version.php';
    include_once '../model/versionModel.php';

    if(isset($_POST['submitPost']))
    {

            
        $imgPath = '../upload/repoId'.$_POST['repoId'].'/version/';
        $tempFilename = '';
        $fileExtension = pathinfo($_FILES['fileTb']['name'],PATHINFO_EXTENSION);

        $data = new versionModel();
        $data->setUpdateId($_POST['updateId']);
        $data->setUserAccountId($_POST['userId']);
        $data->setNote($_POST['noteTb']);
        $data->setDatetimeCreation();

        
        if($_FILES['fileTb']['name']!="")
        {
            if(strlen($_FILES['fileTb']['name']) <= 490)
            {
                $data->setFilename($_FILES['fileTb']['name']);
            }
            else
            {
                $data->setFilename(substr($_FILES['fileTb']['name'],0,490). "." .$fileExtension);
            }

            $uploadedFile = $_FILES['fileTb']['tmp_name'];
            
            //This will check if the folder is already existed
            if (!file_exists($imgPath))
             {
                mkdir($imgPath, 0755, true);
            }
            copy($uploadedFile,$imgPath.$data->getFilename());//This will move the uploaded file into file directory (web)
        }

        CreateVersion($conn,$data);

        header("Location: ../pages/repodashboard.php?id=".$_POST['repoId']."&updateRes=3");


        
    }

?>