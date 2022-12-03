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

    
    function CreateGmailUser($conn,$data)
    {
        $username = mysqli_real_escape_string($conn,$data->getUsername());
        $imageName = mysqli_real_escape_string($conn,$data->getImageName());
        $email = mysqli_real_escape_string($conn,$data->getEmail());

        mysqli_query($conn, "INSERT INTO useraccountstb(firstname,lastname,username,password,email,imageName,gmail_Id) values('".$data->getFirstname()."','".$data->getLastname()
        ."','".$username."','".$data->getPassword()."','".$email."','".$imageName."','".$data->getGmail_Id()."');");
        $id = mysqli_insert_id($conn);
        return $id;
    }

    

    function ReadUserAccount($conn,$data)
    {
        if($data->getUsername())
        {
            $username = mysqli_real_escape_string($conn,$data->getUsername());
            //if theres username in data
            $dbData = mysqli_query($conn, "SELECT * FROM useraccountstb WHERE username='".$username."'");
        }
        else if($data->getId())
        {
            //this is used in repodashboard to fetch usernames in updates
            $dbData = mysqli_query($conn, "SELECT * FROM useraccountstb WHERE id=".$data->getId());
        }
        else
        {
            $dbData = mysqli_query($conn, "SELECT * FROM useraccountstb");
        }
        return $dbData;
    }

    
    function ReadGmailUser($conn,$data)
    {

        if($data->getGmail_Id())
        {
            //if theres username in data
            $dbData = mysqli_query($conn, "SELECT * FROM useraccountstb WHERE gmail_Id='".$data->getGmail_Id()."'");
        }
        return $dbData;
    }

    

    function UpdateUserAccount($conn,$data)
    {
        if($data->getId()!=null)
        {
            if($data->getPassword()!=null)
            {
                mysqli_query($conn,"UPDATE useraccountstb SET firstname='".$data->getFirstname()."', lastname='".$data->getLastname()
                ."',username = '".$data->getUsername()."', password ='".$data->getPassword()."', imageName ='".$data->getImageName()
                ."', email='".$data->getEmail()."' WHERE id =". $data->getId());
            }
            else
            {
                mysqli_query($conn,"UPDATE useraccountstb SET firstname='".$data->getFirstname()."', lastname='".$data->getLastname()
                ."',username = '".$data->getUsername()."', imageName ='".$data->getImageName()
                ."', email='".$data->getEmail()."' WHERE id =". $data->getId());
            }
        }
    }

    

    function DeleteUserAccount($conn,$data)
    {
        mysqli_query($conn,"DELETE FROM useraccountstb WHERE id = $data->getId()");
    }

?>