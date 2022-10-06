<?php 
namespace Models;

class Dog extends Pet{

    private $size;  
    
    function __construct($name, $picture, $breed, $video, $vaccination,$size)
    {
        parent::__construct($name, $picture, $breed, $video, $vaccination);
        $this->size=$size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

}

?>