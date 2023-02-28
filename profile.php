<?php

    session_start();
    
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");


    $login = new Login();
    $user_data = $login->check_login($_SESSION['friendlance_userid']);

    //posting starts here

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        $post = new Post();
        $id = $_SESSION['friendlance_userid'];
        $result = $post->create_post($id, $_POST);
        
        if($result == "")
        {
            header("Location: profile.php");
            die;
        }else
        {
            echo "<div style='text-align:center;font: size 12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo $result;
            echo "</div>";
        }

    }

    //collect posts

    $post = new Post();
    $id = $_SESSION['friendlance_userid'];

    $posts = $post->get_posts($id);

    //collect friends

    $user = new User();
    $id = $_SESSION['friendlance_userid'];

    $friends = $user->get_friends($id);
        


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet"/>
    <title>Profile | FRIENDLANCE🤞</title>
</head>

<body>
    
    <br>
    
    <?php include("header.php"); ?>

    <!--profile cover page-->
    <div id="profile-cover">

        <div id="pro-pic-bg">

            <img src="images/profile.PNG" style="width: 100%;">
            <img id="pro-pic" src="images/friends.PNG">
            <br>
                <div id="profile-name"><?php echo $user_data['first_name'] . " " . $user_data['last_name'];?></div>
            <br>
            <a href="index.php"><div id="menu-buttons">Timeline</div></a>
            <div id="menu-buttons">About</div>
            <div id="menu-buttons">Friends</div>
            <div id="menu-buttons">Photos</div>
            <div id="menu-buttons">Settings</div>
                
        </div>

        <!--below cover area-->

        <div id="profile-display">

            <!--friends area-->
            <div id="pro-dis1"></div>

                <div id="friends-bar">

                    Friends <br>

                    <?php

            
                        if($friends)
                        {
                            foreach($friends as $FRIEND_ROW)
                            {
                                
                                include('user.php');
                            }
                        }   


                    ?>

                    

                </div>
            

            <!--posts area-->
            <div id="pro-dis2">

                <div id="posts-area">
                    <form method="post">
                        <textarea name="post" placeholder="Write Your Thoughts"></textarea>
                        <input id="post-button" type="submit" value="SHARE THOUGHTS">
                        <br>
                    </form>
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
        

    </div>

</body>
</html>