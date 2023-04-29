<div id="profile-display">

            <!--friends area-->
            <div id="pro-dis1"></div>

                <div id="friends-bar">

                    Following <br>

                    <?php

            
                        if($friends)
                        {
                            foreach($friends as $friend)
                            {
                                $FRIEND_ROW = $user->get_user($friend['userid']);
                                include('user.php');
                            }
                        }   


                    ?>

                    

                </div>
            

            <!--posts area-->
            <div id="pro-dis2">

                <div id="posts-area">
                    <form method="post" enctype="multipart/form-data">
                        <textarea name="post" placeholder="Write Your Thoughts"></textarea>
                        <input type="file" name="file">
                        <input id="post-button" type="submit" value="SHARE THOUGHTS">
                        <br>
                    </form>
                </div>


                <!--posts-->

                <div id="post-bar">

                    <?php

            
                        if($posts)
                        {
                            foreach($posts as $ROW)
                            {
                                $user = new User();
                                $ROW_USER = $user->get_user($ROW['userid']);

                                include('post.php');
                            }
                        }   
                        

                    ?>

                </div>

            </div>

        </div>