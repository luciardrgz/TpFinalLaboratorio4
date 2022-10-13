<?php

namespace Controllers;

use Model\User as User;
use Models\Owner as Owner;
use Models\Guardian as Guardian;
use DAO\UserDAO as UserDAO;
use DAO\GuardianDAO as GuardianDAO;
use DAO\OwnerDAO as OwnerDAO;


class AuthController
{
    private $guardianDAO;
    private $ownerDAO;

    function __construct()
    {
        $this->guardianDAO = new GuardianDAO();
        $this->ownerDAO = new OwnerDAO();
    }

    public function login($email, $password)
    {
        if ($email == null || $password == null) {
            require_once(VIEWS_PATH . "login.php");
        } else {

            $guardianDAO = new GuardianDAO();
            $guardianDAO = $this->guardianDAO->getByEmail($email);

            $ownerDAO = new OwnerDAO();
            $ownerDAO = $this->ownerDAO->getByEmail($email);

            if ($guardianDAO) {
                if ($guardianDAO->getPassword() == $password) {

                    $_SESSION['loggeduser'] = $guardianDAO;
                    $this->showLandingPage('G');
                } else {
                    require_once(VIEWS_PATH . "login.php");
                }
            } else {
                if ($ownerDAO) {
                    if ($ownerDAO->getPassword() == $password) {

                        $_SESSION['loggeduser'] = $ownerDAO;
                        $this->showLandingPage('O');
                    }
                } else {
                    require_once(VIEWS_PATH . "login.php");
                }
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
}