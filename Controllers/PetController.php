<?php
namespace Controllers;

use Models\Pet as Pet;
use DAO\PetDAO as PetDAO;
use Controllers\AuthController as AuthController;

class PetController
{
    public function addPet($petName=" ", $pictureURL =" ", $breed=" ", $video=" ", $vaccination=" ", $type=" ")
    {
        if(isset($_SESSION['loggeduser'])){
        if($_SESSION['type'] == 'O')
        {
            if($petName!=" " || $pictureURL!=" " || $breed!=" " || $video!=" " || $vaccination!=" " || $type!=" ")
            { 
                $pet = new Pet(); // new Dog
                $petDAO = new PetDAO();

                $pet->setName($petName);
                $pet->setPicture($pictureURL);
                $pet->setBreed($breed);
                $pet->setVideo($video);
                $pet->setVaccination($vaccination);
                $pet->setType($type);
                $pet->setOwnerEmail($_SESSION['email']);      

                $petDAO->add($pet);
                require_once(VIEWS_PATH . "landingPageOwner.php");
            }else {
                    require_once(VIEWS_PATH . "addPet.php");
                }
        }else{
            require_once(VIEWS_PATH . "landingPageGuardian.php");
        }   
        }
        else{
            require_once(VIEWS_PATH . "login.php");
        }   
    }


    public function listPets(){

        if(isset($_SESSION['loggeduser'])){
            if($_SESSION['type'] == 'O')
            {
                $petList = array();
                $petDAO = new PetDAO();

                $petList = $petDAO->getPetsByOwnerEmail($_SESSION['email']);

                require_once(VIEWS_PATH . "petList.php");
            }else{
                require_once(VIEWS_PATH . "landingPageOwner.php");
            }   
        }
        else{
            require_once(VIEWS_PATH . "login.php");
        }   
    }

    public function Index(){
        if(isset($_SESSION["loggeduser"]))
        {
            if($_SESSION['type']=="O"){
                $this->listPets(); 
            }else{
                require_once(VIEWS_PATH . "landingPageGuardian.php");
            }
        }else
        {
        require_once(VIEWS_PATH . "login.php");
        }
    }
}
?>