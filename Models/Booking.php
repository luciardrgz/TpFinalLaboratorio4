<?php
namespace Models;

class Booking
{
    private $status;
    private $pet;
    private $schedules;
    private $startDate;
    private $endDate;
    private $ownerEmail;
    private $guardianEmail;


    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    
    public function getSchedules()
    {
        return $this->schedules;
    }

    public function setSchedules($schedules)
    {
        $this->schedules = $schedules;
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

    public function getPet()
    {
        return $this->pet;
    }
 
    public function setPet($pet)
    {
        $this->pet = $pet;
    }
}


?>