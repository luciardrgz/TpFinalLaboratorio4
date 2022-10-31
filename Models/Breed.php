<?php

namespace Models;

class Breed
{
    private $id;
    private $breed;
    private $idPetType;

    function __construct($breed = "", $idPetType = "")
    {

        $this->breed = $breed;
        $this->idPetType = $idPetType;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getBreed()
    {
        return $this->breed;
    }

    public function setBreed($breed)
    {
        $this->breed = $breed;
    }

    public function getIdPetType()
    {
        return $this->idPetType;
    }

    public function setIdPetType($idPetType)
    {
        $this->idPetType = $idPetType;
    }
}