<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use Controllers\UserController as UserController;
use Controllers\HomeController as HomeController;
use Models\Guardian as Guardian;
use Models\Owner as Owner;
use Models\Pet as Pet;
use Models\Booking as Booking;
use DB\PetDAO as PetDAO;
use DB\BookingDAO as BookingDAO;
use DB\BreedDAO as BreedDAO;
use DB\GuardianDAO as GuardianDAO;
use DB\OwnerDAO as OwnerDAO;
//use JSON\BookingDAO as BookingDAO;
use \Exception as Exception;

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

    public function add($idPetsArray = "", $firstDay = "", $lastDay = "", $guardianId = "", $totalAmount = "")
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {
                if ($idPetsArray != "" && $firstDay != "" && $lastDay != "" && $guardianId != "" && $totalAmount != "") {

                    $myPets = explode(",", $idPetsArray); //transforma un string de ids en array de ids
                    $allPets = $this->passArrayIDTOArrayPets($myPets);// el array de id se convierte a un array de mascotas

                    $booking =  new Booking($allPets, $firstDay, $lastDay, $_SESSION["id"], $guardianId, $totalAmount);

                    $bookingDAO = new BookingDAO();
                    $bookingDAO->add($booking);

                    $message = "You've made a booking with success!";
                    header("location:" . FRONT_ROOT . "User/showLandingPage?message=" . $message);
                } else {
                    $message = "Data loading failed";
                    require_once(VIEWS_PATH . "guardianList.php");
                }
            } else {
                $message = "You have insufficient permits to make a booking";
                header("location:" . FRONT_ROOT . "User/showLandingPage?message=" . $message);
            }
        } else {
            header("location:" . FRONT_ROOT . "Auth");
        }
    }

    public function bookDate($id = '', $firstDay = '', $lastDay = '', $selectedPet = '') // Crea una nueva reserva y hace las respectivas verificaciones
    {
        if (isset($_SESSION['loggeduser'])) {

            $userController = new UserController();
            $petDAO = new PetDAO();
            $guardianDAO = new GuardianDAO();
            $guardian = new Guardian();
            $guardian = $guardianDAO->getById($id);
            $guardianName = $guardian->getFirstName();

            if ($_SESSION['type'] == 'O') {         // Verifica el tipo de usuario
                if ($id != '' && $selectedPet == '') {

                    $petList = array();
                    $petList = $petDAO->getPetsByOwnerId();
                    $breed = $this->getBreedBetweenDates($id, $firstDay, $lastDay);

                    if ($breed == 'EmptyOpt') {
                        $breed = null;
                        require_once(VIEWS_PATH . "petSelection.php");
                    } elseif ($breed == 'DiffBreedsOpt') {
                        $this->showNewBookingDates();
                    } else {
                        require_once(VIEWS_PATH . "petSelection.php");
                    }
                } elseif ($id != '' && $selectedPet != '') {

                    $ArrayPets = array();
                    $ArrayPets = $this->passArrayIDTOArrayPets($selectedPet);
                    $breed = $this->getBreedBetweenDates($id, $firstDay, $lastDay);

                    if ($this->verifyPetBreed($ArrayPets, $breed)) {

                        if ($this->verifyPetSize($ArrayPets, $id)) {

                            if ($this->verifyGuardianAvailability($id, $firstDay, $lastDay)) {

                                $guardian = new Guardian();
                                $guardianDao = new GuardianDAO();
                                $guardian = $guardianDao->getById($id);

                                $idPetsArray = implode(",", $selectedPet);

                                $substraction = date_diff(date_create($firstDay), date_create($lastDay)); // Obtiene los dias que durará el booking
                                $bookingDays = $substraction->format('%a');

                                $totalAmount = $bookingDays * $guardian->getPrice();

                                require_once(VIEWS_PATH . "bookingConfirmation.php");
                            } else {
                                $message = "There are no guardians available on the dates you've selected";
                                header("location:" . FRONT_ROOT . "User/filterGuardianList?firstDay=" . $firstDay . "&lastDay=" . $lastDay . "&message=" . $message);
                            }
                        } else {
                            $message = "The size you've selected isn't the same as the guardian's size preference";
                            header("location:" . FRONT_ROOT . "User/filterGuardianList?firstDay=" . $firstDay . "&lastDay=" . $lastDay . "&message=" . $message);
                        }
                    } else {
                        $message = "You must select pets of the same breed";
                        header("location:" . FRONT_ROOT . "User/filterGuardianList?firstDay=" . $firstDay . "&lastDay=" . $lastDay . "&message=" . $message);
                    }
                }
            } else {
                $userController->showLandingPage($_SESSION['type']);
            }
        } else {
            header("location:" . FRONT_ROOT . "Auth");
        }
    }

    function verifyPetBreed($pets, $breed) 
    {
        $verification = true;

        if ($breed != 'EmptyOpt') {

            $petbreed = $pets[0]->getBreed();
            $i = 0;

            while ($verification == true && count($pets) > $i) {

                if ($petbreed != $pets[$i]->getBreed() || $breed != $pets[$i]->getBreed()) {
                    $verification = false;
                }
                $i++;
            }
        } else {

            $petbreed = $pets[0]->getBreed();

            $i = 0;
            while ($verification == true && count($pets) > $i) {

                if ($petbreed != $pets[$i]->getBreed()) {
                    $verification = false;
                }
                $i++;
            }
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

    public function showGuardianRequests($message = "")
    {
        try {
            if (isset($_SESSION['loggeduser'])) {

                if ($_SESSION['type'] == 'G') {

                    $bookingDAO = new BookingDAO();
                    $bookingDAO->updatePastWaitingBookings($_SESSION['id']);
                    $arrayRequests = $bookingDAO->getRequests($_SESSION['id']);


                    $arrayNickname = array();
                    $ownerDAO =  new OwnerDAO();

                    if ($arrayRequests != null) {
                        foreach ($arrayRequests as $booking) {
                            $nickname = $ownerDAO->getNicknameById($booking->getOwnerId());
                            array_push($arrayNickname, $nickname);
                        }
                    }

                    require_once(VIEWS_PATH . "requests.php");
                } else {
                    $message = "Restricted access";
                    require_once(VIEWS_PATH . "landingPageOwner.php");
                }
            } else {
                $message = "Restricted access";
                header("location:" . FRONT_ROOT . "Auth");
            }
        } catch (Exception $ex) {
            $message = "DATA ERROR";
        }
    }

    function showBookingHistory()
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'G') {
                $bookingDAO = new BookingDAO();

                $bookingDAO->updatePastAcceptedBookings($_SESSION['id']);
                $bookingDAO->updatePastConfirmedBookings($_SESSION['id']);

                $arrayRequests = $bookingDAO->getByIdGuardian($_SESSION['id']);

                $arrayNickname = array();
                $ownerDAO =  new OwnerDAO();

                if ($arrayRequests != null) {
                    foreach ($arrayRequests as $booking) {
                        $nickname = $ownerDAO->getNicknameById($booking->getOwnerId());
                        array_push($arrayNickname, $nickname);
                    }
                }
                require_once(VIEWS_PATH . "bookingHistoryGuardian.php");
            } else {
                require_once(VIEWS_PATH . "landingPageOwner.php");
            }
        } else {
            header("location:" . FRONT_ROOT . "Auth");
        }
    }

    function showMyBookings()
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {

                $bookingDAO = new BookingDAO();
                $guardianDAO = new GuardianDAO();
                $myBookings = $bookingDAO->getByIdOwner($_SESSION['id']);
                $arrayNicknamesGuardian = array();

                if ($myBookings != null) {
                    foreach ($myBookings as $booking) {

                        $nicknameGuardian = ($guardianDAO->getById($booking->getGuardianId()))->getNickName();
                        array_push($arrayNicknamesGuardian, $nicknameGuardian);
                    }
                }

                require_once(VIEWS_PATH . "bookingHistoryOwner.php");
            } else {
                require_once(VIEWS_PATH . "landingPageGuardian.php");
            }
        } else {
            header("location:" . FRONT_ROOT . "Auth");
        }
    }

    function showPaymentView($idBooking, $price)
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {
                $price = ($price / 2);
                require_once(VIEWS_PATH . "payment.php");
            } else {
                require_once(VIEWS_PATH . "landingPageGuardian.php");
            }
        } else {
            header("location:" . FRONT_ROOT . "Auth");
        }
    }


    public function updateStatus($statusId, $idBooking)
    {
        $message = null;
        try {
            if (isset($_SESSION['loggeduser'])) {

                $bookingDAO = new BookingDAO();

                if ($statusId == '2') {

                    $flag = $this->verifyBookingsRequest($idBooking);

                    if ($flag) {
                        $bookingDAO->updateStatus($idBooking, $statusId);
                        $message = 'Booking successfully accepted';
                    } else {
                        $message = "Request's breed doesn't match with the bookings you've already accepted";
                    }
                } else {
                    $bookingDAO->updateStatus($idBooking, $statusId);
                    $message = 'Booking rejected';
                }

                $this->showGuardianRequests($message);
            } else {
                header("location:" . FRONT_ROOT . "Auth");
            }
        } catch (Exception $ex) {
            $message = "DATA ERROR";
        }
    }

    function verifyBookingsRequest($idBooking)
    {
        $flag = true;
        $bookingDAO = new BookingDAO();
        $booking = $bookingDAO->getById($idBooking);

        $breed = $this->getBreedBetweenDates($_SESSION['id'], $booking->getStartDate(), $booking->getEndDate());

        if ($breed != 'EmptyOpt') {
            $flag = $this->verifyPetBreed($booking->getPet(), $breed);
        }

        return $flag;
    }

    public function showNewBookingDates()
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {
                $message = null;
                require_once(VIEWS_PATH . "newBookingDates.php");
            } else {
                require_once(VIEWS_PATH . "landingPageOwner.php");
            }
        } else {
            header("location:" . FRONT_ROOT . "Auth");
        }
    }

    function getBreedBetweenDates($idGuardian, $firstDay, $lastDay)
    {

        $bookingDAO = new BookingDAO();
        $arrayBookings = array();
        $arrayBookings = $bookingDAO->getBookingsBetweenDates($idGuardian, $firstDay, $lastDay);
        $flag = true;
        $toReturn = null;

        $petsArray = array();
        $breedArray = array();

        if ($arrayBookings != null) {

            foreach ($arrayBookings as $booking) {
                $petsArray = $booking->getPet();
                array_push($breedArray, $petsArray[0]->getBreed());
            }

            $breedCompare = $breedArray[0];
            foreach ($breedArray as $breed) {
                if ($breedCompare != $breed) {
                    $flag = false;
                }
            }

            if ($flag == true) {
                $toReturn = $breedCompare; // Si hay una raza dentro de las fechas, es asignada al retorno
            } else {
                $toReturn = 'DiffBreedsOpt'; // Si se intenta agregar una raza distinta a las existentes en los bookings de esas fechas
            }
        } else {
            $toReturn = 'EmptyOpt'; // Si la fecha no esta ocupada por ninguna raza
        }

        return $toReturn;
    }
}
