<?php
class Result {
    public $name;
    public $val;

    public function __construct($name, $val) {
        $this->name = $name;
        $this->val = $val;
    }

    public function getName() {
        return $this->name;
    }

    public function getVal() {
        return $this->val;
    }
}

?>