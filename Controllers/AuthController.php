<?php

namespace Controllers;

use models\User as User;
use models\Owner as Owner;
use models\Guardian as Guardian;
use DB\OwnerDAO as OwnerDAO;
//use JSON\OwnerDAO as OwnerDAO;
use DB\GuardianDAO as GuardianDAO;
//use JSON\GuardianDAO as GuardianDAO;

class AuthController
{
    private $guardianDAO;
    private $ownerDAO;

    function __construct()
    {
        $this->guardianDAO = new GuardianDAO();
        $this->ownerDAO = new OwnerDAO();
    }

    public function login($email = "", $password = "")
    {
        if ($email == "" || $password == "") {
            require_once(VIEWS_PATH . "login.php");
        } else {


            $guardianDAO = new GuardianDAO();
            $guardian = new Guardian();
            $guardian = $this->guardianDAO->getByEmail($email);

            $ownerDAO = new OwnerDAO();
            $owner = new Owner();
            $owner = $this->ownerDAO->getByEmail($email);

            if ($guardian != null) {

                if ($guardian->getPassword() == $password) {

                    $_SESSION['loggeduser'] = $guardian;
                    $_SESSION['id'] = $guardian->getId();
                    $_SESSION['email'] = $guardian->getEmail();
                    $_SESSION['type'] = $guardian->getType();
                    header("Location:" . FRONT_ROOT . "Auth");
                } else {
                    require_once(VIEWS_PATH . "login.php");
                }
            } else if ($owner != null) {

                if ($owner->getPassword() == $password) {

                    $_SESSION['loggeduser'] = $owner;
                    $_SESSION['email'] = $owner->getEmail();
                    $_SESSION['type'] = $owner->getType();
                    $_SESSION['id'] = $owner->getId();
                    header("Location:" . FRONT_ROOT . "Auth");
                } else {
                    require_once(VIEWS_PATH . "login.php");
                }
            } else {
                require_once(VIEWS_PATH . "login.php");
            }
        }
    }

    public function showLandingPage($type)
    {
        if ($type == 'G') {
            require_once(VIEWS_PATH . "landingPageGuardian.php");
        } else if ($type == 'O') {
            require_once(VIEWS_PATH . "landingPageOwner.php");
        }
    }

    public function Logout()
    {
        session_destroy();
        require_once(VIEWS_PATH . "login.php");
    }

    public function Index()
    {
        if (isset($_SESSION["loggeduser"])) {
            $this->showLandingPage($_SESSION["type"]);
        } else {
            $this->login();
        }
    }
}
