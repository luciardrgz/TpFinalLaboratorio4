<?php
namespace Models;

class Booking
{
    private $schedules;
    private $startDate;
    private $endDate;
    private $ownerEmail;
    private $guardianEmail;

    public function getSchedules()
    {
        return $this->schedules;
    }

    public function setSchedules($schedules)
    {
        $this->schedules = $schedules;

        return $this;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getOwnerEmail()
    {
        return $this->ownerEmail;
    }

    public function setOwnerEmail($ownerEmail)
    {
        $this->ownerEmail = $ownerEmail;

        return $this;
    }

    public function getGuardianEmail()
    {
        return $this->GuardianEmail;
    }

    public function setGuardianEmail($GuardianEmail)
    {
        $this->GuardianEmail = $GuardianEmail;

        return $this;
    }
}


?>