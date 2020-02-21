<?php
// class post
class Post {  // this class works perfect!

    // initializing properties
    private $author;
    private $message_content;
    private $message_title;
    private $date;

    public $postValues=[];

    // this is the setter
    public function __construct($title, $date, $message, $name) {
        $this->message_title=$title;
        $this->date= $date;
        $this->message_content=$message;
        $this->author = $name;
        $this->postValues = array($this->message_title,$this->date,$this->message_content,$this->author);
    }
    // this is the getter
    public function display() {
        return $this->postValues;
    }
}

