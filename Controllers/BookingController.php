<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use Controllers\UserController as UserController;
use Models\Guardian as Guardian;
use Models\Pet as Pet;
use Models\Booking as Booking;
use DB\PetDAO as PetDAO;
use DB\BookingDAO as BookingDAO;
use DB\BreedDAO as BreedDAO;
use DB\GuardianDAO as GuardianDAO;
//use JSON\BookingDAO as BookingDAO;

class BookingController
{

    public function Index()
    {
        $auth = new AuthController();
        if (isset($_SESSION["loggeduser"])) {
            $auth->showLandingPage($_SESSION["type"]);
        } else {
            $auth->login();
        }
    }

    public function add($idPetsArray="", $firstDay="", $lastDay="", $guardianId="", $totalAmount="")
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {
                if($idPetsArray !="" && $firstDay !="" && $lastDay !="" && $guardianId !="" && $totalAmount !=""){
               
                $myPets = explode(",", $idPetsArray);
                $allPets = $this->passArrayIDTOArrayPets($myPets);

                $booking =  new Booking($allPets, $firstDay, $lastDay, $_SESSION["id"], $guardianId, $totalAmount);
                var_dump($booking);
                $bookingDAO = new BookingDAO();
                $bookingDAO->add($booking);
                
                $message = "You've succesfully made a booking!";
                }else{
                    $message = "failed data!";
                    require_once(VIEWS_PATH . "GuardianList.php");
                }
            } else {
                require_once(VIEWS_PATH . "Home");
            }
        } else {
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function bookDate($id = '', $firstDay = '', $lastDay = '',$selectedPet =  '')
    {
        if (isset($_SESSION['loggeduser'])) {

            $userController = new UserController();
            $petDAO = new PetDAO();
            
            if ($_SESSION['type'] == 'O') {
                if ($id != '' && $selectedPet == '') {
                    $petList = array();
                    $petList = $petDAO->getPetsByOwnerId();
                    require_once(VIEWS_PATH . "petSelection.php");
                }elseif ($id != '' && $selectedPet != '') {
                    
                    $ArrayPets = array();
                    $ArrayPets = $this->passArrayIDTOArrayPets($selectedPet);

                    if ($this->verifyPetBreed($ArrayPets)) {

                        if ($this->verifyPetSize($ArrayPets, $id)) {
                            
                            if ($this->verifyGuardianAvailability($id, $firstDay, $lastDay)) {

                                $guardian = new Guardian();
                                $guardianDao = new GuardianDAO();
                                $guardian = $guardianDao->getById($id);

                                $idPetsArray = implode(",",$selectedPet);

                                $substraction = date_diff(date_create($firstDay), date_create($lastDay));
                                $bookingDays = $substraction->format('%a');
                                    
                                $totalAmount = $bookingDays * $guardian->getPrice();
                                
                                require_once(VIEWS_PATH . "bookingConfirmation.php");
                            } else {
                                $message = "There are no guardians available on the dates you've selected";
                                header("location:" .FRONT_ROOT . "User/showGuardianList?message");
                            }
                        } else {
                            $message = "The size you've selected isn't the same as the guardian's size preference";
                            header("location:".FRONT_ROOT . "User/showGuardianList?message");
                        }
                    } else {
                        $message = "You must select pets of the same breed";
                        header("location:".FRONT_ROOT . "User/showGuardianList?message");
                    }
                }
            } else {
                $userController->showLandingPage($_SESSION['type']);
            }
        } else {
            require_once(VIEWS_PATH . "login.php");
        }
    }

    function verifyPetBreed($pets)
    {
        $verification = true;
        $petbreed = $pets[0]->getBreed();

        $i = 0;
        while ($verification == true && count($pets) > $i) {

            if ($petbreed != $pets[$i]->getBreed()) {
                $verification = false;
            }
            $i++;
        }

        return $verification;
    }

    function verifyPetSize($pets, $idGuardian)
    {
        $guardian = new Guardian();
        $guardianDAO = new GuardianDAO();
        $verification = true;

        $guardian = $guardianDAO->getById($idGuardian);
        $i = 0;

        while ($verification == true && count($pets) > $i) {
            if ($guardian->getPetsize() != $pets[$i]->getSizeText()) {
                $verification = false;
            }
            $i++;
        }

        return $verification;
    }

    function verifyGuardianAvailability($id, $firstDay, $lastDay)
    {
        $flag = false;

        $guardian = new Guardian();
        $guardianDao = new GuardianDAO();
        $guardian = $guardianDao->getById($id);

        if ($guardian != null) {
            if ($guardian->getFirstAvailableDay() <= $firstDay && $guardian->getLastAvailableDay() >= $lastDay) {
                $flag = true;
            }
        }
        return $flag;
    }

    function passArrayIDTOArrayPets($idArray)
    {
        $petDAO = new PetDAO();
        $pet = new Pet();
        $petsObjects = array();
        $verification = true;

        foreach ($idArray as $id) {
            $pet = $petDAO->getPetById($id);
            array_push($petsObjects, $pet);
        }

        return $petsObjects;
    }
}