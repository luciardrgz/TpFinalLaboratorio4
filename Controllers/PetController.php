<?php

namespace Controllers;

use Models\Pet as Pet;
use Models\Dog as Dog;
use Models\Cat as Cat;
use DB\PetDAO as PetDAO;
use DB\OwnerDAO as OwnerDAO;
use DB\BreedDAO as BreedDAO;
//use JSON\PetDAO as PetDAO;
use Controllers\AuthController as AuthController;

class PetController
{
    private $petDAO;
    private $ownerDAO;
    private $breedDAO;

    public function __construct()
    {
        $this->petDAO = new PetDAO();
        $this->ownerDAO = new OwnerDAO();
        $this->breedDAO = new BreedDAO();
    }

    public function addPet($petName = " ", $size = " ", $type = " ", $breed = " ", $pictureURL = " ", $vaccination = " ", $video = " ")
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {
                if ($petName != " " || $pictureURL != " " || $breed != " " || $video != " " || $vaccination != " " || $type != " ") {

                    $pet = new Pet($_SESSION['id'], $petName, $pictureURL, $breed, $video, $vaccination, $type, $size);
                    $this->petDAO->add($pet);

                    header("Location:" . FRONT_ROOT . "User");
                } else {

                    $catBreedsList = $this->breedDAO->getAllCatBreeds();
                    $dogBreedsList = $this->breedDAO->getAllDogBreeds();

                    require_once(VIEWS_PATH . "addPet.php");
                }
            } else {
                require_once(VIEWS_PATH . "landingPageGuardian.php");
            }
        } else {
            header("location:" . FRONT_ROOT . "Auth");
        }
    }

    public function listPets()
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {

                $petList = array();
                $petList = $this->petDAO->getPetsByOwnerId();

                require_once(VIEWS_PATH . "petList.php");
            } else {
                require_once(VIEWS_PATH . "landingPageOwner.php");
            }
        } else {
            header("location:" . FRONT_ROOT . "Auth");
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

    function remove($id)
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {
                $this->petDAO->remove($id);
                header("location:" . FRONT_ROOT . "Pet/listPets");
            } else {
                require_once(VIEWS_PATH . "landingPageOwner.php");
            }
        } else {
            header("location:" . FRONT_ROOT . "Auth");
        }
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
            header("location:" . FRONT_ROOT . "Auth");
        }
    }
}