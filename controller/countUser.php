<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';


    $data = new userAccountModel();

    $result = ReadUserAccount($conn,$data);


    while($row = mysqli_fetch_assoc($result))
    {
        echo $row['username'];
    }

?>