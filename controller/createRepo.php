<?php
    include_once '../db/connection.php';
    include_once '../db/tb_repository.php';
    include_once '../model/repositoryModel.php';


    if(isset($_POST['submitRepo']))
    {
        $members = array();
        $members = json_decode($_POST['memberTb']);
        
        $str = serialize($members); //To encrypt the data to string format

        $repo = new repositoryModel();
        $repo->setRepositoryName($_POST['repoNameTb']);
        $repo->setMembers($str);
        $repo->setUserAccountId($_POST['creatorId']);

        if(isset($_POST['gmail_Id']))
        {
            $repo->setFolderId($_POST['folderId']);
        }
        CreateRepo($conn,$repo);

        header("location: ../pages/userdashboard.php");



        //echo $str;
        //$arr = unserialize($str);//This will be used to decrypt and back to the array type
        //print_r($members);
    }
    else
    {
        
        header("location: ../index.php");
    }

?>