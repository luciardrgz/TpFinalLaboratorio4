<?php

namespace DAOInterfaces;

use Models\Booking as Booking;
use Models\Owner as Owner;

interface IBookingDAO
{
    public function add(Booking $booking);
    public function newBooking($row);
    public function addOwnerXBooking($idOwner, $idBooking);
    public function addBookingXPets($idPet, $idBooking);
    public function getMaxIdBooking();
    public function getById($id);
    public function getByIdGuardian($idGuardian);
    public function getByIdOwner($idOwner);
    public function getBookingsBetweenDates($idGuardian, $firstDay, $lastDay);
    public function getRequests($idGuardian);
    public function getPets($idBooking);
    public function updateStatus($id, $status);
    public function updatePastConfirmedBookings($idGuardian);
    public function updatePastAcceptedBookings($idGuardian);
    public function updatePastWaitingBookings($idGuardian);
}