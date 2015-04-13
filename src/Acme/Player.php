<?php namespace Acme;

class Player {
    public $name;
    public $points;

    public function __construct($name, $score)
    {
        $this->name = $name;
        $this->points = $score;
    }

    public function earnPoints($points) {
        $this->points = $points;
    }
}