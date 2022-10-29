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

            /*
            $guardianDAO = new GuardianDAO();
            $guardian = new Guardian();
            $guardian = $this->guardianDAO->getByEmail($email);*/

            $ownerDAO = new OwnerDAO();
            $owner = new Owner();
            $owner = $this->ownerDAO->getByEmail($email);

            /*if ($guardian != null) {
                echo "guardian!=null";
                if ($guardian->getPassword() == $password) {

                    echo "guardian password";
                    $_SESSION['loggeduser'] = $guardian;
                    $_SESSION['email'] = $guardian->getEmail();
                    $_SESSION['type'] = $guardian->getType();
                    header("Location:" . FRONT_ROOT . "Auth");
                    
                } else {
                    require_once(VIEWS_PATH . "login.php");
                }
            } else */if ($owner != null) {
                echo "owner!=null";
                if ($owner->getPassword() == $password) {
                    echo "owner password";
                    $_SESSION['loggeduser'] = $owner;
                    $_SESSION['email'] = $owner->getEmail();
                    $_SESSION['type'] = $owner->getType();
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