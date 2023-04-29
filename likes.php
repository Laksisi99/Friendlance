<?php
    
    include("classes/autoload.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['friendlance_userid']);

    $USER = $user_data;

    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        $profile = new Profile();
        $profile_data = $profile->get_profile($_GET['id']);
    
        if(is_array($profile_data))
        {
            $user_data = $profile_data[0];
        }
    }


    $Post = new Post();

    $likes = false;

    $ERROR = "";
    if(isset($_GET['id']) && isset($_GET['type'])){

        $likes = $Post -> get_likes($_GET['id'],$_GET['type']); 

    }else{

        $ERROR = "Sorry! No infomation was found!!!";

    }
    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet"/>
    <title>Friends who liked | FRIENDLANCE🤞</title>
</head>

<body>
    
    <br>
    
    <?php include("header.php"); ?>


    <!--profile cover page-->
    <div id="profile-cover">

        

        

               
            

            <!--posts area-->
            <div id="pro-dis2">

                <div id="posts-area">

                <?php

                    $User = new User();
                    $image_class = new Image();


                    if(is_array($likes)){
                        foreach($likes as $row){

                           $FRIEND_ROW = $User->get_user($row['userid']);
                           include("user.php");

                        }
                    }

                ?>
                    
                <br style="clear:both;">
                    
                </div>


            

            </div>
        

    </div>

</body>
</html>