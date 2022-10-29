<?php

namespace DB;

use DAOInterfaces\IPetDAO as IPetDAO;
use Models\Pet as Pet;
use Models\Breed as Breed;
use DB\Connection as Connection;
use DB\OwnerDAO as OwnerDao;
use \Exception as Exception;
use Models\Owner;

class PetDAO /*implements IPetDAO*/
{
    private $connection;
    private $tableName = "Pets";

    function add(Pet $pet)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " 
            (id_pet_owner,id_pet_breed, id_pet_size, name, picture, video, vaccination, id_pet_type)
            VALUES (:ownerId,:breed,:size,:name,:picture,:video,:vaccination,:type);";

            $ownerDAO = new OwnerDAO();

            $parameters["id_pet_owner"] = $ownerDAO->getIdByEmail();
            $parameters["id_pet_breed"] = $pet->getBreed();
            $parameters["id_pet_size"] = $pet->getSize();
            $parameters["name"] = $pet->getName();
            $parameters["picture"] = $pet->getPicture();
            $parameters["video"] = $pet->getVideo();
            $parameters["vaccination"] = $pet->getVaccination();
            $parameters["id_pet_type"] = $pet->getType();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $insertExc) {
            throw $insertExc;
            echo " excepcion en add de ownerdao";
        }
    }

    function getAllDogBreeds()
    {
        try
        {
            $petList= array();
            
            $query = "SELECT * FROM " . "PetBreeds" . " WHERE (id_pet_type = 1);";

            $parameters['id_pet_type'] = 1;
            
            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $breed = new Breed ($row["breed"], $row["id_pet_type"]);
                $breed->setId($row["id"]);

                array_push($ownerList, $breed);
            }
                
        }catch(Exception $ex)
        {
            //throw $ex;
            echo "excepcion en getalldogbreeds";
        }
    }
    
    function getAllCatBreeds(){
        try{
            $breedList = array();
            
            $query = "SELECT * FROM " . "PetBreeds" . "WHERE (id_pet_type = :2);";

            $parameters['id_pet_type'] = 2;

            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $breed = new Breed($row["breed"], $row["id_pet_type"]);
                $breed->setId($row["id"]);

                array_push($breedList, $breed);
            }
            
        }catch(Exception $ex){
            //throw $ex;
            echo " excepcion getallcatbreeds";
        }
    }

    /*
    function getAll()
    {
        try {
            $petList = array();

            $query = "SELECT g.id, g.email, g.pass, g.first_name, g.last_name, g.phone, g.birth_date, g.nickname, g.score, g.first_available_day, g.last_available_day, g.price, ps.size  
            FROM " . $this->tableName  . " AS g 
            LEFT JOIN GuardianXSize AS gxs
            ON g.id = gxs.id_guardian
            LEFT JOIN petsizes AS ps
            ON gxs.id_petsize = ps.id;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $guardian = new Guardian();

                $guardian->setId($row["id"]);
                $guardian->setEmail($row["email"]);
                $guardian->setPassword($row["pass"]);
                $guardian->setFirstName($row["first_name"]);
                $guardian->setLastName($row["last_name"]);
                $guardian->setPhoneNumber($row["phone"]);
                $guardian->setBirthDate($row["birth_date"]);
                $guardian->setScore($row["score"]);
                $guardian->setFirstAvailableDay($row["first_available_day"]);
                $guardian->setLastAvailableDay($row["last_available_day"]);
                $guardian->setPrice($row["price"]);
                $guardian->setPetsize($row["size"]);
                $guardian->setNickName($row["nickname"]);
                $guardian->setType("G");

                array_push($guardianList, $guardian);
            }

            return count($guardianList) > 0 ? $guardianList : null;
        } catch (Exception $ex) {
            throw $ex;
            echo "excepcion en getAll";
        }
    }

    function getByPetName($petName)
    {
        $this->loadData();

        $pets = array_filter($this->petList, function ($pet) use ($petName) {
            return $pet->getName() == $petName;
        });

        $pets = array_values($pets);

        return (count($pets) > 0) ? $pets[0] : null;
    }

       public function getPetsByOwnerEmail($email) 
      {
        $this->loadData();
        $pets = array();
        foreach($this->petList as $pet) 
        {
          if($pet->getOwnerEmail() == $email)
          {
            array_push($pets,$pet); 
          }
        }
       return $pets; 
      }
      
      public function getDogsByOwnerEmail($email)
      {
        $this->loadData();
        $dogs = array();

        foreach ($this->petList as $pet) {
            if ($pet->getOwnerEmail() == $email && $pet->getType() == "D") {
                array_push($dogs, $pet);
            }
        }
        return $dogs;
       }

      public function getCatsByOwnerEmail($email)
      {
        $this->loadData();
        $cats = array();

        foreach ($this->petList as $pet) {
            if ($pet->getOwnerEmail() == $email && $pet->getType() == "C") {
                array_push($cats, $pet);
            }
        }
        return $cats;
       }
     
    
        /*    
        function remove($id)
        {
            $this->loadData();

            $pets = array_filter($this->petList, function ($pet) use ($petName) {
                return $pet->getId() == $id;
            });

            $this->saveData();
        }
        
        */
}