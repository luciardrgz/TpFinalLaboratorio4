<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use Models\Guardian as Guardian;
use Models\Pet as Pet;
use Models\Booking as Booking;
use Models\Coupon as Coupon;
use DB\PetDAO as PetDAO;
use DB\BookingDAO as BookingDAO;
use DB\GuardianDAO as GuardianDAO;
use DB\OwnerDAO as OwnerDAO;
use DB\CouponDAO as CouponDAO;
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
        try {
            if (isset($_SESSION['loggeduser'])) {
                if ($_SESSION['type'] == 'O') {
                    if ($idPetsArray != "" && $firstDay != "" && $lastDay != "" && $guardianId != "" && $totalAmount != "") {

                        $myPets = explode(",", $idPetsArray); // Transforma un string de ids en array de ids
                        $allPets = $this->passArrayIDTOArrayPets($myPets); // El array de ids se convierte a un array de mascotas

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
                $message = "Restricted access";
                header("location:" . FRONT_ROOT . "Auth");
            }
        } catch (Exception $ex) {
            $message = "DATA ERROR WHILE ADDING A PET";
        }
    }

    public function bookDate($id = '', $firstDay = '', $lastDay = '', $selectedPet = '') // Crea una nueva reserva y hace las respectivas verificaciones
    {
        try {
            if (isset($_SESSION['loggeduser'])) {

                $petDAO = new PetDAO();
                $guardianDAO = new GuardianDAO();
                $guardian = new Guardian();
                $guardian = $guardianDAO->getById($id);
                $guardianName = $guardian->getFirstName();
                $size = $guardian->getPetsize();

                if ($_SESSION['type'] == 'O') {
                    // Si viene de elegir un guardian sin seleccionar pets (desde filterGuardianList)
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
                    }

                    // Si viene con un guardian y pets seleccionadas (desde petSelection)
                    elseif ($id != '' && $selectedPet != '') {

                        $ArrayPets = array();
                        $ArrayPets = $this->passArrayIDTOArrayPets($selectedPet); // El array de ids se pasa a array de pets
                        $breed = $this->getBreedBetweenDates($id, $firstDay, $lastDay); // Obtiene la raza de los bookings del guardian seleccionada entre las fechas seleccionadas

                        if ($this->verifyPetBreed($ArrayPets, $breed)) {

                            if ($this->verifyPetSize($ArrayPets, $id)) {

                                if ($this->verifyGuardianAvailability($id, $firstDay, $lastDay)) {

                                    $guardian = new Guardian();
                                    $guardianDao = new GuardianDAO();
                                    $guardian = $guardianDao->getById($id);

                                    $idPetsArray = implode(",", $selectedPet); // Transforma el array de las pets seleccionadas en un string de sus ids

                                    $substraction = date_diff(date_create($firstDay), date_create($lastDay)); // Obtiene los dias que durará el booking
                                    $bookingDays = $substraction->format('%a');

                                    $totalAmount = $bookingDays * $guardian->getPrice(); // Obtiene el precio en base a los días que durará
                                    require_once(VIEWS_PATH . "bookingConfirmation.php");
                                } else {
                                    $message = "There are no guardians available on the dates you've selected";
                                    header("location:" . FRONT_ROOT . "User/filterGuardianList?firstDay=" . $firstDay . "&lastDay=" . $lastDay . "&message=" . $message);
                                }
                            } else {
                                $message = "One of more of the pets you've selected haven't the same size as the guardian's size preference";
                                header("location:" . FRONT_ROOT . "User/filterGuardianList?firstDay=" . $firstDay . "&lastDay=" . $lastDay . "&message=" . $message);
                            }
                        } else {
                            $message = "You must select pets of the same breed";
                            header("location:" . FRONT_ROOT . "User/filterGuardianList?firstDay=" . $firstDay . "&lastDay=" . $lastDay . "&message=" . $message);
                        }
                    }
                } else {
                    $message = "You have insufficient permits to make a booking";
                    header("location:" . FRONT_ROOT . "User/showLandingPage?message=" . $message);
                }
            } else {
                $message = "Restricted access";
                header("location:" . FRONT_ROOT . "Auth");
            }
        } catch (Exception $ex) {
            $message = "DATA ERROR WHILE MAKING A NEW BOOKING";
        }
    }

    function verifyPetBreed($pets, $breed)
    {
        $verification = true;

        // Si en las fechas seleccionadas el guardian ya cuida una raza de pet
        if ($breed != 'EmptyOpt') {

            $petbreed = $pets[0]->getBreed(); // Se obtiene la raza de la 1° que haya en los bookings del guardian en las fechas seleccionadas
            $i = 0;

            while ($verification == true && count($pets) > $i) {

                // Si una de las pets seleccionadas no condice con la raza que cuida el guardian en esas fechas
                if ($petbreed != $pets[$i]->getBreed() || $breed != $pets[$i]->getBreed()) {
                    $verification = false;
                }
                $i++;
            }
        }

        // Si en las fechas seleccionadas el guardian no tiene una raza de pet asignada para cuidar
        else {

            $petbreed = $pets[0]->getBreed(); // TODO: sacar estas dos lineas afuera para evitar repetir código
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
        try {
            $guardian = new Guardian();
            $guardianDAO = new GuardianDAO();
            $verification = true;

            $guardian = $guardianDAO->getById($idGuardian);
            $i = 0;

            while ($verification == true && count($pets) > $i) {

                // Si el tamaño de pet que cuida el guardian es distinto a un tamaño enviado en la seleccion de pets
                if ($guardian->getPetsize() != $pets[$i]->getSizeText()) {
                    $verification = false;
                }
                $i++;
            }
            return $verification;
        } catch (Exception $ex) {
            $message = "verifyPetSize DATA ERROR";
        }
    }

    function verifyGuardianAvailability($id, $firstDay, $lastDay)
    {
        try {
            $flag = false;

            $guardian = new Guardian();
            $guardianDao = new GuardianDAO();
            $guardian = $guardianDao->getById($id);

            if ($guardian != null) {

                // Si las fechas de disponibilidad del guardian coinciden con dias seleccionados 
                if ($guardian->getFirstAvailableDay() <= $firstDay && $guardian->getLastAvailableDay() >= $lastDay) {
                    $flag = true;
                }
            }
            return $flag;
        } catch (Exception $ex) {
            $message = "verifyGuardianAvailability DATA ERROR";
        }
    }

    // Verifica que la raza de la booking que el guardian desea aceptar condiga con las que ya tiene en esas fechas (si es que tiene)
    function verifyBookingsRequest($idBooking)
    {
        try {
            $flag = true;
            $bookingDAO = new BookingDAO();
            $booking = $bookingDAO->getById($idBooking);

            $breed = $this->getBreedBetweenDates($_SESSION['id'], $booking->getStartDate(), $booking->getEndDate());

            if ($breed != 'EmptyOpt') {
                $flag = $this->verifyPetBreed($booking->getPet(), $breed);
            }
            return $flag;
        } catch (Exception $ex) {
            $message = "verifyBookingsRequest DATA ERROR";
        }
    }

    function passArrayIDTOArrayPets($idArray)
    {
        try {
            $petDAO = new PetDAO();
            $pet = new Pet();
            $petsObjects = array();
            $verification = true;

            foreach ($idArray as $id) {
                $pet = $petDAO->getPetById($id);
                array_push($petsObjects, $pet);
            }

            return $petsObjects;
        } catch (Exception $ex) {
            $message = "passArrayIDTOArrayPets DATA ERROR";
        }
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
            $message = "showGuardianRequests DATA ERROR";
        }
    }

    // Muestra el booking history de un Guardian
    function showBookingHistory()
    {
        try {
            if (isset($_SESSION['loggeduser'])) {
                if ($_SESSION['type'] == 'G') {
                    $bookingDAO = new BookingDAO();

                    // Cada vez que el guardian quiera ver su history, se actualiza el status cualquier booking pasado
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
        } catch (Exception $ex) {
            $message = "showBookingHistory DATA ERROR";
        }
    }

    // Muestra el booking history de un Owner
    function showMyBookings()
    {
        try {
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
        } catch (Exception $ex) {
            $message = "showMyBookings DATA ERROR";
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

    public function updateStatus($statusId, $idBooking)
    {
        $message = null;
        try {
            if (isset($_SESSION['loggeduser'])) {

                $bookingDAO = new BookingDAO();

                if ($statusId == '2') {

                    $flag = $this->verifyBookingsRequest($idBooking);

                    // Las razas del booking que el guardian quiere aceptar coinciden con las que ya cuida en esas fechas / El guardian no cuidaba de una raza en esas fechas 
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

    function getBreedBetweenDates($idGuardian, $firstDay, $lastDay)
    {
        try {
            $bookingDAO = new BookingDAO();
            $arrayBookings = array();
            $arrayBookings = $bookingDAO->getBookingsBetweenDates($idGuardian, $firstDay, $lastDay);
            $flag = true;
            $toReturn = null;

            $petsArray = array();
            $breedArray = array();

            // Si hay bookings en las fechas seleccionadas
            if ($arrayBookings != null) {

                // Se pasan las razas de esos bookings a breedArray
                foreach ($arrayBookings as $booking) {
                    $petsArray = $booking->getPet();
                    array_push($breedArray, $petsArray[0]->getBreed());
                }

                $breedCompare = $breedArray[0];


                foreach ($breedArray as $breed) {
                    if ($breedCompare != $breed) {
                        $flag = false;             // Si alguna raza seleccionada no coincide con las que el guardian cuida en esas fechas
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
        } catch (Exception $ex) {
            $message = "getBreedBetweenDates DATA ERROR";
        }
    }

    function confirmBooking($statusId, $idBooking, $price)
    {
        try {
            $bookingController = new BookingController();
            $bookingController->updateStatus($statusId, $idBooking);

            $coupon = new Coupon($price, $idBooking);
            $couponDAO = new CouponDAO();
            $couponDAO->add($coupon);

            $mailController = new MailController();
            $mailController->sendMail($price);

            $message = "Payment details were sent to your email. Check it out!";
        } catch (Exception $ex) {
            $message = "confirmBooking DATA ERROR";
        }
    }
}