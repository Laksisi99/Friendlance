<?php

    session_start();
    
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");


    $login = new Login();
    $user_data = $login->check_login($_SESSION['friendlance_userid']);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {
            
            if($_FILES['file']['type'] == "image/jpeg")
            {

                $allowed_size = (1024 * 1024) * 7;
                if($_FILES['file']['size'] < $allowed_size)
                {
                    //everything is fine

                    $filename = "uploads/" . $_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'],  $filename);

                    if(file_exists($filename))
                    {
                        $userid = $user_data['userid'];
                        $query = "update users set profile_image = '$filename' where userid = $userid limit 1";
                        $DB = new Database();
                        $DB->save($query);

                        header(("Location: profile.php"));
                        die;
                    }

                }else{

                    echo "<div style='text-align:center;font: size 12px;color:white;background-color:grey;'>";
                    echo "<br>The following errors occured:<br><br>";
                    echo "Only 3MB or less size images allowed";
                    echo "</div>";

                }

            }else{

                echo "<div style='text-align:center;font: size 12px;color:white;background-color:grey;'>";
                echo "<br>The following errors occured:<br><br>";
                echo "Only allowed Jpeg s";
                echo "</div>";

            }
            


        }else
        {
            echo "<div style='text-align:center;font: size 12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo "Please add a valid image";
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
    <title>Change Profile Image | FRIENDLANCE🤞</title>
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

                
            

            <!--posts area-->
            <div id="pro-dis2">

                <form method="post" enctype="multipart/form-data">
                    <div id="posts-area">

                    <input type="file" name="file"><br>
                    <input id="post-button" type="submit" value="CHANGE PROFILE PICTURE">
                    <br>
                    </div>
                </form>

            

        </div>
        

    </div>

</body>
</html>