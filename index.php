<?php

    session_start();
    
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");


    $login = new Login();
    $user_data = $login->check_login($_SESSION['friendlance_userid']);

    $post = new Post();
    $id = $_SESSION['friendlance_userid'];

    $posts = $post->get_posts($id);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet"/>
    <title>Timeline | FRIENDLANCE🤞</title>
</head>

<body>
    
    <br>
    
    <?php include("header.php"); ?>


    <!--profile cover page-->
    <div id="profile-cover">

        

        <!--below cover area-->

        <div id="profile-display">

            <!--friends area-->
            <div id="pro-dis1"></div>

                <div id="friends-bar">

                    <img id="pro-pic" src="images/friends.PNG"><br>
                    <a href="profile.php" style="text-decoration: none;"><div id="profile-name" ><?php echo $user_data['first_name'] . "<br> " . $user_data['last_name'];?></div></a>

                </div>
            

            <!--posts area-->
            <div id="pro-dis2">

                <div id="posts-area">
                    <textarea placeholder="Write Your Thoughts"></textarea>
                    <input id="post-button" type="submit" value="SHARE THOUGHTS">
                    <br>
                </div>


            <!--posts-->
            <div id="post-bar">

                
            <?php

            
                if($posts)
                {
                    foreach($posts as $ROW)
                    {
                        $user = new User();
                        $ROW_USER = $user->get_user($ROW['userid']);

                        include('post.php');
                    }
                }   


            ?>

                 

                 

            </div>

        </div>
        

    </div>

</body>
</html>