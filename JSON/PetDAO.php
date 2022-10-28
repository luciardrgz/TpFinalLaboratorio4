<?php 
namespace JSON;
use DAOInterfaces\IPetDAO as IPetDAO;
use Models\Pet as Pet;

class PetDAO implements IPetDAO{
    private $petList = array();
    private $fileName = ROOT . "Data/Pets.json";
    private $maxId;

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

    private function loadData()
    {
        $this->petList = array();
        $this->maxId=0;

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $pet = new Pet();
                $this->maxId++;

                $pet->setId($this->maxId);
                $pet->setName($content["petName"]);
                $pet->setPicture($content["pictureURL"]);
                $pet->setBreed($content["breed"]);
                $pet->setVideo($content["video"]);
                $pet->setVaccination($content["vaccination"]);
                $pet->setSize($content["size"]);
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
            $valuesArray["size"] = $pet->getSize();
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