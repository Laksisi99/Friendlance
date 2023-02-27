<?php

    session_start();
    
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");

    //checked if user is logged in

    if(isset($_SESSION['friendlance_userid']) && is_numeric($_SESSION['friendlance_userid']))
    {
        $id = $_SESSION['friendlance_userid'];
        $login = new Login();

        $result = $login->check_login($id);

        if($result)
        {

            //retrieve user data;
            $user = new User();
            $user_data = $user->get_data($id);

            if(!$user_data)
            {
                header("Location: login.php");
                die;
            }
            

        }else
        {
            header("Location: login.php");
            die;
        }
    }else
    {
        header("Location: login.php");
        die;
    }

    //posting starts here

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        $post = new Post();
        $id = $_SESSION['friendlance_userid'];
        $result = $post->create_post($id, $_POST);
        

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet"/>
    <title>Profile | FRIENDLANCE🤞</title>
</head>

<body>
    
    <br>
    <!--profile top bar-->
    <div id="profile-bar">
        <div id="profile-topic">
            FRIENDLANCE🤞 &nbsp &nbsp<input type="text" id="search-box" placeholder="🔎Search for Friends">
            
            <img src="images/friends.PNG" style="width: 65px; float: right; ">

            <a href="logout.php">
                <span style="font-size:15px;float:right;margin-right:10px;margin-top:15px;color:whitesmoke;">Logout</span>
            </a>

        </div>
    </div>

    <!--profile cover page-->
    <div id="profile-cover">

        <div id="pro-pic-bg">

            <img src="images/profile.PNG" style="width: 100%;">
            <img id="pro-pic" src="images/friends.PNG">
            <br>
                <div id="profile-name"><?php echo $user_data['first_name'] . " " . $user_data['last_name']?></div>
            <br>
            <div id="menu-buttons">Timeline</div>
            <div id="menu-buttons">About</div>
            <div id="menu-buttons">Friends</div>
            <div id="menu-buttons">Photos</div>
            <div id="menu-buttons">Settings</div>
                
        </div>

        <!--below cover area-->

        <div id="profile-display">

            <!--friends area-->
            <div id="pro-dis1"></div>

                <div id="friends-bar">

                    Friends <br>

                    <div id="friend">

                        <img id="friend-profile" src="images/user1.jpg">
                        <br>
                        Warsha Fernando

                    </div>

                    <div id="friend">

                        <img id="friend-profile" src="images/user2.jpg">
                        <br>
                        Kethaki Karunachandra

                    </div>

                    <div id="friend">

                        <img id="friend-profile" src="images/user3.jpg">
                        <br>
                        Dunuke Rathnayake

                    </div>

                </div>
            

            <!--posts area-->
            <div id="pro-dis2">

                <div id="posts-area">
                    <form method="post">
                        <textarea name="post" placeholder="Write Your Thoughts"></textarea>
                        <input id="post-button" type="submit" value="SHARE THOUGHTS">
                        <br>
                    </form>
                </div>


            <!--posts-->
            <div id="post-bar">

                 <!--post1-->
                <div id="post">

                    <div>
                        <img src="images/user1.jpg" style="width:75px; margin: 5px;">
                    </div>
                    <div>
                        <div id="post-owner">Warsha's Thought</div>
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        <br/><br/>
                        <a href="">Link</a> . <a href="">Comment</a> . <span style="color: darkgreen;">February 21 2023</span>
                    </div>

                </div>

                 <!--post2-->
                 <div id="post">

                    <div>
                        <img src="images/user2.jpg" style="width:75px; margin: 5px;">
                    </div>
                    <div>
                        <div id="post-owner">Kethaki's Thought</div>
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        <br/><br/>
                        <a href="">Link</a> . <a href="">Comment</a> . <span style="color: darkgreen;">February 21 2023</span>
                    </div>

                </div>

                 <!--post3-->
                 <div id="post">

                    <div>
                        <img src="images/user3.jpg" style="width:75px; margin: 5px;">
                    </div>
                    <div>
                        <div id="post-owner">Dunuke's Thought</div>
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        Hi wanted to make platform to make get together our school mates from various fields.
                        <br/><br/>
                        <a href="">Link</a> . <a href="">Comment</a> . <span style="color: darkgreen;">February 21 2023</span>
                    </div>

                </div>

            </div>

        </div>
        

    </div>

</body>
</html>