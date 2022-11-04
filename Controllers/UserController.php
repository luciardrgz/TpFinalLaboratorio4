<?php

namespace Controllers;

use DB\GuardianDAO as GuardianDAO;
//use JSON\GuardianDAO as GuardianDAO;

use DB\OwnerDAO as OwnerDAO;
//use JSON\OwnerDAO as OwnerDAO;

use DB\PetDAO as PetDAO;
//use JSON\PetDAO as PetDAO;

use Models\Guardian as Guardian;
use Models\Owner as Owner;
use Models\Pet as Pet;
use Models\Alert as Alert;
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
            $this->showLandingPage($_SESSION["type"]);
        } else {
            require_once(VIEWS_PATH . "login.php");
        }
    }

    function showLandingPage($type)
    {
        if ($type == 'G') {
            require_once(VIEWS_PATH . "landingPageGuardian.php");
        } else {
            require_once(VIEWS_PATH . "landingPageOwner.php");
        }
    }

    function showBookingHistoryPage($type)
    {
        if ($type == 'G') {
            require_once(VIEWS_PATH . "bookingHistoryGuardian.php");
        } else {
            require_once(VIEWS_PATH . "landingPageOwner.php");
        }
    }

    public function showGuardianList()
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'O') {
                $guardianList = array();
                $guardianList = $this->guardianDAO->getAll();

                $message =$this->getErrorMsg();

                require_once(VIEWS_PATH . "guardianList.php");
            } else {
                require_once(VIEWS_PATH . "landingPageGuardian.php");
            }
        } else {
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function getErrorMsg()
    {
        $errorMsg = null;

        if (isset($_GET['message'])) {
            $errorMsg = $_GET['message'];
        } 

        return $errorMsg;
    }

    public function showProfileInfo()
    {
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
            require_once(VIEWS_PATH . "login.php");
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
                        $message = "Usuario ingresado correctamente";
                    } else {
                        $message = "El usuario es menor a 16 años";
                        require_once(VIEWS_PATH . "signUp.php");
                    }
                } else {
                    $message = "Este usuario ya existe";
                    require_once(VIEWS_PATH . "signUp.php");
                }
            } else {
                require_once(VIEWS_PATH . "signUp.php");
            }
        } catch (Exception $exc) {
            $message = $exc->getMessage();
            require_once(VIEWS_PATH . "signUp.php");
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
            throw $ex;
            echo "excepcion en validateuser de usercontroller";
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
        } catch (Exception $exc) {
            throw $exc;
            echo "excepcion en validateage de usercontroller";
        }
    }

    public function updatePetSizePreference($petSize)
    {
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
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function updateDate($firstDay, $lastDay)
    {
        if (isset($_SESSION['loggeduser'])) {
            if ($_SESSION['type'] == 'G') {
                $user = new Guardian();
                if ($firstDay > $lastDay) {
                } else {
                    $this->guardianDAO->updateDate($_SESSION['id'], $firstDay, $lastDay);
                }
                $user = $this->guardianDAO->getByEmail($_SESSION['email']);
                require_once(VIEWS_PATH . "profile.php");
            } else {
                require_once(VIEWS_PATH . "landingPageOwner.php");
            }
        } else {
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function updatePrice($price)
    {
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
            require_once(VIEWS_PATH . "login.php");
        }
    }
}