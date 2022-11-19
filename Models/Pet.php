<?php

namespace Models;

class Pet
{
    private $ownerId;
    private $name;
    private $picture;
    private $breed;
    private $video;
    private $vaccination;
    private $type;
    private $size;
    private $id;

    function __construct($ownerId = "", $name = "", $picture = "", $breed = "", $video = "", $vaccination = "", $type = "", $size = "")
    {
        $this->ownerId = $ownerId;
        $this->name = $name;
        $this->picture = $picture;
        $this->breed = $breed;
        $this->video = $video;
        $this->vaccination = $vaccination;
        $this->type = $type;
        $this->size = $size;
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
        $this->breed = $breed;
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
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getSizeText()
    {
        if ($this->size == 1) {
            return "Small";
        } elseif ($this->size == 2) {
            return "Medium";
        } else {
            return "Big";
        }
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }
}
