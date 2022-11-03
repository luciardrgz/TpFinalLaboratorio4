<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use Controllers\UserController as UserController;
use Models\Guardian as Guardian;
use Models\Pet as Pet;
use DB\PetDAO as PetDAO;
use DB\BookingDAO as BookingDAO;
use DB\BreedDAO;
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

                    $petList = array();
                    $petList = $petDAO->getPetsByOwnerId();

                    require_once(VIEWS_PATH . "petSelection.php");
                }

                //  Si viene de petSelection
                elseif ($id != '' && $selectedPet != '') {
                    if ($this->verifyPetBreed($selectedPet)) {
                        if ($this->verifyPetSize($selectedPet, $id)) {
                            if ($this->verifyGuardianAvailability($id, $firstDay, $lastDay)) {
                                require_once(VIEWS_PATH . "bookingConfirmation.php");
                            } else {
                                echo 'El rango de fechas ingresado no esta disponible para este Guardian';
                            }
                        } else {
                            echo 'El tamaño de tus mascotas deben ser de la preferencia del guardian';
                        }
                    } else {
                        echo 'Se deben enviar mascotas de la misma raza';
                    }
                }

                // Si no tiene ninguno de los datos para hacer la reserva
                elseif ($id == '' && $selectedPet == '') {
                    $userController->showGuardianList();
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
        $petDAO = new PetDAO();
        $pet = new Pet();
        $petsObjects = array();
        $verification = true;

        foreach ($pets as $id) {
            $pet = $petDAO->getPetById($id);
            array_push($petsObjects, $pet);
        }

        $petbreed = $petsObjects[0]->getBreed();

        $i = 0;
        while ($verification == true && count($petsObjects) > $i) {

            if ($petbreed != $petsObjects[$i]->getBreed()) {
                $verification = false;
            }
            $i++;
        }

        return $verification;
    }

    function verifyPetSize($pets, $idGuardian)
    {
        $petDAO = new PetDAO();
        $pet = new Pet();
        $petsObjects = array();
        $guardian = new Guardian();
        $guardianDAO = new GuardianDAO();
        $verification = true;

        foreach ($pets as $id) {
            $pet = $petDAO->getPetById($id);
            array_push($petsObjects, $pet);
        }

        $guardian = $guardianDAO->getById($idGuardian);
        $i = 0;

        while ($verification == true && count($petsObjects) > $i) {
            if ($guardian->getPetsize() != $petsObjects[$i]->getSizeText()) {
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
}