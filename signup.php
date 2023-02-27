<?php

    include("classes/connect.php");
    include("classes/signup.php");

    $first_name = "";
    $last_name = "";
    $gender = "";
    $email = "";
    

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $signup = new Signup();
        $result = $signup -> evaluate($_POST);

        if($result != "")
        {
            echo "<div style='text-align:center;font: size 12px;color:white;background-color:grey;'>";
            echo "The following errors occured:<br><br>";
            echo $result;
            echo "</div>";

        }else
        {
            header("Location: login.php");
            die;
        }
        
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];

    }
   
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet"/>
    <title>Sign Up | FRIENDLANCE🤞</title>
    
</head>

<body>

    <div id="bar">
            <div>FRIENDLANCE 🤞</div>
            <div id="description">Land to connect with your friends</div> 
            <div id="signup-button">Login</div>       
    </div>

    <div id="signup-form">

            Signup to FRIENDLANCE 
            <br><br>

            <form method="post" action="">

                <input value= "<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="Enter Your First Name"><br><br>
                <input value= "<?php echo $last_name ?>" name= "last_name" type="text" id="text" placeholder="Enter Your Last Name"><br><br>

                <span style="font-weight: normal;">Gender:</span><br>
                <select id="text" name="gender">

                    <option><?php echo $gender ?></option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>

                </select>
                <br><br>

                <input value= "<?php echo $email ?>" name="email" type="text" id="text" placeholder="Enter Your Email"><br><br>

                <input name="password" type="password" id="text" placeholder="Enter Your Password"><br><br>
                <input name="re_password" type="password" id="text" placeholder="Re-Type Your Password"><br><br>

                <input type="submit" id="button" value="SIGN UP">

                <br><br><br>

            </form>

    </div>
    
</body>
</html>