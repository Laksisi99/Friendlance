<?php
    
    include("classes/autoload.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['friendlance_userid']);

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
    
    //if something was posted

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $Post->delete_post($_POST['postid']);
        header("Location: profile.php");
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

                    <form method="post">

                            <?php 

                                if($ERROR != ""){

                                    echo $ERROR;
                                }else{

                            
                                    echo "Do you really want to delete your thought???<br><br>";

                                    $user = new User();
                                    $ROW_USER = $user->get_user($ROW['userid']);
                                  
                                    include("post_delete.php");

                                    echo "<input type='hidden' name='postid' value='$ROW[postid]'>";
                                    echo "<input id='post-button' type='submit' value='DELETE THOUGHT'>";

                                }

                            ?>

                        
                        <br>
                    </form>
                    
                </div>


            

            </div>
        

    </div>

</body>
</html>