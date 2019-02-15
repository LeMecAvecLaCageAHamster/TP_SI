<?php

// TODO : MOVE
date_default_timezone_set("Europe/Paris"); 
require_once(__DIR__.'/BDD.php');

class Post
{
    private $id; // auto generated
    private $title;
    private $content;
    private $date; // auto generated

    private function __construct($id=null,$title=null,$content=null,$date=null){
        $this->setTitle($title);   
        $this->setContent($content);  
        if(empty($date)){
            $this->date = date('Y-m-d H:i:s',time('now'));
        }else{
            $this->date = preg_replace('/[^0-9 -:]/','',$date);
        } 
    }

    public static function create($title,$content)
    {
        return new self(null,$title,$content,null);
    }

    public function setTitle($title, $save_changes=TRUE)
    {
        $this->title = htmlentities($title);
        if($save_changes) $this->save(); 
    }


    public function setContent($content, $save_changes=TRUE)
    {
        $this->content = htmlentities($content);
        if($save_changes) $this->save(); 
    }

    public function save()
    {
       // INSERT INTO `posts` (`id`, `title`, `content`, `created`) VALUES (NULL, 'You cannot change this', 'that\'s what i call security...', NOW());
    }

    public static function get($id)
    {
        preg_replace('/\D/', '', htmlentities($id));

        $bdd = BDD::getInstance();
        $req = $bdd->prepare('SELECT id,title,content,created FROM posts WHERE id=:id LIMIT 1');
        $req->execute([
            ':id'=> $id
        ]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        if (empty($result)) throw new Exception("empty result", 1);
        
        return new self($result['id'], $result['title'], $result['content'], $result['created']);
    }
}

var_dump( Post::get(1) );
