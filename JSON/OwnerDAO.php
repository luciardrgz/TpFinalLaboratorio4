<?php 
namespace JSON;
use DAOInterfaces\IOwnerDAO as IOwnerDAO;
use Models\Owner as Owner;

class OwnerDAO implements IOwnerDAO
{
    private $ownerList = array();
    private $fileName = ROOT . "Data/Owners.json";
    private $maxid;

    function add(Owner $owner)
    {
        $this->loadData();

        $this->maxId++;
        $owner->setId($this->maxId);

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

        $flag=false;
        $found = new Owner();

        foreach($this->ownerList as $owner){
            if($owner->getEmail() == $email){
                $found = $owner;
                $flag=true;
            }
        }
        if($flag==false){
            return null;
        }else{
            return $found;
        }  
    }
    
    private function loadData()
    {
        $this->ownerList = array();
        $this->maxId=0;

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $owner = new Owner($content["firstName"],$content["lastName"],$content["email"],$content["phoneNumber"],$content["birthDate"],$content["nickName"],$content["password"]);
                $this->maxId++;
                $owner->setId($this->maxId);
                array_push($this->ownerList, $owner);
            }
        }
    }

    function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->ownerList as $owner) {
            $valuesArray = array();
            $valuesArray["id"] = $owner->getId();
            $valuesArray["firstName"] = $owner->getFirstName();
            $valuesArray["lastName"] = $owner->getLastName();
            $valuesArray["email"] = $owner->getEmail();
            $valuesArray["phoneNumber"] = $owner->getPhoneNumber();
            $valuesArray["birthDate"] = $owner->getBirthDate();
            $valuesArray["nickName"] = $owner->getNickName();
            $valuesArray["password"] = $owner->getPassword();
            $valuesArray["type"] = $owner->getType();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }
}