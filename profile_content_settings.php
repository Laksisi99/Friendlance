<div style="min-height: 400px;width: 760px;padding:20px; margin-right:0px; background-color:yellow;text-align:center;">
    <div style="padding: 20px;max-width: 500px;display:inline-block;">

    <form method="post" enctype="multipart/form-data">
                        

        <?php

            $settings_class = new Settings();

            $settings = $settings_class->get_settings($_SESSION['friendlance_userid']);

            if(is_array($settings)){

                echo "<input type = 'text' id='search-box' name='first_name' value='". htmlspecialchars ($settings['first_name']) . "' placeholder='First Name' /><br><br>";
                echo "<input type = 'text' id='search-box' name='last_name' value='". htmlspecialchars ($settings['last_name']) . "' placeholder='Last Name' /><br><br>";
    
                echo "<select id='search-box' name='gender' style='height: 30px;'>
                
                      <option>".htmlspecialchars ($settings['gender']) . "</option>
                      <option>Male</option>
                      <option>Female</option>
    
                      <select/><br><br>";
    
                echo "<input type = 'text' id='search-box' name='email' value='". htmlspecialchars ($settings['email']) . "' placeholder='Email' /><br><br>";
                echo "<input type = 'password' id='search-box' name='password' value='". htmlspecialchars ($settings['password']) . "'  placeholder='Password' /><br><br>";
                echo "<input type = 'password' id='search-box' name='password2' value='". htmlspecialchars ($settings['password']) . "'  placeholder='Retype Password' /><br><br>";

                echo "<br>About Me:<br>

                    <textarea id='search-box' style='height:200px;' name='about'>". htmlspecialchars ($settings['about']) . "</textarea>
                
                ";

                echo "<br> <input id='post-button' type='submit' value='UPDATE PROFILE' />";

    
            }

            

        ?>

    </form>

    </div>
</div>