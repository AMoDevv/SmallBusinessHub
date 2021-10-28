<?php
class Result {
    public $name;
    public $val;
    public $type;

    public function __construct($name, $val, $type) {
        $this->name = $name;
        $this->val = $val;
        $this->type = $type;

    }

    public function getName() {
        return $this->name;
    }

    public function getVal() {
        return $this->val;
    }

    public function getType() {
        return $this->type;
    }
}

?>