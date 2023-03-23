
<!--profile top bar-->
<?php

    $corner_image = "images/user_male.png";
    if(isset($user_data))
    {
        $corner_image = $user_data['profile_image'];
    }
?>

<div id="profile-bar">
        <div id="profile-topic">
            
            <a href="index.php" style="color:greenyellow; text-decoration: none;">FRIENDLANCE🤞</a> 
            
            &nbsp &nbsp<input type="text" id="search-box" placeholder="🔎Search for Friends">
            
            <a href="profile.php">
                <img src="<?php echo $corner_image ?>" style="width: 65px; float: right; ">
            </a>

            <a href="logout.php">
                <span style="font-size:15px;float:right;margin-right:10px;margin-top:15px;color:whitesmoke;">Logout</span>
            </a>

        </div>
    </div>
