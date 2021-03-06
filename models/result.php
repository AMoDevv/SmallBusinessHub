<?php
// This class is used for the search page
// Val is the match percent
// Along with the other necessary data to put into the search page
class Result {
    public $name;
    public $val;
    public $type;
    public $id;
    public $photo;
    
    public function __construct($name, $val, $type, $id, $photo) {
        $this->name = $name;
        $this->val = $val;
        $this->type = $type;
        $this->id = $id;
        $this->photo = $photo;

    }

    public function getName() {
        return $this->name;
    }

    public function getVal() {
        return $this->val;
    }

    public function getID() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function getPhoto() {
        return $this->photo;
    }
}

?>