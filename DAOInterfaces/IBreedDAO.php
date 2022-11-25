<?php

namespace DAOInterfaces;

use Models\Breed as Breed;

interface IBreedDAO
{
    public function newBreed($row);
    public function getAllDogBreeds();
    public function getAllCatBreeds();
}