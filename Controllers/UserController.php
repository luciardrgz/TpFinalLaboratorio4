<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;
use DAO\OwnerDAO as OwnerDAO;
use Models\Guardian as Guardian;
use Models\Owner as Owner;

class UserController
{
    private $guardianDAO;
    private $ownerDAO;

    public function __construct()
    {
        $this->guardianDAO = new GuardianDAO;
        $this->ownerDAO = new OwnerDAO;
    }

    function showLandingPage($type)
    {
        if ($type == 'G')
            require_once(VIEWS_PATH . "landingPageGuardian.php");
        else
            require_once(VIEWS_PATH . "landingPageOwner.php");
    }

    function showListView()
    {
        $cellphoneList = $this->guardianDAO->getAll();
        require_once(VIEWS_PATH . "cellphone-list.php");
    }

    function add($firstName, $lastName, $birthdate, $email, $phoneNumber, $nickName, $password, $type)
    {
        echo "HOLAAAA";
        if ($type == 'G') {

            $guardian = new Guardian();

            $guardian->setFirstName($firstName);
            $guardian->setLastName($lastName);
            $guardian->setEmail($email);
            $guardian->setBirthDate($birthdate);
            $guardian->setPhoneNumber($phoneNumber);
            $guardian->setNickName($nickName);
            $guardian->setPassword($password);
            $guardian->setType($type);

            $this->guardianDAO->add($guardian);
            $this->showLandingPage($type);
        } else if ($type == 'O') {

            $owner = new Owner();

            $owner->setFirstName($firstName);
            $owner->setLastName($lastName);
            $owner->setEmail($email);
            $owner->setBirthDate($birthdate);
            $owner->setPhoneNumber($phoneNumber);
            $owner->setNickName($nickName);
            $owner->setPassword($password);
            $owner->setType($type);

            $this->ownerDAO->add($owner);
            $this->showLandingPage($type);
        }
    }
    /*
    public function remove($id)
    {
        $this->guardianDAO->delete($id);
        $this->showListView();
    }*/
}