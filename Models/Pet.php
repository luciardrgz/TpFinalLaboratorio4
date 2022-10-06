<?php 

namespace Models;

abstract class Pet
{
    private $name;
    private $picture;
    private $breed;
    private $video;
    private $vaccination; // Image
    
    function __construct($name, $picture, $breed, $video, $vaccination){
        $this->name=$name;
        $this->picture=$picture;
        $this->breed=$breed;
        $this->video=$video;
        $this->vaccination=$vaccination;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
 
    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }
   
    public function getBreed()
    {
        return $this->breed;
    }

    public function setBreed($breed)
    {
        $this->breed=$breed;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setVideo($video)
    {
        $this->video = $video;
    }

    public function getVaccination()
    {
        return $this->vaccination;
    }

    public function setVaccination($vaccination)
    {
        $this->vaccination = $vaccination;
    }
    
}

?>