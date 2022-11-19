<?php
    include_once '../model/userAccountModel.php';

    $data = new userAccountModel();
    function CreateUserAccount($conn,$data)
    {
        $username = mysqli_real_escape_string($conn,$data->getUsername());
        //$address = mysqli_real_escape_string($conn,$data->getAddress());
        $email = mysqli_real_escape_string($conn,$data->getEmail());
        mysqli_query($conn, "INSERT INTO useraccountstb(firstname,lastname,username,password,email) values('".$data->getFirstname()."','".$data->getLastname()
        ."','".$username."','".$data->getPassword()."','".$email."');");
        $id = mysqli_insert_id($conn);
        return $id;
    }

    

    function ReadUserAccount($conn,$data)
    {

        if($data->getUsername())
        {//if theres username in data
            $dbData = mysqli_query($conn, "SELECT * FROM useraccountstb WHERE username='".$data->getUsername());
        }
        else
        {
            $dbData = mysqli_query($conn, "SELECT * FROM useraccountstb");
        }
        return $dbData;
    }

    

    function UpdateUserAccount($conn,$data)
    {
        mysqli_query($conn,"UPDATE useraccountstb SET username = $data->getUsername() WHERE id = $data->getId()");
    }

    

    function DeleteUserAccount($conn,$data)
    {
        mysqli_query($conn,"DELETE FROM useraccountstb WHERE id = $data->getId()");
    }

?>