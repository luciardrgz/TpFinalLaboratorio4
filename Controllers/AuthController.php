<?php

namespace Controllers;

use models\Owner as Owner;
use models\Guardian as Guardian;
use DB\OwnerDAO as OwnerDAO;
//use JSON\OwnerDAO as OwnerDAO;
use DB\GuardianDAO as GuardianDAO;
//use JSON\GuardianDAO as GuardianDAO;
use Controllers\MailController as MailController;
use Exception as Exception;

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
        $message = null;
        try {
            if ($email == "" || $password == "") {
                require_once(VIEWS_PATH . "login.php");
            } else {
                $guardian = new Guardian();
                $guardian = $this->guardianDAO->getByEmail($email);

                $owner = new Owner();
                $owner = $this->ownerDAO->getByEmail($email);

                if ($guardian != null) {

                    if ($guardian->getPassword() == $password) {

                        $_SESSION['loggeduser'] = $guardian;
                        $_SESSION['id'] = $guardian->getId();
                        $_SESSION['nickname'] = $guardian->getNickname();
                        $_SESSION['email'] = $guardian->getEmail();
                        $_SESSION['type'] = $guardian->getType();
                        header("Location:" . FRONT_ROOT . "Auth");
                    } else {
                        $message = "Wrong email or password";
                        require_once(VIEWS_PATH . "login.php");
                    }
                } else if ($owner != null) {

                    if ($owner->getPassword() == $password) {

                        $_SESSION['loggeduser'] = $owner;
                        $_SESSION['email'] = $owner->getEmail();
                        $_SESSION['nickname'] = $owner->getNickname();
                        $_SESSION['type'] = $owner->getType();
                        $_SESSION['id'] = $owner->getId();
                        header("Location:" . FRONT_ROOT . "Auth");
                    } else {
                        $message = "Wrong email or password";
                        require_once(VIEWS_PATH . "login.php");
                    }
                } else {
                    $message = "Wrong email or password";
                    require_once(VIEWS_PATH . "login.php");
                }
            }
        } catch (Exception $ex) {
            $message = "login DATA ERROR";
            require_once(VIEWS_PATH . "login.php");
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

    public function viewRecoverPass(){
        $message = null;
        require_once(VIEWS_PATH . "recoverPass.php");
    }

    public function recoverPass($email){
        try {
            if($this->verifyEmail($email)){
                $mailController = new MailController();
                $mailController->sendPassRecoveryMail($email);
                $message = "The mail has been sent";
                require_once(VIEWS_PATH . "login.php");
            }else{
                $message = "Invalid Email";
                require_once(VIEWS_PATH . "recoverPass.php");
            }
        } catch (Exception $ex) {
            $message = "DATA ERROR WHILE TRYING TO SEND EMAIL TO RECOVER THE PASSWORD";
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function verifyEmail($email){
        try {
                $exist = true;
                if($this->guardianDAO->getByEmail($email) == null && $this->ownerDAO->getByEmail($email) == null){
                    $exist = false;
                }
                return $exist;
        } catch (Exception $th) {
            throw $th;
        }
                
    }

    public function showResetPassword($email){ 
        $email = $this->decrypt($email, 'lubraAc0d3');
        require_once(VIEWS_PATH . "resetPassword.php");
    }

    public function Logout($message="")
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

    function encrypt($string, $key)
    {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
    }

    function decrypt($string, $key)
    {
        $result = '';
        $string = base64_decode($string);
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        return $result;
    }

}