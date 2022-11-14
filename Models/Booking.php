<?php

namespace Models;

class Booking
{
    private $id;
    private $status;
    private $pet;
    private $startDate;
    private $endDate;
    private $ownerId;
    private $guardianId;
    private $price;

    function __construct($pet = "", $startDate = "", $endDate = "", $ownerId = "", $guardianId = "", $price = "")
    {
        $this->status = "1";
        $this->pet = $pet;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->ownerId = $ownerId;
        $this->guardianId = $guardianId;
        $this->price = $price;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusText()
    {
        if ($this->status == 1) {
            return "Waiting";
        } elseif ($this->status == 2) {
            return "Accepted";
        } elseif ($this->status == 3) {
            return "Rejected";
        }elseif ($this->status == 4) {
            return "Finished";
        }elseif ($this->status == 5) {
            return "Confirmed";
        }elseif ($this->status == 6) {
            return "Timed Out";
        } else {
            return "Rated";
        }
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

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }

    public function getGuardianId()
    {
        return $this->guardianId;
    }

    public function setGuardianId($guardianId)
    {
        $this->guardianId = $guardianId;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}