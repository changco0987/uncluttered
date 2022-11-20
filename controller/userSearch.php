<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';

    $search = $_GET['search'];

    $data = new userAccountModel();
    $result = ReadUserAccount($conn,$data);

    $findings = "";
    while($row = mysqli_fetch_assoc($result))
    {
        if(strtolower($row['firstname']) == strtolower($search) ||
        str_contains(strtolower($row['firstname']),strtolower($search)))
        {
            $findings = $findings. "<a href='#' class='list-group-item list-group-item-action d-flex justify-content-between'>".$row['firstname']."</a>";
        }
    }
    $response = $findings;
    echo $response;
?>