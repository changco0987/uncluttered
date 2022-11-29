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
        $repo->setId($_POST['repoId']);
        $repo->setRepositoryName($_POST['repoNameTb']);
        $repo->setMembers($str);

        UpdateRepo($conn,$repo);

        header("location: ../pages/repodashboard.php?id=".$_POST['repoId']."&updateRes=2");//bind repoId $_GET



        //echo $str;
        //$arr = unserialize($str);//This will be used to decrypt and back to the array type
        //print_r($members);
    }

?>