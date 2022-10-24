<?php

namespace Controllers;

use Models\Pet as Pet;
use Models\Dog as Dog;
use Models\Cat as Cat;
use DAO\DogDAO as DogDAO;
use Dao\CatDAO as CatDAO;
use Controllers\AuthController as AuthController;

class PetController
{

    private $DogDAO;
    private $CatDAO;

    public function __construct()
    {
        $this->DogDAO = new DogDAO();
        $this->CatDAO = new CatDAO();
    }

    public function addPet($petName = " ", $pictureURL = " ", $breed = " ", $video = " ", $vaccination = " ", $type = " ", $size = " ")
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {
                if ($petName != " " || $pictureURL != " " || $breed != " " || $video != " " || $vaccination != " " || $type != " ") {

                    // Si manda size, es un perro
                    if ($size != "Submit") {
                        $dog = new Dog();

                        $dog->setName($petName);
                        $dog->setPicture($pictureURL);
                        $dog->setBreed($breed);
                        $dog->setVideo($video);
                        $dog->setVaccination($vaccination);
                        $dog->setType($type);
                        $dog->setSize($size);
                        $dog->setOwnerEmail($_SESSION['email']);

                        $this->DogDAO->add($dog);
                        header("Location:" . FRONT_ROOT . "User");
                    } else {
                        $cat = new Cat();

                        $cat->setName($petName);
                        $cat->setPicture($pictureURL);
                        $cat->setBreed($breed);
                        $cat->setVideo($video);
                        $cat->setVaccination($vaccination);
                        $cat->setType($type);
                        $cat->setOwnerEmail($_SESSION['email']);

                        $this->CatDAO->add($cat);
                        header("Location:" . FRONT_ROOT . "User");
                    }
                } else {
                    require_once(VIEWS_PATH . "addPet.php");
                }
            } else {
                require_once(VIEWS_PATH . "landingPageGuardian.php");
            }
        } else {
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function listPets()
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {

                $dogsList = $this->listDogs();
                $catsList = $this->listCats();
                $petList[0] = $dogsList;
                $petList[1] = $catsList;

                require_once(VIEWS_PATH . "petList.php");
            } else {
                require_once(VIEWS_PATH . "landingPageOwner.php");
            }
        } else {
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function listDogs()
    {
        $dogsList = array();
        $dogsList = $this->DogDAO->getDogsByOwnerEmail($_SESSION['email']);

        return $dogsList;
    }

    public function listCats()
    {
        $catsList = array();
        $catsList = $this->CatDAO->getCatsByOwnerEmail($_SESSION['email']);

        return $catsList;
    }

    public function Index()
    {
        if (isset($_SESSION["loggeduser"])) {
            if ($_SESSION['type'] == "O") {
                $this->listPets();
            } else {
                require_once(VIEWS_PATH . "landingPageGuardian.php");
            }
        } else {
            require_once(VIEWS_PATH . "login.php");
        }
    }
}