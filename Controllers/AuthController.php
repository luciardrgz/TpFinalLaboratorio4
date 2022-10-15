<?php

namespace Controllers;

use models\User as User;
use models\Owner as Owner;
use models\Guardian as Guardian;
use DAO\OwnerDAO as OwnerDAO;
use DAO\GuardianDAO as GuardianDAO;

class AuthController
{
    private $guardianDAO;
    private $ownerDAO;

    function __construct()
    {
        $this->guardianDAO = new GuardianDAO();
        $this->ownerDAO = new OwnerDAO();
    }

    public function login($email="", $password="")
    {
        if ($email == "" || $password == "") {
            require_once(VIEWS_PATH."login.php");  
        } else {

            $user = new User();
            $guardianDAO = new GuardianDAO();
            $guardianDAO = $this->guardianDAO->getByEmail($email);

            $ownerDAO = new OwnerDAO();
            $ownerDAO = $this->ownerDAO->getByEmail($email);

            if ($guardianDAO != null){
                if ($guardianDAO->getPassword() == $password) {
                    $_SESSION['loggeduser'] = $guardianDAO;
                    $_SESSION['type'] = $user->getType();
                    $this->showLandingPage('G');
                } else {
                    require_once(VIEWS_PATH . "login.php");
                }
            } else {
                if ($ownerDAO !=null) {
                    if ($ownerDAO->getPassword() == $password) {

                        $_SESSION['loggeduser'] = $ownerDAO;
                        $_SESSION['type'] = $user->getType();
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