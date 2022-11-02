<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use Controllers\UserController as UserController;
use DB\PetDAO as PetDAO;
use DB\BookingDAO as BookingDAO;
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

    public function bookDate($id = '', $selectedPet =  '', $firstDay = '', $lastDay = '')
    {
        if (isset($_SESSION['loggeduser'])) {
            $userController = new UserController();
            $petDAO = new PetDAO();

            if ($_SESSION['type'] == 'O') {

                // Si viene de la guardian list
                if ($id != '' && $selectedPet == '') {
                    //$petList = $petController->listPets();

                    $petList = array();
                    $petList = $petDAO->getPetsByOwnerId();

                    require_once(VIEWS_PATH . "petSelection.php");
                }

                //  Si viene de petSelection
                elseif ($id != ' ' && $selectedPet != ' ') {

                    if ($this->verifyPetSizeAndBreed($selectedPet)) {
                        echo "<br> VARDUMP en BOOKDATE: ";
                        var_dump($selectedPet);
                        $guardianDAO = new GuardianDAO();
                        $availableGuardians = $guardianDAO->getGuardiansByDate($firstDay, $lastDay);
                    } else {
                        echo ("FALLO");
                        require_once(VIEWS_PATH . "guardianList.php");
                    }


                    require_once(VIEWS_PATH . "bookingConfirmation.php");
                }

                // Si no tiene ninguno de los datos para hacer la reserva
                elseif ($id == ' ' && $pets == ' ') {
                    $userController->showGuardianList();
                }
            } else {
                $userController->showLandingPage($_SESSION['type']);
            }
        } else {
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function verifyPetSizeAndBreed($pets)
    {
        echo "<br> VARDUMP en verifyPetSizeAndBreed: ";
        var_dump($pets);

        $verification = true; // 1 dog, 2 cat
        $firstDogSize = null;
        $breed = null;
        $i = 0;

        while ($firstDogSize == null && count($pets) < $i) {
            if ($pets->getType == 1) {
                $firstDogSize = $pets[$i]->getSize();
                $breed = $pets[$i]->getBreed();
            }
            $i++;
        }

        $j = 0;
        while ($verification == true && count($pets) < $j) {
            if ($pets->getType == 1) {
                if ($pets->getSize() != $firstDogSize || $pets->getBreed() != $breed) {
                    $verification = false;
                }
            }
        }

        return  $verification;
    }
}