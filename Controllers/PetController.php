<?php

namespace Controllers;

use Models\Pet as Pet;
use DB\PetDAO as PetDAO;
//use JSON\PetDAO as PetDAO;
use DB\OwnerDAO as OwnerDAO;
use DB\BreedDAO as BreedDAO;
use Exceptions\DuplicatedValueException as DuplicatedValueException;
use Exception as Exception;
use PDOException as PDOException;

class PetController
{
    private $petDAO;
    private $ownerDAO;
    private $breedDAO;
    private $auth;

    public function __construct()
    {
        $this->petDAO = new PetDAO();
        $this->ownerDAO = new OwnerDAO();
        $this->breedDAO = new BreedDAO();
        $this->auth = new AuthController();
    }

    public function addPet($petName = " ", $size = " ", $type = " ", $breed = " ", $pictureURL = " ", $vaccination = " ", $video = " ")
    {
        $message = null;
        try {
            if (isset($_SESSION['loggeduser'])) {
                if ($_SESSION['type'] == 'O') {

                    $catBreedsList = $this->breedDAO->getAllCatBreeds();
                    $dogBreedsList = $this->breedDAO->getAllDogBreeds();
                    
                    if ($petName != " " || $pictureURL != " " || $breed != " " || $video != " " || $vaccination != " " || $type != " ") {

                        $pet = new Pet($_SESSION['id'], $petName, $pictureURL, $breed, $video, $vaccination, $type, $size);
                        $this->petDAO->add($pet);
                        $message = "You've added a pet successfully!";
                        header("Location:" . FRONT_ROOT . "User?message=" . $message);
                        
                    } else {
                        require_once(VIEWS_PATH . "addPet.php");
                    }
                } else {
                    require_once(VIEWS_PATH . "landingPageGuardian.php");
                }
            } else {
                header("location:" . FRONT_ROOT . "Auth");
            }
            
        } catch(DuplicatedValueException $ex){
            $message = $ex->getMsg();
            require_once(VIEWS_PATH . "addPet.php");
        } catch (Exception $ex) {
                $message = "DATABASE ERROR WHILE ADDING A NEW PET";
                $this->auth->Logout($message);
        }
    }

    public function listPets()
    {
        try {
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
        } catch (Exception $ex) {
            $message = "DATABASE ERROR WHILE LISTING PETS";
            $this->auth->Logout($message);
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