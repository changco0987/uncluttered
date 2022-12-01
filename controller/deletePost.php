<?php
    include_once '../db/connection.php';
    include_once '../db/tb_updates.php';
    include_once '../db/tb_updates.php';



    if(isset($_POST['postId']))
    {
        $data = new updatesModel();
        $data->setId($_POST['postId']);

        DeleteUpdate($conn,$data);
        echo 'deleted';
        //header("Location: ../pages/repodashboard.php");
        exit;

    }
    else
    {
        header("Location: ../controller/wipedata.php");
    }


?>