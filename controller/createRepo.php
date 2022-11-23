<?php
    include_once '../db/connection.php';
    include_once '../db/tb_repository.php';
    include_once '../model/repositoryModel.php';


    if(isset($_POST['submitRepo']))
    {
        $members = array();
        $members = json_decode($_POST['memberTb']);
        $str = serialize($members);
        echo $str;
        //$arr = unserialize($str);
        print_r($members);
    }

?>