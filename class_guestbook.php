<?php
class Guestbook {

    public $content;
    public $allData;

    // this is the setter
    public function __construct($array_post, $file) {
        $this->allData = [];
        //read json file from url in php
        $this->allData = file_get_contents(json_decode($file));
        $this->allData = substr($this->allData,7,2); // remove unwanted characters
        $this->allData = json_decode($this->allData, TRUE); // this makes an array

        array_unshift($this->allData, $array_post); // add the $_POST data
        // make text from the data before putting it back on the json-file
        $this->content=json_encode($this->allData);
    }
    // this is the getter
    public function display_data() {
        return $this->allData;
    }
    public function backToJsonFile() {
        return $this->content;
    }
}