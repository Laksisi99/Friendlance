<div id="friend">

        <?php

            $image = "images/user_male.png";
            if($FRIEND_ROW['gender'] == "Female")
            {
                $image = "images/user_female.png";
            }

            if(file_exists($FRIEND_ROW['profile_image']))
            {
                $image = $image_class->get_thumbnail_profile($FRIEND_ROW['profile_image']);
            }

        ?>

    <a href="profile.php?id=<?php echo $FRIEND_ROW['userid']; ?>">

        <img id="friend-profile" src="<?php echo $image ?> " style="border-radius: 50%;">
        <br>

        <?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name']?>

    </a>

</div>