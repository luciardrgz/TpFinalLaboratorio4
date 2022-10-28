<?php

namespace Controllers;

use Models\Pet as Pet;
use Models\Dog as Dog;
use Models\Cat as Cat;
//use DAO\PetDAO as PetDAO;
use JSON\PetDAO as PetDAO;
use Controllers\AuthController as AuthController;

class PetController
{

    private $DogDAO;
    private $CatDAO;

    public function __construct()
    {
        $this->petDAO = new PetDAO();
    }

    public function addPet($petName = " ", $pictureURL = " ", $breed = " ", $video = " ", $vaccination = " ", $type = " ", $size = " ")
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {
                if ($petName != " " || $pictureURL != " " || $breed != " " || $video != " " || $vaccination != " " || $type != " ") {
                     
                        $pet = new Pet($_SESSION['email'], $petName, $pictureURL, $breed, $video, $vaccination, $type, $size);

                        $this->petDAO->add($pet);
                        header("Location:" . FRONT_ROOT . "User");
                    
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
        $dogsList = $this->petDAO->getDogsByOwnerEmail($_SESSION['email']);

        return $dogsList;
    }

    public function listCats()
    {
        $catsList = array();
        $catsList = $this->petDAO->getCatsByOwnerEmail($_SESSION['email']);

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