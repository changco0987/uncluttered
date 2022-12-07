<?php
    include_once '../model/ideasModel.php';

    $data = new ideasModel;
    function CreateIdea($conn,$data)
    {
        $idea = mysqli_real_escape_string($conn,$data->getIdea());
        mysqli_query($conn, "INSERT INTO ideastb(userAccountId, repositoryId, idea) values(".$data->getUserAccountId().",".$data->getRepositoryId()
        .",'".$idea."');");
        $id = mysqli_insert_id($conn);
        return $id;
    }

    

    function ReadIdea($conn,$data)
    {
        
        if($data->getRepositoryId())
        {
            //if theres id in data
            $dbData = mysqli_query($conn, "SELECT * FROM ideastb WHERE userAccountId =".$data->getUserAccountId()." AND repositoryId =".$data->getRepositoryId());
        }
        /*
        else
        {
            $dbData = mysqli_query($conn, "SELECT * FROM ideastb ORDER BY id DESC");
        }
        */
        return $dbData;
    }

    

    function UpdateIdea($conn,$data)
    {
        if($data->getId())
        {
            $idea = mysqli_real_escape_string($conn,$data->getIdea());
            mysqli_query($conn,"UPDATE ideastb SET idea = '".$idea."'  WHERE id =". $data->getId());
        }
    }

    

    function DeleteIdea($conn,$data)
    {
        mysqli_query($conn,"DELETE FROM ideastb WHERE id = $data->getId()");
    }

?>