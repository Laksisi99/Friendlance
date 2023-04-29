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

        $post = new Post();
        $id = $_SESSION['friendlance_userid'];
        $result = $post->create_post($id, $_POST,$_FILES);
        
        if($result == "")
        {
            header("Location: index.php");
            die;
        }else
        {
            echo "<div style='text-align:center;font: size 12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo $result;
            echo "</div>";
        }

    }

    
        


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

                    
                    
                    

                </span>
                

                   
               
                
            </div>
        
        <!--below cover area-->

        <div id="profile-display">

            <!--friends area-->
            <div id="pro-dis1"></div>

                
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

                        $DB = new Database();
                        $user_class = new User();
                        $image_class = new Image();
                        

                        $followers = $user_class->get_following($_SESSION['friendlance_userid'],"user");

                        $follower_ids = false;
                        if(is_array($followers)){

                            $follower_ids = array_column($followers, "userid");
                            $follower_ids = implode("','" , $follower_ids);

                        }

                        if($follower_ids){

                            $myuserid = $_SESSION['friendlance_userid'];
                            $sql = "select * from posts where parent = 0 and userid = '$myuserid' || userid in('" .$follower_ids. "') order by id desc limit 30";
                            $posts = $DB->read($sql);

                        }
            
                        if(isset($posts) && $posts)
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