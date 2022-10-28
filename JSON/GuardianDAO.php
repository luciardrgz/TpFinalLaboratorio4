<?php
namespace JSON;
use DAOInterfaces\IGuardianDao as IGuardianDao;
use Models\Guardian as Guardian;

class GuardianDAO implements IGuardianDAO
{
    private $guardianList = array();
    private $fileName = ROOT . "Data/Guardians.json";
    private $maxId;

    function add(Guardian $guardian)
    {
        $this->loadData();

        $this->maxId++;
        $guardian->setId($this->maxId);

        array_push($this->guardianList, $guardian);

        $this->SaveData();
    }

    function update($email, $petSize){
        $this->loadData();

        foreach($this->guardianList as $guardian) 
        {
          if($guardian->getEmail() == $email)
          {
            $guardian->setPetsize($petSize);
            
            $this->SaveData();
            
            return true;
          }
        }
        return false;
    }

    function updateDate($email, $firstDay, $lastDay){
        $this->loadData();

        foreach($this->guardianList as $guardian) 
        {
          if($guardian->getEmail() == $email)
          {
          
            $guardian->setFirstAvailableDay($firstDay); 
            $guardian->setLastAvailableDay($lastDay); 
            
            $this->SaveData();
            
            return true;
          }
        }
        return false;
    }

    function getAll()
    {
        $this->loadData();

        return $this->guardianList;
    }

    function getByNickname($nickname)
    {
        $this->loadData();

        $guardians = array_filter($this->guardianList, function ($guardian) use ($nickname) {
            return $guardian->getNickname() == $nickname;
        });

        $guardians = array_values($guardians);

        return (count($guardians) > 0) ? $guardians[0] : null;
    }

    function getByEmail($email)
    {
        $this->loadData();

        $flag=false;
        $found = new Guardian();

        foreach($this->guardianList as $guardian){
            if($guardian->getEmail() == $email){
                $found = $guardian;
                $flag=true;
            }
        }
        if($flag==false){
            return null;
        }else{
            return $found;
        }  
    }

    /*
        function remove($code)
        {
            $this->loadData();

            $this->guardianList = array_filter($this->guardianList, function($guardian) use($code){
                return $guardian->getCode() != $code;
            });

            $this->saveData();
        }
        */

    private function loadData()
    {
        $this->guardianList = array();
        $this->maxId=0;

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $guardian = new Guardian($content["firstName"],$content["lastName"],$content["email"],$content["phoneNumber"],$content["birthDate"],$content["nickName"],$content["password"],$content["score"],$content["petSize"],$content["price"],$content["firstAvailableDay"],$content["lastAvailableDay"]);
                $this->maxId++;
                $guardian->setId($this->maxId);
                array_push($this->guardianList, $guardian);
            }
        }
    }

    function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->guardianList as $guardian) {
            $valuesArray = array();
            $valuesArray["id"] = $guardian->getId();
            $valuesArray["firstName"] = $guardian->getFirstName();
            $valuesArray["lastName"] = $guardian->getLastName();
            $valuesArray["email"] = $guardian->getEmail();
            $valuesArray["nickName"] = $guardian->getNickName();
            $valuesArray["phoneNumber"] = $guardian->getPhoneNumber();
            $valuesArray["birthDate"] = $guardian->getBirthDate();
            $valuesArray["password"] = $guardian->getPassword();
            $valuesArray["petSize"] = $guardian->getPetsize();
            $valuesArray["score"] = $guardian->getScore();
            $valuesArray["price"] = $guardian->getPrice();
            $valuesArray["firstAvailableDay"] = $guardian->getFirstAvailableDay();
            $valuesArray["lastAvailableDay"] = $guardian->getLastAvailableDay();
            $valuesArray["type"] = $guardian->getType();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }
}

?>