<?php

namespace DAO;

use Models\Cat as Cat;

class CatDAO
{
    private $catList = array();
    private $fileName = ROOT . "Data/Cats.json";
    private $maxId;

    function add(Cat $cat)
    {
        $this->loadData();

        $this->maxId++;
        $cat->setId($this->maxId);

        array_push($this->catList, $cat);

        $this->SaveData();
    }

    function getAll()
    {
        $this->loadData();

        return $this->catList;
    }

    function getByCatName($catName)
    {
        $this->loadData();

        $cats = array_filter($this->catList, function ($cat) use ($catName) {
            return $cat->getName() == $catName;
        });

        $cats = array_values($cats);

        return (count($cats) > 0) ? $cats[0] : null;
    }

    public function getCatsByOwnerEmail($email)
    {
        $this->loadData();
        $cats = array();
        foreach ($this->catList as $cat) {
            if ($cat->getOwnerEmail() == $email) {
                array_push($cats, $cat);
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
        $this->catList = array();
        $this->maxId = 0;

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $cat = new Cat();
                $this->maxId++;

                $cat->setId($this->maxId);
                $cat->setName($content["catName"]);
                $cat->setPicture($content["pictureURL"]);
                $cat->setBreed($content["breed"]);
                $cat->setVideo($content["video"]);
                $cat->setVaccination($content["vaccination"]);
                $cat->setType($content["type"]);
                $cat->setOwnerEmail($content["ownerEmail"]);

                array_push($this->catList, $cat);
            }
        }
    }

    function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->catList as $cat) {

            $valuesArray = array();
            $valuesArray["id"] = $cat->getId();
            $valuesArray["catName"] = $cat->getName();
            $valuesArray["ownerEmail"] = $cat->getOwnerEmail();
            $valuesArray["pictureURL"] = $cat->getPicture();
            $valuesArray["breed"] = $cat->getBreed();
            $valuesArray["video"] = $cat->getVideo();
            $valuesArray["vaccination"] = $cat->getVaccination();
            $valuesArray["type"] = $cat->getType();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }
}