<div id="friend">

        <?php

            $image = "images/user_male.png";
            if($FRIEND_ROW['gender'] == "Female")
            {
                $image = "images/user_female.png";
            }

        ?>

    <img id="friend-profile" src="<?php echo $image ?>">
    <br>

    <?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name']?>

</div>