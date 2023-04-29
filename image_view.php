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

    $ROW = false;

    $ERROR = "";
    if(isset($_GET['id'])){

    

        $ROW = $Post->get_single_post($_GET['id']); 

    }else{

        $ERROR = "Sorry! No Image was found!!!";

    }
    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet"/>
    <title>Single Thought | FRIENDLANCE🤞</title>
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

                    $user = new User();
                    $image_class = new Image();

                 
                    if(is_array($ROW)){

                       echo "<img src='$ROW[image]' style='width:100%;' />";

                    }

                ?>
                    
                <br style="clear:both;">
                    
                </div>


            

            </div>
        

    </div>

</body>
</html>