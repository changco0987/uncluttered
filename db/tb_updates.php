<?php
    include_once '../model/updatesModel.php';

    $data = new updatesModel;
    function CreateUpdate($conn,$data)
    {
        mysqli_query($conn, "INSERT INTO updatestb(title, filename, note, datetimeCreation, userAccountId, repositoryId) values('".$data->getTitle()."','".$data->getFilename()
        ."','".$data->getNote()."','".$data->getDatetimeCreation()."','".$data->getUserAccountId()."','".$data->getRepositoryId()."');");
        $id = mysqli_insert_id($conn);
        return $id;
    }

    

    function ReadUpdate($conn,$data)
    {
        
        if($data->getRepositoryId() && $data->getUserAccountId()==null)
        {
            //if theres id in data
            $dbData = mysqli_query($conn, "SELECT * FROM updatestb WHERE repositoryId ='".$data->getRepositoryId()."' ORDER BY id DESC");
        }
        else if($data->getUserAccountId())
        {
            //if theres id of user in data
            if($data->getRepositoryId())
            {
                $dbData = mysqli_query($conn, "SELECT * FROM updatestb WHERE userAccountId =".$data->getUserAccountId()." AND repositoryId =".$data->getRepositoryId()." ORDER BY id DESC");
            }
            else
            {
                $dbData = mysqli_query($conn, "SELECT * FROM updatestb WHERE userAccountId =".$data->getUserAccountId()." ORDER BY id DESC");
            }
        }
        else
        {
            $dbData = mysqli_query($conn, "SELECT * FROM updatestb");
        }
        return $dbData;
    }

    

    function UpdateUpdate($conn,$data)
    {
        if($data->getId())
        {
            if($data->getFilename())
            {
                mysqli_query($conn,"UPDATE updatestb SET title = '".$data->getTitle()."', filename = '".$data->getFilename()."', note = '".$data->getNote()
                ."', datetimeCreation = '".$data->getDatetimeCreation()."' WHERE id = ".$data->getId());
            }
            else
            {
                //is theres no file passed in getFilename()
                mysqli_query($conn,"UPDATE updatestb SET title = '".$data->getTitle()."', note = '".$data->getNote()
                ."', datetimeCreation = '".$data->getDatetimeCreation()."' WHERE id = ".$data->getId());
            }
        }
    }

    

    function DeleteUpdate($conn,$data)
    {
        mysqli_query($conn,"DELETE FROM updatestb WHERE id = ".$data->getId());
        $_GET['deleteRes'] = 1;
    }

?>