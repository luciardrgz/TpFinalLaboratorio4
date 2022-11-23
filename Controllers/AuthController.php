<?php

namespace Controllers;

use models\Owner as Owner;
use models\Guardian as Guardian;
use DB\OwnerDAO as OwnerDAO;
//use JSON\OwnerDAO as OwnerDAO;
use DB\GuardianDAO as GuardianDAO;
//use JSON\GuardianDAO as GuardianDAO;
use Controllers\MailController as MailController;
use Controllers\UserController as UserController;
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


    public function Index()
    {
        if (isset($_SESSION["loggeduser"])) {
            $this->showLandingPage($_SESSION["type"]);
        } else {
            $this->login();
        }
    }

    public function logout($message = "")
    {
        session_destroy();
        require_once(VIEWS_PATH . "login.php");
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

                    if (password_verify($password, $guardian->getPassword())) {

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


                    if (password_verify($password, $owner->getPassword())) {

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
            $message = "DATABASE ERROR WHILE TRYING TO LOGIN";
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function register($firstName = "", $lastName = "", $birthDate = "", $email = "", $phoneNumber = "", $nickName = "", $password = "", $type = "")
    {
        try {
            $userController = new UserController(); // si lo pongo en constructor tira error de memoria ¿?

            if ($firstName != "" || $lastName != "" || $birthDate != "" || $email != "" || $phoneNumber != "" || $nickName != "" || $password != "" || $type != "") {

                if ($userController->validateUser($email, $nickName) == true) {

                    if ($userController->validateAge($birthDate)) {

                        $hashedPass = $this->encryptPass($password); // Se encripta la contraseña previo a almacenarla en la BBDD

                        if ($type == 'G') {

                            $guardian = new Guardian($firstName, $lastName, $email, $phoneNumber, $birthDate, $nickName, $hashedPass);
                            $this->guardianDAO->add($guardian);
                            $this->auth->login($email, $password);
                        } else {

                            $owner = new Owner($firstName, $lastName, $email, $phoneNumber, $birthDate, $nickName, $hashedPass);
                            $this->ownerDAO->add($owner);
                            $this->auth->login($email, $password);
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
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function encryptPass($pwd)
    {
        $pwd_hashed = password_hash($pwd, PASSWORD_DEFAULT);
        return $pwd_hashed;
    }

    public function verifyEmail($email)
    {
        try {
            $exist = true;
            if ($this->guardianDAO->getByEmail($email) == null && $this->ownerDAO->getByEmail($email) == null) {
                $exist = false;
            }
            return $exist;
        } catch (Exception $th) {
            throw $th;
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

    public function showRecoverPass()
    {
        $message = null;
        require_once(VIEWS_PATH . "recoverPass.php");
    }

    public function recoverPass($email)
    {
        try {
            if ($this->verifyEmail($email)) {
                $mailController = new MailController();
                $mailController->sendPassRecoveryMail($email);
                $message = "We've sent an email to you - check it out!";
                require_once(VIEWS_PATH . "login.php");
            } else {
                $message = "The email you've entered<br>isn't registered";
                require_once(VIEWS_PATH . "recoverPass.php");
            }
        } catch (Exception $ex) {
            $message = "DATABASE ERROR WHILE TRYING TO SEND EMAIL TO RECOVER THE PASSWORD";
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function showResetPassword($email)
    {
        $email = $this->urlsafe_b64decode($email);
        require_once(VIEWS_PATH . "resetPassword.php");
    }

    function urlsafe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    function urlsafe_b64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/'), array('-', '_'), $data);
        return $data;
    }
}