<?php

namespace DB;

use Models\Breed as Breed;

//use DAOInterfaces\IBreedDAO as IBreedDAO;
use DB\Connection as Connection;
use \Exception as Exception;

class BreedDAO
{
    private $connection;
    private $tableName = "PetBreeds";

    function newBreed($row)
    {
        $breed = new Breed($row["breed"], 
        $row["id_pet_type"]);
        $breed->setId($row["id"]);
            
        return $breed;
    }

    function getAllDogBreeds()
    {
        try {
            $breedList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (id_pet_type = :id_pet_type);";

            $parameters['id_pet_type'] = 1;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $breed = $this->newBreed($row);
                array_push($breedList, $breed);
            }
            return count($breedList) > 0 ? $breedList : null;
        } catch (Exception $ex) {
            throw $ex;
            
        }
    }

    function getAllCatBreeds()
    {
        try {
            $breedList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (id_pet_type = :id_pet_type);";

            $parameters['id_pet_type'] = 2;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $breed = $this->newBreed($row);
                array_push($breedList, $breed);
            }

            return count($breedList) > 0 ? $breedList : null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}