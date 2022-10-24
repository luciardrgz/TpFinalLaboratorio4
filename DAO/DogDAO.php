<?php 
namespace DAO;

use Models\Dog as Dog;

class DogDAO{
    private $DogList = array();
    private $fileName = ROOT . "Data/Dogs.json";
    private $maxId;

    function add(Dog $dog)
    {
        $this->loadData();

        $this->maxId++;
        $dog->setId($this->maxId);

        array_push($this->DogList, $dog);

        $this->SaveData();
    }

    function getAll()
    {
        $this->loadData();

        return $this->DogList;
    }

    function getByDogName($dogName)
    {
        $this->loadData();

        $dogs = array_filter($this->DogList, function ($dog) use ($dogName) {
            return $dog->getName() == $dogName;
        });

        $dogs = array_values($dogs);

        return (count($dogs) > 0) ? $dogs[0] : null;
    }

       public function getDogsByOwnerEmail($email) 
      {
        $this->loadData();
        $dogs = array();
        foreach($this->DogList as $dog) 
        {
          if($dog->getOwnerEmail() == $email)
          {
            array_push($dogs,$dog); 
          }
        }
       return $dogs; 
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
    private function loadData()
    {
        $this->DogList = array();
        $this->maxId=0;

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $dog = new Dog();
                $this->maxId++;

                $dog->setId($this->maxId);
                $dog->setName($content["dogName"]);
                $dog->setPicture($content["pictureURL"]);
                $dog->setBreed($content["breed"]);
                $dog->setVideo($content["video"]);
                $dog->setVaccination($content["vaccination"]);
                $dog->setType($content["type"]);
                $dog->setOwnerEmail($content["ownerEmail"]);
                $dog->setSize($content["size"]);
                array_push($this->DogList, $dog);
            }
        }
    }

    function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->DogList as $dog) {
            
            $valuesArray = array();
            $valuesArray["id"] = $dog->getId();
            $valuesArray["dogName"] = $dog->getName();
            $valuesArray["ownerEmail"] = $dog->getOwnerEmail();
            $valuesArray["pictureURL"] = $dog->getPicture();
            $valuesArray["breed"] = $dog->getBreed();
            $valuesArray["video"] = $dog->getVideo();
            $valuesArray["vaccination"] = $dog->getVaccination();
            $valuesArray["type"] = $dog->getType();
            $valuesArray["size"] = $dog->getSize();
            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }
}

?>