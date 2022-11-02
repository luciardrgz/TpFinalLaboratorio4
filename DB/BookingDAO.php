<?php

namespace DB;

use Models\Booking as Booking;

//use DAOInterfaces\IBookingDao as IBookingDao;
use DB\Connection as Connection;
use \Exception as Exception;

class BreedDAO
{
    private $connection;
    private $tableName = "Bookings";
}