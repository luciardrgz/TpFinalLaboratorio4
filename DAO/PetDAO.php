<?php 
namespace DAO;

use Models\Pet as Pet;

class PetDAO{
    private $petList = array();
    private $fileName = ROOT . "Data/Pets.json";
    private $maxId = 0;

    function add(Pet $pet)
    {
        $this->loadData();

        $this->maxId++;
        $pet->setId($this->maxId);

        array_push($this->petList, $pet);

        $this->SaveData();
    }

    function getAll()
    {
        $this->loadData();

        return $this->petList;
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

    /*
    function getPetsByOwnerEmail($email)
    {
        $this->loadData();
        $pet= new Pet();

        $pet = array_filter($this->petList, function ($pet) use ($email) {
            return $pet->getOwnerEmail() == $email;
        });

        $pets = array_values($pets);

        return (count($pets) > 0) ? $pets[0] : null;
    }*/

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
        $this->petList = array();
        $maxId=0;

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $pet = new Pet();
                $maxId++;

                $pet->setId($maxId);
                $pet->setName($content["petName"]);
                $pet->setPicture($content["pictureURL"]);
                $pet->setBreed($content["breed"]);
                $pet->setVideo($content["video"]);
                $pet->setVaccination($content["vaccination"]);
                $pet->setType($content["type"]);
                $pet->setOwnerEmail($content["ownerEmail"]);

                array_push($this->petList, $pet);
            }
        }
    }

    function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->petList as $pet) {
            
            $valuesArray = array();
            $valuesArray["id"] = $pet->getId();
            $valuesArray["petName"] = $pet->getName();
            $valuesArray["ownerEmail"] = $pet->getOwnerEmail();
            $valuesArray["pictureURL"] = $pet->getPicture();
            $valuesArray["breed"] = $pet->getBreed();
            $valuesArray["video"] = $pet->getVideo();
            $valuesArray["vaccination"] = $pet->getVaccination();
            $valuesArray["type"] = $pet->getType();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }
}

?>