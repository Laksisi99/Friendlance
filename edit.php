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

    $ERROR = "";
    if(isset($_GET['id'])){

        $ROW = $Post->get_single_post($_GET['id']);

        if(!$ROW){

            $ERROR = "Sorry! No such thought was found!!!";

        }else{

            if($ROW['userid'] != $_SESSION['friendlance_userid']){
               
                $ERROR = "Sorry! You can not Delete this!!!";

            }
        }

    }else{

        $ERROR = "Sorry! No such thought was found!!!";

    }
    

    if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit.php")){

        $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
    
    }

    //if something was posted

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $Post->edit_post($_POST,$_FILES);

        header("Location: " .$_SESSION['return_to']);
        die;
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet"/>
    <title>DELETE | FRIENDLANCE🤞</title>
</head>

<body>
    
    <br>
    
    <?php include("header.php"); ?>


    <!--profile cover page-->
    <div id="profile-cover">

        

        

               
            

            <!--posts area-->
            <div id="pro-dis2">

                <div id="posts-area">

                    <form method="post" enctype="multipart/form-data">

                            <?php 

                                if($ERROR != ""){

                                    echo $ERROR;
                                }else{

                            
                                    echo "Edit your thought<br><br>";

                                    
                                  
                                    echo '<textarea name="post" placeholder="Write Your Thoughts">'.$ROW['post'].'</textarea>
                                            <input type="file" name="file">';

                                    echo "<input type='hidden' name='postid' value='$ROW[postid]'>";
                                    echo "<input id='post-button' type='submit' value='SAVE THOUGHT'>";

                                    if(file_exists($ROW['image']))
                                    {
                                        $image_class = new Image();
                                        $post_image = $image_class->get_thumbnail_post($ROW['image']);
                                        echo "<br><br><div style='text-align:center';><img src='$post_image' style='width:50%;' /></div>";
                                    }
                                     

                                }

                            ?>

                        
                        <br>
                    </form>
                    
                </div>


            

            </div>
        

    </div>

</body>
</html>