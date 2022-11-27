<?php
    include_once '../model/repositoryModel.php';

    $data = new repositoryModel;
    function CreateRepo($conn,$data)
    {
        mysqli_query($conn, "INSERT INTO repositorytb(repositoryName, members, userAccountId) values('".$data->getRepositoryName()."','".$data->getMembers()
        ."','".$data->getUserAccountId()."');");
        $id = mysqli_insert_id($conn);
        return $id;
    }

    

    function ReadRepo($conn,$data)
    {
        
        if($data->getId())
        {
            //if theres id in data
            $dbData = mysqli_query($conn, "SELECT * FROM repositorytb WHERE id ='".$data->getId()."'");
        }
        else
        {
            $dbData = mysqli_query($conn, "SELECT * FROM repositorytb");
        }
        return $dbData;
    }

    

    function UpdateRepo($conn,$data)
    {
        if($data->getMembers())
        {
            mysqli_query($conn,"UPDATE repositorytb SET repositoryName = '".$data->getRepositoryName()."', members ='". $data->getMembers()."' WHERE id =". $data->getId());
        }
    }

    

    function DeleteRepo($conn,$data)
    {
        mysqli_query($conn,"DELETE FROM repositorytb WHERE id = $data->getId()");
    }

?>