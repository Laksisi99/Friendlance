<?php

session_start();

if(isset($_SESSION['friendlance_userid']))
{

    $_SESSION['friendlance_userid'] = NULL;
    unset($_SESSION['friendlance_userid']);

}


header("Location: login.php");
die;