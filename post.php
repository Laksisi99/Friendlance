<div id="post">

    <div>

        <?php

            $image = "images/user_male.png";
            if($ROW_USER['gender'] == "Female")
            {
                $image = "images/user_female.png";
            }

        ?>

        <img src="<?php echo $image ?>" style="width:75px; margin: 5px;">
    </div>

    <div>
        <div id="post-owner">

            <?php echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name']; ?>

        </div>

        <?php echo $ROW['post'] ?>
            
            <br/><br/>
            <a href="">Like</a> . <a href="">Comment</a> . 
            <span style="color: darkgreen;">
                <?php echo $ROW['date'] ?>
            </span>
    </div>

</div>