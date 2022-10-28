<?php 

namespace Models;

 class Pet
{
    private $ownerEmail;
    private $name;
    private $picture;
    private $breed;
    private $video;
    private $vaccination; // URL Image
    private $type;
    private $size;
    private $id;
    
    function __construct($ownerEmail = "", $name = "", $picture = "",$breed = "",$video = "",$vaccination = "", $type = "",$size = ""){
        $this->ownerEmail=$ownerEmail;
        $this->name=$name;
        $this->picture=$picture;
        $this->breed=$breed;
        $this->video=$video;
        $this->vaccination=$vaccination;
        $this->type=$type;
        $this->size=$size;
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

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getOwnerEmail()
    {
        return $this->ownerEmail;
    }

    public function setOwnerEmail($ownerEmail)
    {
        $this->ownerEmail = $ownerEmail;

        return $this;

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