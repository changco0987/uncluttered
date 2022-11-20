<?php
    include_once '../db/connection.php';
    include_once '../db/tb_useraccounts.php';
    include_once '../model/userAccountModel.php';

    $search = $_GET['search'];

    $data = new userAccountModel();
    $result = ReadUserAccount($conn,$data);

    $findings = "";
    $count = 1;
    while($row = mysqli_fetch_assoc($result))
    {
        if(strtolower($row['firstname']) == strtolower($search) ||
        str_contains(strtolower($row['firstname']),strtolower($search)))
        {
            
            if($row['imageName']!==null && $row['imageName']!=='')
            {
                $findings = $findings. "<tr>".
                                            "<td>".$count."</td>".
                                            "<td><img src='../asset/".$row['imageName']."' width='60' height='60' class='d-inline-block align-top img-fluid border border-dark' alt='' style='border-radius: 50%;'></td>".
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                        "</tr>";
            }
            else
            {
                
                $findings = $findings. "<tr>".
                                            "<td>".$count."</td>".
                                            "<td><img src='../asset/user.png' width='60' height='60' class='d-inline-block align-top img-fluid border border-dark' alt='' style='border-radius: 50%;'></td>".
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                        "</tr>";

            }
            $count++;
        }
        else if(strtolower($row['lastname']) == strtolower($search) ||
        str_contains(strtolower($row['lastname']),strtolower($search)))
        {
            
            if($row['imageName']!==null && $row['imageName']!=='')
            {
                $findings = $findings. "<tr>".
                                            "<td>".$count."</td>".
                                            "<td><img src='../asset/".$row['imageName']."' width='60' height='60' class='d-inline-block align-top img-fluid border border-dark' alt='' style='border-radius: 50%;'></td>".
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                        "</tr>";
            }
            else
            {
                
                $findings = $findings. "<tr>".
                                            "<td>".$count."</td>".
                                            "<td><img src='../asset/user.png' width='60' height='60' class='d-inline-block align-top img-fluid border border-dark' alt='' style='border-radius: 50%;'></td>".
                                            "<td>".$row['firstname'].' '.$row['lastname']."</td>".
                                        "</tr>";

            }
            $count++;
        }
    }

    $response = $findings;
    echo $response;
?>