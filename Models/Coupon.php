<?php

namespace Models;

class Coupon
{
    private $id;
    private $import;
    private $date;
    private $idBooking;

    function __construct($import="",$idBooking="",$date="")
    {
        $this->import = $import;
        $this->date = $date;
        $this->idBooking = $idBooking;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getImport()
    {
        return $this->import;
    }

    public function setImport($import)
    {
        $this->import = $import;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getIdBooking()
    {
        return $this->idBooking;
    }

    public function setIdBooking($idBooking)
    {
        $this->idBooking = $idBooking;
    }
}