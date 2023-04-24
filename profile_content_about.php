<div style="min-height: 400px;width: 760px;padding:20px; margin-right:0px; background-color:yellow;text-align:center;">
    <div style="padding: 20px;max-width: 500px;display:inline-block;">

    <form method="post" enctype="multipart/form-data">
                        

        <?php

            $settings_class = new Settings();

            $settings = $settings_class->get_settings($_SESSION['friendlance_userid']);

            if(is_array($settings)){

              
                echo "<br>About Me:<br>

                    <div id='search-box' style='height:200px;border:none;' name='about'>". htmlspecialchars ($user_data['about']) . "</div>
                
                ";


    
            }

            

        ?>

    </form>

    </div>
</div>