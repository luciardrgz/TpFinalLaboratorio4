<?php

namespace Controllers;

use DB\GuardianDAO as GuardianDAO;
//use JSON\GuardianDAO as GuardianDAO;

use DB\OwnerDAO as OwnerDAO;
//use JSON\OwnerDAO as OwnerDAO;

use DB\BookingDAO as BookingDAO;
//use JSON\BookingDAO as BookingDAO;

use Models\Guardian as Guardian;
use Models\Owner as Owner;

use \Exception as Exception;

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

    public function Index()
    {
        if (isset($_SESSION["loggeduser"])) {

            if (isset($_GET['message'])) {
                $message = $_GET['message'];
            }

            $this->showLandingPage($_SESSION["type"]);
        } else {
            header("location:" . FRONT_ROOT . "Auth");
        }
    }

    public function add($firstName = "", $lastName = "", $birthDate = "", $email = "", $phoneNumber = "", $nickName = "", $password = "", $type = "")
    {
        try {
            if ($firstName != "" || $lastName != "" || $birthDate != "" || $email != "" || $phoneNumber != "" || $nickName != "" || $password != "" || $type != "") {
                $auth = new AuthController();

                if ($this->validateUser($email, $nickName) == true) {

                    if ($this->validateAge($birthDate)) {

                        if ($type == 'G') {

                            $guardian = new Guardian($firstName, $lastName, $email, $phoneNumber, $birthDate, $nickName, $password);

                            $this->guardianDAO->add($guardian);
                            $auth->login($email, $password);
                        } else {

                            $owner = new Owner($firstName, $lastName, $email, $phoneNumber, $birthDate, $nickName, $password);

                            $this->ownerDAO->add($owner);
                            $auth->login($email, $password);
                        }
                    } else {
                        $message = "You must be 16 or more to sign up";
                        require_once(VIEWS_PATH . "signUp.php");
                    }
                } else {
                    $message = "This user already exists";
                    require_once(VIEWS_PATH . "signUp.php");
                }
            } else {
                require_once(VIEWS_PATH . "signUp.php");
            }
        } catch (Exception $ex) {
            $message = "DATABASE ERROR WHILE ADDING A NEW USER";
        }
    }

    public function validateUser($email, $nickName)
    {
        try {
            $validation = true;

            $foundGuardianEmail = $this->guardianDAO->getByEmail($email);
            $foundGuardianNickname = $this->guardianDAO->getByNickname($nickName);

            $foundOwnerEmail = $this->ownerDAO->getByEmail($email);
            $foundOwnerNickname = $this->ownerDAO->getByNickname($nickName);


            if ($foundGuardianEmail != null || $foundGuardianNickname != null || $foundOwnerEmail != null || $foundOwnerNickname != null) {
                $validation = false;
            }

            return $validation;
        } catch (Exception $ex) {
            $message = "validateUser DATABASE ERROR";
        }
    }

    public function validateAge($DOB)
    {
        try {
            $validation = true;

            $diff = date_diff(date_create($DOB), date_create(date("Y-m-d")));

            if ($diff->format('%y') < 16) {
                $validation = false;
            }

            return $validation;
        } catch (Exception $ex) {
            $message = "validateAge DATABASE ERROR";
        }
    }

    function showLandingPage($type)
    {
        if (isset($_SESSION['loggeduser'])) {

            if (isset($_GET['message'])) {
                $message = $_GET['message'];
            }
            if ($type == 'G') {
                require_once(VIEWS_PATH . "landingPageGuardian.php");
            } else {
                require_once(VIEWS_PATH . "landingPageOwner.php");
            }
        } else {
            header("location:" . FRONT_ROOT . "Auth");
        }
    }

    public function showProfileInfo()
    {
        $message = null;
        try {
            if (isset($_SESSION['loggeduser'])) {

                if ($_SESSION['type'] == 'O') {
                    $user = new Owner();
                    $user = $this->ownerDAO->getByEmail($_SESSION['email']);
                    require_once(VIEWS_PATH . "profile.php");
                } else if ($_SESSION['type'] == 'G') {
                    $user = new Guardian();
                    $user = $this->guardianDAO->getByEmail($_SESSION['email']);
                    require_once(VIEWS_PATH . "profile.php");
                }
            } else {
                header("location:" . FRONT_ROOT . "Auth");
            }
        } catch (Exception $ex) {
            $message = "showProfileInfo DATABASE ERROR";
        }
    }

    public function filterGuardianList($firstDay, $lastDay, $message = '')
    {
        $message = null;

        try {
            if (isset($_SESSION['loggeduser'])) {
                if ($_SESSION['type'] == 'O') {

                    $today = date("Y-m-d");

                    if ($firstDay <= $lastDay && $firstDay >= $today) {
                        $guardianList = array();
                        $guardianList = $this->guardianDAO->getGuardiansByDate($firstDay, $lastDay);

                        if ($message == '') {
                            $message = null;
                        }

                        $firstDay;
                        $lastDay;

                        require_once(VIEWS_PATH . "guardianList.php");
                    } else {
                        $message = "Please enter a valid date range";
                        require_once(VIEWS_PATH . "newBookingDates.php");
                    }
                } else {
                    require_once(VIEWS_PATH . "landingPageGuardian.php");
                }
            } else {
                header("location:" . FRONT_ROOT . "Auth");
            }
        } catch (Exception $e) {
            $message = "filterGuardianList DATABASE ERROR";
        }
    }

    public function updatePetSizePreference($petSize)
    {
        $message = null;

        try {

            if (isset($_SESSION['loggeduser'])) {
                if ($_SESSION['type'] == 'G') {
                    $user = new Guardian();
                    $this->guardianDAO->update($_SESSION['id'], $petSize);
                    $user = $this->guardianDAO->getByEmail($_SESSION['email']);

                    require_once(VIEWS_PATH . "profile.php");
                } else {
                    require_once(VIEWS_PATH . "landingPageOwner.php");
                }
            } else {
                header("location:" . FRONT_ROOT . "Auth");
            }
        } catch (Exception $ex) {
            $message = "updatePetSizePreference DATABASE ERROR";
        }
    }

    public function updateDate($firstDay, $lastDay)
    {
        $message = null;
        try {
            if (isset($_SESSION['loggeduser'])) {
                if ($_SESSION['type'] == 'G') {
                    $user = new Guardian();

                    if ($firstDay > $lastDay || $firstDay < date("Y-m-d") || $lastDay < date("Y-m-d")) {
                        $message = "The date you've entered is invalid";
                    } else {
                        $this->guardianDAO->updateDate($_SESSION['id'], $firstDay, $lastDay);
                        $message = "Availability date updated successfully";
                    }
                    $user = $this->guardianDAO->getByEmail($_SESSION['email']);
                    require_once(VIEWS_PATH . "profile.php");
                } else {
                    $message = "This feature is only available for guardians";
                    require_once(VIEWS_PATH . "landingPageOwner.php");
                }
            } else {
                header("location:" . FRONT_ROOT . "Auth");
            }
        } catch (Exception $ex) {
            $message = "updateDate DATABASE ERROR";
        }
    }

    public function updatePrice($price)
    {
        $message = null;
        try {
            if (isset($_SESSION['loggeduser'])) {
                if ($_SESSION['type'] == 'G') {
                    $user = new Guardian();

                    $this->guardianDAO->updatePrice($_SESSION['id'], $price);
                    $user = $this->guardianDAO->getByEmail($_SESSION['email']);
                    require_once(VIEWS_PATH . "profile.php");
                } else {
                    require_once(VIEWS_PATH . "landingPageOwner.php");
                }
            } else {
                header("location:" . FRONT_ROOT . "Auth");
            }
        } catch (Exception $ex) {
            $message = "updatePrice DATABASE ERROR";
        }
    }

    public function addScore($idGuardian, $score, $idBooking)
    {
        $message = null;
        try {
            if (isset($_SESSION['loggeduser'])) {
                if ($_SESSION['type'] == 'O') {
                    $this->guardianDAO->addScore($idGuardian, $score);
                    $bookingDAO = new BookingDAO();

                    $bookingDAO->updateStatus($idBooking, "7");
                    $message = "You've rated this guardian succesfully";
                    header("location:" . FRONT_ROOT . "Booking/showMyBookings?message=" . $message);
                } else {
                    require_once(VIEWS_PATH . "landingPageGuardian.php");
                }
            } else {
                header("location:" . FRONT_ROOT . "Auth");
            }
        } catch (Exception $ex) {
            $message = "addScore DATABASE ERROR";
        }
    }
}