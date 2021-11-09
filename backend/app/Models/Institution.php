<?php

use LearningResources\LearningResource as LearningResource;

class Institution {
    protected $name;
    protected $location;
    protected $learningResources = [];

    public function __construct($name, $location)
    {
        $this->name = $name;
        $this->location = $location;
    }

    public function addLearningResource(LearningResource $lr) {
        $this->learningResources[] = $lr;
    }
}