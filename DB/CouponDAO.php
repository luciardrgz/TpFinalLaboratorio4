<?php

namespace DB;

use Models\Coupon as Coupon;
use DAOInterfaces\ICouponDAO as ICouponDAO;
use DB\Connection as Connection;
use \Exception as Exception;

class CouponDAO implements ICouponDAO
{
    private $connection;
    private $tableName = "cupones";

    public function add(Coupon $coupon)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " 
            (id_booking, importe, fecha) 
            VALUES (:idBooking,:amount ,now());";

            $parameters["idBooking"] = $coupon->getIdBooking();
            $parameters["amount"] = $coupon->getImport();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}