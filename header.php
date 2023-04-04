
<!--profile top bar-->
<?php

    $corner_image = "images/user_male.png";
    if(isset($USER)) {
        if(file_exists($USER['profile_image']))
        {
            $image_class = new Image();
            $corner_image = $image_class->get_thumbnail_profile($USER['profile_image']);
        }else{

            if($USER['gender'] == "Female"){
                $corner_image = "images/user_female.png";
            }
        }
    }
?>

<div id="profile-bar">
        <div id="profile-topic">
            
            <a href="index.php" style="color:greenyellow; text-decoration: none;">FRIENDLANCE🤞</a> 
            
            &nbsp &nbsp<input type="text" id="search-box" placeholder="🔎Search for Friends">
            
            <a href="profile.php">
                <img src="<?php echo $corner_image ?>" style="width: 65px; float: right; border-radius: 50%;">
            </a>

            <a href="logout.php">
                <span style="font-size:15px;float:right;margin-right:10px;margin-top:15px;color:whitesmoke;">Logout</span>
            </a>

        </div>
    </div>
