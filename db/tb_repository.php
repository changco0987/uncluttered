<?php
    include_once '../model/repositoryModel.php';

    $data = new repositoryModel;
    function CreateRepo($conn,$data)
    {
        mysqli_query($conn, "INSERT INTO repositorytb(repositoryName, members, userAccountId, folderId) values('".$data->getRepositoryName()."','".$data->getMembers()
        ."','".$data->getUserAccountId()."','".$data->getFolderId()."');");
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
            $dbData = mysqli_query($conn, "SELECT * FROM repositorytb ORDER BY id DESC");
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