<?php

    date_default_timezone_set('Asia/Manila'); 
    session_start();


    
    $helper = array_keys($_SESSION);
    foreach ($helper as $key)
    {
        unset($_SESSION[$key]);
    } 
    session_unset();
    header('Location: ../login.php');
?>