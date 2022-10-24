<?php 
namespace Models;

class Dog extends Pet{

    private $size;  

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

}