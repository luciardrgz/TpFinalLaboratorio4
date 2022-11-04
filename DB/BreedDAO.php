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

    // Se le pasa una breed completa y nos retorna su nombre
    public function getBreedName($breed)
    {
        $foundBreed = new Breed();
        $foundBreed = $this->getBreedByID($breed);

        return $foundBreed->getBreed();
    }

    // Trae un objeto breed completo según un ID
    public function getBreedByID($passedId)
    {
        try {

            $breedList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE id = :passedId;";

            # Parameters lleva el nombre de la variable PHP
            $parameters['passedId'] = $passedId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {

                $breed = new Breed($row["breed"], $row["id_pet_type"]);
                $breed->setId($row["id"]);
                array_push($breedList, $breed);
            }

            return (count($breedList) > 0) ? $breedList[0] : null;
        } catch (Exception $ex) {
            //throw $ex;
            echo " excepcion en getbreedbyID";
        }
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
                $breed = new Breed($row["breed"], $row["id_pet_type"]);
                $breed->setId($row["id"]);

                array_push($breedList, $breed);
            }
            return $breedList;
        } catch (Exception $ex) {
            //throw $ex;
            echo "excepcion en getalldogbreeds";
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
                $breed = new Breed($row["breed"], $row["id_pet_type"]);
                $breed->setId($row["id"]);

                array_push($breedList, $breed);
            }

            return $breedList;
        } catch (Exception $ex) {
            //throw $ex;
            echo " excepcion getallcatbreeds";
        }
    }
}