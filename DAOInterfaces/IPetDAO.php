<?php

namespace DAOInterfaces;

use Models\Pet as Pet;

interface IPetDAO
{
    public function add(Pet $pet);
    public function newPet($row);
    public function getPetById($id);
    public function getPetsByOwnerId();
    public function getCatsByOwnerEmail($email);
    public function getDogsByOwnerEmail($email);
}