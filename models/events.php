<?php
namespace FSR_AI;

class events
{
    private $topic;
    private $date;
    private $startTime;
    private $location;
    private $description;

    public function __construct($topic, $date, $startTime, $location, $description){
        $this->topic = $topic;
        $this->date = $date;
        $this->startTime = $startTime;
        $this->location = $location;
        $this->description = $description;
    }


    public function __get($name){
        // TODO: Implement __get() method.
    }

    public function __set($name, $value){
        // TODO: Implement __set() method.
    }




}