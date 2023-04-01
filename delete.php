<?php
    
    include("classes/autoload.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['friendlance_userid']);

    $ERROR = "";
    if(isset($_GET['id'])){

        $Post = new Post();
        $row = $Post->get_single_post($_GET['id']);

        if(!$row){

            $ERROR = "Sorry! No such thought was found!!!";

        }

    }else{

        $ERROR = "Sorry! No such thought was found!!!";

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

                    <h2>Delete Your Thought</h2>
                    <form method="post">

                        Do you really want to delete your thought???

                        <hr>
                            <?php echo $row['post']; ?>

                        <input id="post-button" type="submit" value="DELETE THOUGHT">
                        <br>
                    </form>
                    
                </div>


            

            </div>
        

    </div>

</body>
</html>