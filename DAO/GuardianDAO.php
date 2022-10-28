<?php

namespace DD;

use DAO\IGuardianDao as IGuardianDao;
use Models\Guardian as Guardian;

class GuardianDAO /*implements IGuardianDAO*/
{
    private $guardianList = array();
    private $fileName = ROOT . "Data/Guardians.json";

    function add(Guardian $guardian)
    {
        $this->loadData();

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

    function updateDate($email, $firstDay,$lastDay){
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

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $guardian = new Guardian();
                $guardian->setFirstName($content["firstname"]);
                $guardian->setLastName($content["lastname"]);
                $guardian->setEmail($content["email"]);
                $guardian->setPhoneNumber($content["phonenumber"]);
                $guardian->setBirthDate($content["birthdate"]);
                $guardian->setNickName($content["nickname"]);
                $guardian->setPassword($content["password"]);
                $guardian->setPetsize($content["petSize"]);
                $guardian->setAvailability($content['availability']);
                $guardian->setType($content["type"]);


                array_push($this->guardianList, $guardian);
            }
        }
    }

    function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->guardianList as $guardian) {
            $valuesArray = array();
            $valuesArray["firstname"] = $guardian->getFirstName();
            $valuesArray["lastname"] = $guardian->getLastName();
            $valuesArray["email"] = $guardian->getEmail();
            $valuesArray["nickname"] = $guardian->getNickName();
            $valuesArray["phonenumber"] = $guardian->getPhoneNumber();
            $valuesArray["birthdate"] = $guardian->getBirthDate();
            $valuesArray["password"] = $guardian->getPassword();
            $valuesArray["petSize"] = $guardian->getPetsize();
            $valuesArray["availability"] = $guardian->getAvailability();
            $valuesArray["type"] = $guardian->getType();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }
}

?>