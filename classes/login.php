<?php

class Login
{

    private $error = "";
    
    public function evaluate($data)
    {
        
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);

        $query = "select * from users where email = '$email' limit 1";
        
        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            $row = $result[0];
            
            if($password == $row['password'])
            {
                //create session data
                $_SESSION['friendlance_userid'] = $row['userid'];
            }else
            {
                $this->error .= "Wrong Password<br>";
            }
        }else
        {
            $this->error .= "No such Email was found<br.";
        } 
        
        return $this->error;
        
    }

    public function check_login($id)
    {
        $query = "select userid from users where userid = '$id' limit 1";
        
        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return true;
        }

        return false;
    }

}

