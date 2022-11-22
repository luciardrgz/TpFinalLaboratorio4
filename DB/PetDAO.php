<?php

namespace DB;

use Models\Pet as Pet;
use Models\Breed as Breed;
use DB\Connection as Connection;
use DB\OwnerDAO as OwnerDAO;
use DB\BreedDAO as BreedDAO;
use \Exception as Exception;
use Exceptions\DuplicatedValueException as DuplicatedValueException;
use Models\Owner;

class PetDAO
{
    private $connection;
    private $tableName = "Pets";

    function add(Pet $pet)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " 
            (id_pet_owner,id_pet_breed, id_pet_size, name, picture, video, vaccination, id_pet_type)
            VALUES (:ownerId,:breed,:size,:name,:picture,:video,:vaccination,:type);";

            $parameters["ownerId"] = $pet->getOwnerId();
            $parameters["breed"] = $pet->getBreed();
            $parameters["size"] = $pet->getSize();
            $parameters["name"] = $pet->getName();
            $parameters["picture"] = $pet->getPicture();
            $parameters["video"] = $pet->getVideo();
            $parameters["vaccination"] = $pet->getVaccination();
            $parameters["type"] = $pet->getType();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }catch (Exception $ex) {
            if($ex->errorInfo[0] == '23000' && $ex->errorInfo[1] == '1062'){
                throw new DuplicatedValueException("Pet or Vaccine image already exists");
            }else{
                throw $ex;
            }
        }
    }

    function newPet($row)
    {
            $pet = new Pet(
                $row["id_pet_owner"],
                $row["name"],
                $row["picture"],
                $row["breed"],
                $row["video"],
                $row["vaccination"],
                $row["id_pet_type"],
                $row["id_pet_size"]
            );
            $pet->setId($row["id"]);

        return $pet;
    }

    function getPetById($id)
    {
        try {
            $query = "SELECT p.id, p.id_pet_owner, p.name, p.picture, pb.breed, p.video,p.vaccination, p.id_pet_type, p.id_pet_size 
            FROM " . $this->tableName . " as p
            JOIN petbreeds pb
            ON p.id_pet_breed = pb.id
            WHERE (p.id = :id);";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $pet = null;

            if(!empty($resultSet)){
                $row = $resultSet[0];
                $pet = $this->newPet($row);
            }
            
            return $pet;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function getPetsByOwnerId()
    {
        try {

            $petList = array();

            $query = "SELECT p.id, p.id_pet_owner, p.name, p.picture, pb.breed, p.video,p.vaccination, p.id_pet_type, p.id_pet_size 
            FROM " . $this->tableName . " as p
            JOIN petbreeds pb
            ON p.id_pet_breed = pb.id
            WHERE (p.id_pet_owner = :idOwner);";

            $idOwner = $_SESSION['id'];

            $parameters['idOwner'] = $idOwner;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach($resultSet as $row){
                $pet = $this->newPet($row);
                array_push($petList, $pet);
            }
            return count($petList) > 0 ? $petList : null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getCatsByOwnerEmail($email)
    {
        try {

            $catList = array();  
            
            $query = "SELECT o.id as 'ownerId', p.id ,p.name,p.picture,p.vaccination,p.video,pb.breed, ps.size, pt.type_description
            FROM pets as p
            join owners as o
            on p.id_pet_owner = o.id
            join petbreeds as pb
            on p.id_pet_breed = pb.id
            join petsizes as ps
            on p.id_pet_size = ps.id
            join pettypes as pt
            on p.id_pet_type = pt.id
            WHERE o.email = :email and p.id_pet_type = 2;";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach($resultSet as $row){
                $pet = $this->newPet($row);
                array_push($catList, $pet);
            }
            return count($catList) > 0 ? $catList : null;
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getDogsByOwnerEmail($email)
    {
        try {

            $dogList = array();
            $query = "SELECT o.id as 'ownerId', p.id ,p.name,p.picture,p.vaccination,p.video,pb.breed, ps.size, pt.type_description
            FROM pets as p
            join owners as o
            on p.id_pet_owner = o.id
            join petbreeds as pb
            on p.id_pet_breed = pb.id
            join petsizes as ps
            on p.id_pet_size = ps.id
            join pettypes as pt
            on p.id_pet_type = pt.id
            WHERE o.email = :email and p.id_pet_type = 1;";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach($resultSet as $row){
                $pet = $this->newPet($row);
                array_push($dogList, $pet);
            }
            return count($dogList) > 0 ? $dogList : null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}