<?php 

namespace DAO;
use Models\Owner as Owner;

class OwnerDAO{
    private $ownerList = array();
    private $fileName = ROOT . "Data/Owners.json";

    function add(Owner $owner)
    {
        $this->loadData();

        array_push($this->ownerList, $owner);

        $this->saveData();
    }

    function getAll()
    {
        $this->loadData();

        return $this->ownerList;
    }

    function getByNickname($nickname)
    {
        $this->loadData();

        $owners = array_filter($this->ownerList, function ($owner) use ($nickname) {
            return $owner->getNickname() == $nickname;
        });

        $owners = array_values($owners);

        return (count($owners) > 0) ? $owners[0] : null;
    }

    function getByEmail($email)
    {
        $this->loadData();

        $owners = array_filter($this->ownerList, function ($owner) use ($email) {
            return $owner->getEmail() == $email;
        });

        $owners = array_values($owners);

        return (count($owners) > 0) ? $owners[0] : null;
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
        $this->ownerList = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $owner = new Owner();
                $owner->setFirstName($content("firstname"));
                $owner->setLastName($content["lastname"]);
                $owner->setEmail($content["email"]);
                $owner->setPhoneNumber($content["phonenumber"]);
                $owner->setBirthDate($content["birthdate"]);
                $owner->setNickName($content["nickname"]);
                $owner->setPassword($content["password"]);
                $owner->setType($content["type"]);

                array_push($this->ownerList, $owner);
            }
        }
    }

    function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->guardianList as $owner) {
            $valuesArray = array();
            $valuesArray["firstname"] = $owner->getFirstName();
            $valuesArray["lastname"] = $owner->getLastName();
            $valuesArray["email"] = $owner->getEmail();
            $valuesArray["phonenumber"] = $owner->getPhoneNumber();
            $valuesArray["birthdate"] = $owner->getBirthDate();
            $valuesArray["password"] = $owner->getPassword();
            $valuesArray["type"] = $owner->getType();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }
}