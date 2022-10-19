<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;
use DAO\OwnerDAO as OwnerDAO;
use Models\Guardian as Guardian;
use Models\Owner as Owner;
use Models\Pet as Pet;
use DAO\PetDAO as PetDAO;
use Controllers\AuthController as AuthController;

class UserController
{
    private $guardianDAO;
    private $ownerDAO;

    public function __construct()
    {
        $this->guardianDAO = new GuardianDAO();
        $this->ownerDAO = new OwnerDAO();
    }

    function showLandingPage($type)
    {
        if ($type == 'G')
        {
            require_once(VIEWS_PATH . "landingPageGuardian.php");
        }else
        {
           require_once(VIEWS_PATH . "landingPageOwner.php");
        }
    }

    public function add($firstName=" ", $lastName=" ", $birthdate=" ", $email=" ", $phoneNumber=" ", $nickName=" ", $password=" ", $type=" ")
    {
        if($firstName!=" " || $lastName!=" " || $birthdate!=" " || $email!=" " || $phoneNumber!=" " || $nickName!=" " || $password!=" " || $type!=" ")
        {
            if ($type == 'G') {

                $guardian = new Guardian();

                $guardian->setFirstName($firstName);
                $guardian->setLastName($lastName);
                $guardian->setEmail($email);
                $guardian->setBirthDate($birthdate);
                $guardian->setPhoneNumber($phoneNumber);
                $guardian->setNickName($nickName);
                $guardian->setPassword($password);
                $guardian->setType($type);

                $this->guardianDAO->add($guardian);
                $this->showLandingPage($type);
            } else if ($type == 'O') {

                $owner = new Owner();

                $owner->setFirstName($firstName);
                $owner->setLastName($lastName);
                $owner->setEmail($email);
                $owner->setBirthDate($birthdate);
                $owner->setPhoneNumber($phoneNumber);
                $owner->setNickName($nickName);
                $owner->setPassword($password);
                $owner->setType($type);

                $this->ownerDAO->add($owner);
                $this->showLandingPage($type);
            }
        }else
        {
            require_once(VIEWS_PATH . "login.php");
        }
    }

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
                $this->showLandingPage($_SESSION['type']); //enviar a lista de mascotas
            }else {
                     $this->showLandingPage($_SESSION['type']);
                  }
          }else{
            $this->showLandingPage($_SESSION['type']);
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
            $this->showLandingPage($_SESSION['type']);
            }   
        }
        else{
            require_once(VIEWS_PATH . "login.php");
        }   
   }

    public function showProfileInfo(){
        if(isset($_SESSION['loggeduser'])){
            if($_SESSION['type'] == 'O')
            {
                $user = new Owner();
                $user = $this->ownerDAO->getByEmail($_SESSION['email']);
                require_once(VIEWS_PATH . "profile.php");

            }else if($_SESSION['type'] == 'G')
            {
                $user = new Guardian();
                $user = $this->guardianDAO->getByEmail($_SESSION['email']);
                $availability= $user->getAvailability();
                require_once(VIEWS_PATH . "profile.php");
            }
        }
        else{
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function updatePetSizePreference($petSize){
        if(isset($_SESSION['loggeduser'])){
            if($_SESSION['type'] == 'G')
            {
                    $user = new Guardian();
                    $this->guardianDAO->update($_SESSION['email'], $petSize);
                    $user=$this->guardianDAO->getByEmail($_SESSION['email']);
                    require_once(VIEWS_PATH."profile.php");
            }
            else{
                require_once(VIEWS_PATH."landingPageOwner");
            }
        }
        else{
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function updateDate($availability=" "){
        if(isset($_SESSION['loggeduser'])){
            if($_SESSION['type'] == 'G')
            {
                    $user = new Guardian();
                    $this->guardianDAO->updateDate($_SESSION['email'], $availability);
                    $user=$this->guardianDAO->getByEmail($_SESSION['email']);
                    $availability=$user->getAvailability();
                    require_once(VIEWS_PATH."profile.php");
            }
            else{
                require_once(VIEWS_PATH."landingPageOwner");
            }
        }
        else{
            require_once(VIEWS_PATH . "login.php");
        }
    }
    
}
?>