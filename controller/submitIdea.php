<?php
    include_once '../db/connection.php';
    include_once '../db/tb_ideas.php';
    include_once '../model/ideasModel.php';


    if(isset($_POST['submitIdea']))
    {
        $idea = new ideasModel();
        if(isset($_POST['ideaId']))
        {
            //to update the current idea data
            $idea->setId($_POST['ideaId']);
            $idea->setIdea($_POST['ideaTb']);
            UpdateIdea($conn,$idea);
            header("location: ../pages/repodashboard.php?id=".$_POST['repoId']);
        }
        else
        {
            //to create new idea data
            $idea->setUserAccountId($_POST['userId']);
            $idea->setRepositoryId($_POST['repoId']);
            $idea->setIdea($_POST['ideaTb']);
            CreateIdea($conn,$idea);
            header("location: ../pages/repodashboard.php?id=".$_POST['repoId']);
        }

    }
    else
    {
        header("location: ../login.php");
    }


?>