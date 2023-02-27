<?php

class Post
{

    private $error = "";

    public function create_post($userid, $data)
    {

        if(!empty($data['post']))
        {

            $postid = $this->create_postid();
            $post = addslashes($data['post']);
            // $image = addslashes($data['image']);
            // $comments = ($data['comments']);
            // $likes = ($data['likes']);
            // $has_image = ($data['has_image']);

            $query = "insert into posts (postid,userid,post) values ('$postid','$userid','$post')";

            $DB = new Database();
            $DB->save($query);

        }else
        {
            $this->error .= "Please share your thoughts to post!<br>";
        }

        return $this->error;

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