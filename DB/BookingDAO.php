<?php

namespace DB;

use Models\Booking as Booking;

//use DAOInterfaces\IBookingDao as IBookingDao;
use DB\Connection as Connection;
use \Exception as Exception;

class BookingDAO
{
    private $connection;
    private $tableName = "Bookings";

    function add(Booking $booking)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " 
            (id_status, start_date, end_date, totalAmount, id_guardian) 
            VALUES (:status,:firstDay,:lastDay,:totalAmount,:idGuardian);";

            $parameters["status"] = $booking->getStatus();
            $parameters["firstDay"] = $booking->getStartDate();
            $parameters["lastDay"] = $booking->getEndDate();
            $parameters["totalAmount"] = $booking->getPrice();
            $parameters["idGuardian"] = $booking->getGuardianId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            // $this->addOwnerXBooking($booking->getOwnerId());
        } catch (Exception $exc) {
            throw $exc;
            //echo "excepcion en add guardian";
        }
    }

    function addOwnerXBooking($idOwner, $idBooking)
    {
        try {

            $query = "INSERT INTO ownerxbooking  
            (id_owner, id_booking) 
            VALUES (:idOwner, idBooking);";

            $parameters["idOwner"] = $idOwner;
            $parameters["idBooking"] = $idBooking;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exc) {
            throw $exc;
            //echo "excepcion en add guardian";
        }
    }

    public function getBookingId()
    {
    }
    /*
    function getAll()
    {
        try {
            $guardianList = array();

            $query = "SELECT g.id, g.email, g.pass, g.first_name, g.last_name, 
            g.phone, g.birth_date, g.nickname, g.score, g.first_available_day, g.last_available_day, g.price, ps.size  
            FROM " . $this->tableName  . " AS g 
            LEFT JOIN GuardianXSize AS gxs
            ON g.id = gxs.id_guardian
            LEFT JOIN petsizes AS ps
            ON gxs.id_petsize = ps.id;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $booking = new Booking(
                    $row["first_name"],
                    $row["last_name"],
                    $row["email"],
                    $row["phone"],
                    $row["birth_date"],
                    $row["nickname"],
                    $row["pass"],
                    $row["score"],
                    $row["size"],
                    $row["price"],
                    $row["first_available_day"],
                    $row["last_available_day"]
                );

                $booking->setId($row["id"]);

                array_push($guardianList, $booking);
            }

            return count($guardianList) > 0 ? $guardianList : null;
        } catch (Exception $ex) {
            throw $ex;
            echo "excepcion en getAll";
        }
    }*/
}