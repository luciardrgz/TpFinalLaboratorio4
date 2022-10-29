<?php 
namespace DAOInterfaces;
use Models\Pet as Pet;

interface IPetDAO{
    function add(Pet $pet);
    function getAll();
    function getByPetName($petName);
    function getPetsByOwnerEmail($email);
    function getDogsByOwnerEmail($email);
    function getCatsByOwnerEmail($email);
    function getAllCatBreeds();
    function getAllDogBreeds(); // TODO: Version JSON

}