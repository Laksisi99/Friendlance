<?php
    
    include("classes/autoload.php");


    $login = new Login();
    $user_data = $login->check_login($_SESSION['friendlance_userid']);

    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        $profile = new Profile();
        $profile_data = $profile->get_profile($_GET['id']);
    
        if(is_array($profile_data))
        {
            $user_data = $profile_data[0];
        }
    }

    
    
   
    //posting starts here

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        $post = new Post();
        $id = $_SESSION['friendlance_userid'];
        $result = $post->create_post($id, $_POST,$_FILES);
        
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
    $id = $user_data['userid'];

    $posts = $post->get_posts($id);

    //collect friends

    $user = new User();

    $friends = $user->get_friends($id);

    $image_class = new Image();
        


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

                <?php

                    $image = "images/cover.jpeg";
                    if(file_exists($user_data['cover_image']))
                    {
                        $image = $image_class->get_thumbnail_cover($user_data['cover_image']);
                    }

                ?>

            <img src="<?php echo $image ?>" style="width: 100%;">

            <span style="font-size: 12px;">

                <?php

                    $image = "images/user_male.png";

                    if($user_data['gender'] == "Female")
                    {
                        $image = "images/user_female.png";
                    }

                    if(file_exists($user_data['profile_image']))
                    {
                        $image = $image_class->get_thumbnail_profile($user_data['profile_image']);
                    }

                ?>
                <img id="pro-pic" src="<?php echo $image ?>"><br/>

                <a style="text-decoration: none; color:aqua;" href="change_profile_image.php?change=profile_picture" >Change Profile Image </a> |
                <a style="text-decoration: none; color:aqua;" href="change_profile_image.php?change=profile_cover" >Change Cover </a>

            </span>

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
                    <form method="post" enctype="multipart/form-data">
                        <textarea name="post" placeholder="Write Your Thoughts"></textarea>
                        <input type="file" name="file">
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