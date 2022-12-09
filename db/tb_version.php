<?php
    include_once '../model/versionModel.php';

    $data = new versionModel;
    function CreateVersion($conn,$data)
    {
        $note = mysqli_real_escape_string($conn,$data->getNote());
        mysqli_query($conn, "INSERT INTO versiontb(updateId, userAccountId, datetimeCreation, note, filename) values('".$data->getUpdateId()."','".
        $data->getUserAccountId()."','".$data->getDatetimeCreation()."','".$note."','".$data->getFilename()."');");
        $id = mysqli_insert_id($conn);
        return $id;
    }

    

    function ReadVersion($conn,$data)
    {
        
        if($data->getUpdateId())
        {
            //if theres id in data
            $dbData = mysqli_query($conn, "SELECT * FROM versiontb WHERE updateId =".$data->getUpdateId());
        }
        else
        {
            $dbData = mysqli_query($conn, "SELECT * FROM versiontb");
        }
        return $dbData;
    }

    

    function UpdateVersion($conn,$data)
    {
        mysqli_query($conn,"UPDATE versiontb SET title = '".$data->getTitle()."', filename = '".$data->getFilename()."', note = '".$data->getNote()
        ."' WHERE id = ".$data->getId());
    }

    

    function DeleteVersion($conn,$data)
    {
        mysqli_query($conn,"DELETE FROM versiontb WHERE id = $data->getId()");
    }

?>