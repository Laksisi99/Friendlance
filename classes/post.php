<?php

class Post
{

    private $error = "";

    public function create_post($userid, $data, $files)
    {

        if(!empty($data['post']) || !empty($files['file']['name']) || isset($data['is_profile_image']) || isset($data['is_cover_image']))
        {

            $postimage = "";
            $has_image = 0;
            $is_cover_image = 0;
            $is_profile_image = 0;

            if(isset($data['is_profile_image']) || isset($data['is_cover_image']))
            {

                $postimage = $files;
                $has_image = 1;

                if(isset($data['is_cover_image']))
                {
                    $is_cover_image = 1;
                }

                if(isset($data['is_profile_image']))
                {
                    $is_profile_image = 1;
                }
                    

            }else
            {
                if(!empty($files['file']['name']))
                {
                    

                    $folder = "uploads/" . $userid . "/";

                    //create folder
                        if(!file_exists($folder))
                        {
                            mkdir($folder, 0777, true);
                            file_put_contents($folder . "index.php" , "");
                        }

                        $image_class = new Image();

                        $postimage = $folder . $image_class->generate_filename(15) . ".jpeg";
                        move_uploaded_file($_FILES['file']['tmp_name'],  $postimage);

                        $image_class->resize_image($postimage,$postimage,1000,1000);


                        $has_image = 1;    
                }
        }

            $post = "";
            if(isset($data['post']))
            {
                $post = addslashes($data['post']);
            }

            $postid = $this->create_postid();
            $parent = 0;
            $DB = new Database();


            if(isset($data['parent']) && is_numeric($data['parent'])){

                $parent = $data['parent'];

                $sql = "update posts set comments = comments + 1 where postid = '$parent' limit 1 ";
                $DB->save($sql);

            }
            $query = "insert into posts (postid,userid,post,image,has_image,is_profile_image,is_cover_image,parent) values ('$postid','$userid','$post','$postimage','$has_image','$is_profile_image','$is_cover_image','$parent')";

            $DB->save($query);

        }else
        {
            $this->error .= "Please share your thoughts to post!<br>";
        }

        return $this->error;

    }


    public function edit_post($data, $files)
    {

        if(!empty($data['post']) || !empty($files['file']['name'])) 
        {

            $postimage = "";
            $has_image = 0;
           
            
                if(!empty($files['file']['name']))
                {
                    

                    $folder = "uploads/" . $userid . "/";

                    //create folder
                        if(!file_exists($folder))
                        {
                            mkdir($folder, 0777, true);
                            file_put_contents($folder . "index.php" , "");
                        }

                        $image_class = new Image();

                        $postimage = $folder . $image_class->generate_filename(15) . ".jpeg";
                        move_uploaded_file($_FILES['file']['tmp_name'],  $postimage);

                        $image_class->resize_image($postimage,$postimage,1000,1000);


                        $has_image = 1;    
                }
        

            $post = "";
            if(isset($data['post']))
            {
                $post = addslashes($data['post']);
            }

            $postid = addslashes($data['postid']);
            
            if($has_image){

                $query = "update posts set post = '$post', image = '$postimage' where postid = '$postid' limit 1";

            }else{

                $query = "update posts set post = '$post' where postid = '$postid' limit 1";

            }

            $DB = new Database();
            $DB->save($query);

        }else
        {
            $this->error .= "Please share your thoughts to post!<br>";
        }

        return $this->error;

    }

    public function get_posts($id)
    {
        
        $query = "select * from posts where parent = 0 and userid = '$id' order by id desc limit 10";

        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return $result;
        }else
        {
            return false;
        }

    }

    
    public function get_comments($id)
    {
        
        $query = "select * from posts where parent = '$id' order by id asc limit 30";

        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return $result;
        }else
        {
            return false;
        }

    }

    public function get_single_post($postid)
    {
        if(!is_numeric($postid)){

            return false;

        }
        
        $query = "select * from posts where postid = '$postid' limit 1";

        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return $result[0];
        }else
        {
            return false;
        }

    }

    public function delete_post($postid)
    {
        
        if(!is_numeric($postid)){

            return false;

        }

        $DB = new Database();

        $sql = "select parent from posts where postid = '$postid' limit 1";

        $result = $DB->read($sql);   


        if(is_array($result)){


            if($result[0]['parent'] > 0){

                $parent = $result[0]['parent'];

                $sql = "update posts set comments = comments - 1 where postid = '$parent' limit 1 ";
                $DB->save($sql);

            }

        }
           
        
        
        $query = "delete from posts where postid = '$postid' limit 1";

        // $DB = new Database();
        $DB->save($query);   


    }

    public function is_my_post($postid,$friendlance_userid)
    {
        
        if(!is_numeric($postid)){

            return false;

        }
        
        $query = "select * from posts where postid = '$postid' limit 1";

        $DB = new Database();
        $result = $DB->read($query);   

        if(is_array($result)){

            if($result[0]['userid'] == $friendlance_userid){
                return true;
            }

        }

        return false;

    }

    public function get_likes($id, $type){

        $DB = new Database();

        if(is_numeric($id)){

            //get like details

            $sql = "select likes from likes where type = '$type' && contentid='$id' limit 1";
            $result = $DB->read($sql);

            if(is_array($result)){
                
                $likes = json_decode($result[0]['likes'], true);
                return $likes;
            }

        }

        return false;
    }

    public function like_post($id,$type,$friendlance_userid){


            $DB = new Database();

            
            //save like details

            $sql = "select likes from likes where type = '$type' && contentid='$id' limit 1";
            $result = $DB->read($sql);

            if(is_array($result)){

                $likes = json_decode($result[0]['likes'], true);

                $user_ids = array_column($likes, "userid");

                if(!in_array($friendlance_userid, $user_ids)){

                    $arr["userid"] = $friendlance_userid;
                    $arr["date"] = date("Y-m-d H:i:s");

                    $likes[] = $arr;

                    $likes_string = json_encode($likes);
                    $sql = "update likes set likes = '$likes_string' where type = '$type' && contentid='$id' limit 1";
                    $DB->save($sql);

                    //increment post table
                    $sql = "update {$type}s set likes = likes + 1 where {$type}id = '$id' limit 1";
                    $DB->save($sql);


                }else{

                    $key = array_search($friendlance_userid, $user_ids);
                    unset($likes[$key]);

                    $likes_string = json_encode($likes);
                    $sql = "update likes set likes = '$likes_string' where type = '$type' && contentid='$id' limit 1";
                    $DB->save($sql);

                    //decrement post table
                    $sql = "update {$type}s set likes = likes - 1 where {$type}id = '$id' limit 1";
                    $DB->save($sql);


                }
                

            }else{

                $arr["userid"] = $friendlance_userid;
                $arr["date"] = date("Y-m-d H:i:s");

                $arr2[] = $arr;

                $likes = json_encode($arr2);
                $sql = "insert into likes (type,contentid,likes) values ('$type','$id','$likes')";
                $DB->save($sql);

                //increment right table
                $sql = "update {$type}s set likes = likes + 1 where {$type}id = '$id' limit 1";
                $DB->save($sql);


            }

        

    }

    private function create_postid()
    {
        $length = rand(4,19);
        $number = "";

        for($i=1; $i < $length; $i++){
            $new_rand = rand(0,9);
            $number  = $number . $new_rand;
        }

        return $number;
    }

}