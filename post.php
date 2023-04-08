<div id='post'>

    <div>

        <?php

            $image = "images/user_male.png";
            if($ROW_USER['gender'] == "Female")
            {
                $image = "images/user_female.png";
            }

            if(file_exists($ROW_USER['profile_image']))
            {
                $image = $image_class->get_thumbnail_profile($ROW_USER['profile_image']);
            }

        ?>

        <img src="<?php echo $image ?>" style="width:75px; margin: 5px; border-radius: 50%;">
    </div>

    <div style="width: 100%;">
        <div id="post-owner">

            <?php 
                echo htmlspecialchars($ROW_USER['first_name'])  . " " . htmlspecialchars($ROW_USER['last_name']); 

                if($ROW['is_profile_image'])
                {
                    $pronoun = "His";
                    if($ROW_USER['gender'] == "Femaile")
                    {
                        $pronoun = "Her";
                    }
                    echo "<span style = 'font-weight:bold; color:#ace; ' > Updated $pronoun Profile Picture</span>";
                }

                if($ROW['is_cover_image'])
                {
                    $pronoun = "His";
                    if($ROW_USER['gender'] == "Female")
                    {
                        $pronoun = "Her";
                    }
                    echo "<span style = 'font-weight:bold; color:#ace; ' > Updated $pronoun Cover Picture</span>";
                }


            ?>

        </div>

        <?php echo htmlspecialchars($ROW['post'])  ?>

        <br><br>

        <?php 

            if(file_exists($ROW['image']))
            {
                $post_image = $image_class->get_thumbnail_post($ROW['image']);
                echo "<img src='$post_image' style='width:80%;' />";
            }
             
        ?>
            
            <br/><br/>

            <?php 
                $likes = "";

                $likes = ($ROW['likes'] > 0) ? "(" . $ROW['likes'] .")" : "";

                // if($ROW['likes'] > 0){

                //     $likes = $ROW['likes'];

                // }else{

                //     $likes = "";

                // }

            ?>

            <a href="like.php?type=post&id=<?php echo $ROW['postid'] ?>">Like<?php echo $likes ?></a> . <a href="">Comment</a> . 

            <span style="color: darkgreen;">
                <?php echo $ROW['date'] ?>
            </span>



            <span style="color: darkgreen; float:right;">

                <?php

                    $post = new Post();
                    if($post -> is_my_post($ROW['postid'],$_SESSION['friendlance_userid'])){

                        echo "
                    <a href='edit.php'>

                        Edit

                    </a> .

                    <a href='delete.php?id= $ROW[postid]'>

                        Delete

                    </a> ";

                    }

                      
                ?>

            </span>

                <?php

                    $i_liked = false;

                    if(isset($_SESSION['friendlance_userid'])){

                

                    $DB = new Database();

                    $sql = "select likes from likes where type = 'post' && contentid='$ROW[postid]' limit 1";
                    $result = $DB->read($sql);

                    if(is_array($result)){

                        $likes = json_decode($result[0]['likes'], true);

                        $user_ids = array_column($likes, "userid");

                        if(in_array($_SESSION['friendlance_userid'], $user_ids)){
                            $i_liked = true;
                        }
                    }

                }

                    if($ROW['likes'] > 0){

                        echo "</br>";
                        echo "<a href = 'likes.php?type=post&id=$ROW[postid]'>";


                        if($ROW['likes'] == 1){

                            if($i_liked ){
                                echo "<div style='text-align:left;'>You liked this post </div>";
                            }else{
                                echo "<div style='text-align:left;'> 1 friend liked this post </div>";
                            }
                        }else{

                            if($i_liked ){

                                $text = "other";
                                if($ROW['likes'] - 1 == 1){
                                    $text = "other";

                                }
                                echo "<div style='text-align:left;'> You and " . ($ROW['likes'] - 1) . "  $text liked this post </div>";

                            
                            }else{
                                echo "<div style='text-align:left;'>" . $ROW['likes'] . " friends liked this post </div>";

                            }

                        }

                        echo "</a>";

                    } 

                    


                ?>
            
    </div>

</div>