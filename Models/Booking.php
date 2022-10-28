<?php
namespace Models;

class Booking
{
    private $status;
    private $pet;
    private $startDate;
    private $endDate;
    private $ownerEmail;
    private $guardianEmail;

    function __construct($status = "", $pet = "", $startDate = "",$endDate = "",$ownerEmail = "",$guardianEmail = ""){
        $this->status = $status;
        $this->pet = $pet;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->ownerEmail = $ownerEmail;
        $this->guardianEmail = $guardianEmail;
    }


    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getPet()
    {
        return $this->pet;
    }
 
    public function setPet($pet)
    {
        $this->pet = $pet;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    public function getOwnerEmail()
    {
        return $this->ownerEmail;
    }

    public function setOwnerEmail($ownerEmail)
    {
        $this->ownerEmail = $ownerEmail;
    }

    public function getGuardianEmail()
    {
        return $this->GuardianEmail;
    }

    public function setGuardianEmail($GuardianEmail)
    {
        $this->GuardianEmail = $GuardianEmail;
    }

}

?>