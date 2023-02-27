<?php

session_start();

    include("classes/connect.php");
    include("classes/login.php");

    $email = "";
    $password = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $login = new Login();
        $result = $login -> evaluate($_POST);

        if($result != "")
        {
            echo "<div style='text-align:center;font: size 12px;color:white;background-color:grey;'>";
            echo "The following errors occured:<br><br>";
            echo $result;
            echo "</div>";

        }else
        {
            header("Location: profile.php");
            die;
        }
        
        $email = $_POST['email'];
        $password = $_POST['password'];

    }
   
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet"/>
    <title> Log In | FRIENDLANCE🤞</title>
</head>

<body>

    <div id="bar">
            <div>FRIENDLANCE 🤞</div>
            <div id="description">Land to connect with your friends</div> 
            <div id="signup-button">Signup</div>       
    </div>

    <div id="signup-form">

            Login to FRIENDLANCE 
            <br><br>

            <form method="post">

                <input name="email" value="<?php echo $email?>" type="text" id="text" placeholder="Enter Your Email"><br><br>
                <input name="password" value="<?php echo $password?>" type="password" id="text" placeholder="Enter Your Password"><br><br>
                
                <input type="submit" id="button" value="LOG IN">

                <br><br><br>

            </form>

    </div>
    
</body>
</html>