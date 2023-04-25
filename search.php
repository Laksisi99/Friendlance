<?php
    
    include("classes/autoload.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['friendlance_userid']);

    if(isset($_GET['find'])){

        $find = addslashes(($_GET['find']));

        $sql = "select * from users where first_name like '%$find%' || last_name like '%$find%' limit 10";

        $DB = new Database();

        $results = $DB->read($sql);
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


                    if(is_array($results)){
                        foreach($results as $row){

                           $FRIEND_ROW = $User->get_user($row['userid']);
                           include("user.php");

                        }
                    }else{

                        echo "No friends were found";

                    }

                ?>
                    
                <br style="clear:both;">
                    
                </div>


            

            </div>
        

    </div>

</body>
</html>