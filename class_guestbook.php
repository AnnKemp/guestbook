<?php
class guestbook {

    private $readJSONFile;
    public $array=[];
    public $content;

    // this is the setter
    public function __construct($array_post, $file) {

        //read json file from url in php
        $this->readJSONFile = file_get_contents($file);
        //print_r($readJSONFile); // display contents
        $this->array = substr($this->readJSONFile,7,2); // remove unwanted characters
        $this->array = json_decode($this->readJSONFile, TRUE); // makes an array

        array_unshift($this->array,$array_post);
        // make text from the data before putting it back on the json-file
        $this->content=json_encode($this->array);
    }
    // this is the getter
    public function display_data() {
        return $this->array;
    }
    public function backToJsonFile() {
        return $this->content;
    }
}