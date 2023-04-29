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

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
            $post = new Post();
            $id = $_SESSION['friendlance_userid'];
            $result = $post->create_post($id, $_POST,$_FILES);
            
            if($result == "")
            {
                header("Location: single_post.php?id=$_GET[id]");
                die;
            }else
            {
                echo "<div style='text-align:center;font: size 12px;color:white;background-color:grey;'>";
                echo "<br>The following errors occured:<br><br>";
                echo $result;
                echo "</div>";
            }
            

    }


    $Post = new Post();

    $ROW = false;

    $ERROR = "";
    if(isset($_GET['id'])){

    

        $ROW = $Post -> get_single_post($_GET['id']); 

    }else{

        $ERROR = "Sorry! No thought was found!!!";

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

                        $ROW_USER = $user->get_user($ROW['userid']);

                        include("post.php");

                    }

                ?>
                    
                <br style="clear:both;">

                <div id="posts-area">
                    <form method="post" enctype="multipart/form-data">
                        <textarea name="post" placeholder="Write Your Thoughts About this Thought"></textarea>
                        <input type="hidden" name="parent" value="<?php echo $ROW['postid'] ?>">
                        <input type="file" name="file">
                        <input id="post-button" type="submit" value="POST YOUR THOUGHT">
                        <br>
                    </form>
                </div>

                <?php

                    $comments = $Post->get_comments($ROW['postid']);

                    if(is_array($comments)){

                        foreach($comments as $COMMENT){

                            include("comment.php");

                        }

                    }
                ?>
                    
                </div>

                   
            

            </div>
        

    </div>

</body>
</html>