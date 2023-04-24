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

    
    
   
    //posting starts here

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        if(isset($_POST['first_name'])){

            $settings_class = new Settings();
            $settings_class->save_settings($_POST, $_SESSION['friendlance_userid']);

        }else{

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

        <?php

        $image = "images/cover.jpeg";
        if(file_exists($user_data['cover_image']))
        {
            $image = $image_class->get_thumbnail_cover($user_data['cover_image']);
        }

        ?>

        <img src="<?php echo $image ?>" style="width: 100%;">

       

        <div id="pro-pic-bg">

                <span style="font-size: 12px; text-align:center;">

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

                    <br>
                        <div id="profile-name" >
                            <a href="profile.php?id=<?php echo $user_data['userid']?>">
                            <?php echo $user_data['first_name'] . " " . $user_data['last_name'];?>
                            </a>
                        </div>
                    <br>

                    <?php

                        $likes = "";
                        if($user_data['likes'] > 0){

                            $likes = "(" . $user_data['likes'] . " Friends)";

                        }


                    ?>

                    <br>
                    <a href="like.php?type=user&id=<?php echo $user_data['userid'] ?>">
                        <input id="post_button" type="button" value="Wanna be Friends? <?php echo $likes ?>" style= "margin-left:30px;background-color:black;color:yellow;min-width:50px;cursor:pointer;">
                    </a>
                    
                    <a href="index.php"><div id="menu-buttons">Timeline</div></a>
                    <a href="profile.php?section=about&id=<?php echo $user_data['userid']?>"><div id="menu-buttons">About</div></a>
                    <a href="profile.php?section=followers&id=<?php echo $user_data['userid']?>"><div id="menu-buttons">Followers</div></a>
                    <a href="profile.php?section=following&id=<?php echo $user_data['userid']?>"><div id="menu-buttons">Following</div></a>
                    <a href="profile.php?section=photos&id=<?php echo $user_data['userid']?>"><div id="menu-buttons">Photos</div></a>
                    
                    <?php
                        if($user_data['userid'] == $_SESSION['friendlance_userid']){

                            echo '<a href="profile.php?section=settings&id='. $user_data['userid'] ,'"><div id="menu-buttons">Settings</div></a>';

                        }
                    ?>

                </span>
                

                   
               
                
            </div>
        
        <!--below cover area-->

        <?php

            $section = "default";
            if(isset($_GET['section'])){

                $section = $_GET['section'];

            }

            if($section == "default"){

                include("profile_content_default.php");

            }elseif($section == "followers"){


                include("profile_content_followers.php");

            }elseif($section == "following"){


                include("profile_content_following.php");

            }elseif($section == "about"){


                include("profile_content_about.php");

            }elseif($section == "settings"){


                include("profile_content_settings.php");

            }elseif($section == "photos"){


                include("profile_content_photos.php");

            }

        ?>
        

    </div>

</body>
</html>