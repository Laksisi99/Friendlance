<div style="min-height: 400px;width: 760px;padding:20px; margin-right:0px; background-color:yellow;text-align:center;">
    <div style="padding: 20px;">

        <?php

            $DB = new Database();
            $sql = "select image,postid from posts where has_image = 1 && userid = $user_data[userid] order by id desc limit 30";
            $images = $DB->read($sql);

            $image_class = new Image();

            if(is_array($images)){

                foreach ($images as $image_row){

                echo "<img src='" . $image_class->get_thumbnail_post($image_row['image']) . "' style='width: 200px;margin:10px;' />";

                }

            }else{

                echo "No photos were found!!!";

            }

        ?>

    </div>
</div>