<?php

namespace DB;

use DAOInterfaces\IGuardianDao as IGuardianDao;
use Models\Guardian as Guardian;
use DB\Connection as Connection;
use \Exception as Exception;

class GuardianDAO implements IGuardianDAO
{
    private $connection;
    private $tableName = "Guardians";

    function add(Guardian $guardian)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " 
            (email, pass, first_name, last_name, phone, birth_date, nickname) 
            VALUES (:email,:password,:firstName,:lastName,:phoneNumber,:birthDate,:nickName);";

            $parameters["email"] = $guardian->getEmail();
            $parameters["password"] = $guardian->getPassword();
            $parameters["firstName"] = $guardian->getFirstName();
            $parameters["lastName"] = $guardian->getLastName();
            $parameters["phoneNumber"] = $guardian->getPhoneNumber();
            $parameters["birthDate"] = $guardian->getBirthDate();
            $parameters["nickName"] = $guardian->getNickName();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $insertExc) {
            //throw $insertExc; 
            echo "excepcion en add guardian";
        }
    }

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
                $guardian = new Guardian();

                $guardian->setId($row["id"]);
                $guardian->setEmail($row["email"]);
                $guardian->setPassword($row["pass"]);
                $guardian->setFirstName($row["first_name"]);
                $guardian->setLastName($row["last_name"]);
                $guardian->setPhoneNumber($row["phone"]);
                $guardian->setBirthDate($row["birth_date"]);
                $guardian->setScore($row["score"]);
                $guardian->setFirstAvailableDay($row["first_available_day"]);
                $guardian->setLastAvailableDay($row["last_available_day"]);
                $guardian->setPrice($row["price"]);
                $guardian->setPetsize($row["size"]);
                $guardian->setNickName($row["nickname"]);
                $guardian->setType("G");

                array_push($guardianList, $guardian);
            }

            return count($guardianList) > 0 ? $guardianList : null;
        } catch (Exception $ex) {
            throw $ex;
            echo "excepcion en getAll";
        }
    }
    public function getById($id)
    {
        try {
            $guardianList = array();
            $query = "SELECT g.id, g.email, g.pass, g.first_name, g.last_name, g.phone, g.birth_date, 
            g.nickname, g.score, g.first_available_day, g.last_available_day, g.price, ps.size  
            FROM " . $this->tableName  . " AS g 
            LEFT JOIN GuardianXSize AS gxs
            ON g.id = gxs.id_guardian
            LEFT JOIN petsizes AS ps
            ON gxs.id_petsize = ps.id 
            WHERE g.id = :id;";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $guardian = new Guardian(
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
                $guardian->setId($row["id"]);

                array_push($guardianList, $guardian);
            }

            return (count($guardianList) > 0) ? $guardianList[0] : null;

            return $guardian;
        } catch (Exception $ex) {
            //throw $ex;
            echo "excepcion en getbyemail guardian";
        }
    }

    public function getByEmail($email)
    {
        try {
            $guardianList = array();

            $query = "SELECT g.id, g.email, g.pass, g.first_name, g.last_name, g.phone, g.birth_date, g.nickname, g.score, g.first_available_day, g.last_available_day, g.price, ps.size  
            FROM " . $this->tableName  . " AS g 
            LEFT JOIN GuardianXSize AS gxs
            ON g.id = gxs.id_guardian
            LEFT JOIN petsizes AS ps
            ON gxs.id_petsize = ps.id 
            WHERE email = :email;";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $guardian = new Guardian($row["first_name"], $row["last_name"], $row["email"], $row["phone"], $row["birth_date"], $row["nickname"], $row["pass"], $row["score"], $row["size"], $row["price"], $row["first_available_day"], $row["last_available_day"]);
                $guardian->setId($row["id"]);

                array_push($guardianList, $guardian);
            }
            return (count($guardianList) > 0) ? $guardianList[0] : null;
        } catch (Exception $ex) {
            //throw $ex;
            echo "excepcion en getbyemail guardian";
        }
    }


    public function getByNickName($nickname)
    {
        try {
            $guardianList = array();

            $query = "SELECT g.id, g.email, g.pass, g.first_name, g.last_name, g.phone, g.birth_date, g.nickname, g.score, g.first_available_day, g.last_available_day, g.price, ps.size  
            FROM " . $this->tableName  . " AS g 
            LEFT JOIN GuardianXSize AS gxs
            ON g.id = gxs.id_guardian
            LEFT JOIN petsizes AS ps
            ON gxs.id_petsize = ps.id 
            WHERE nickname = :nickname;";

            $parameters['nickname'] = $nickname;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $guardian = new Guardian($row["first_name"], $row["last_name"], $row["email"], $row["phone"], $row["birth_date"], $row["nickname"], $row["pass"], $row["score"], $row["size"], $row["price"], $row["first_available_day"], $row["last_available_day"]);
                $guardian->setId($row["id"]);

                $guardianList = array();
                array_push($guardianList, $guardian);
            }
            ///return the array in position 0
            return (count($guardianList) > 0) ? $guardianList[0] : null;
        } catch (Exception $ex) {
            //throw $ex;
            echo "excepcion en getbynickname guardian";
        }
    }

    function validateGuardianxSize($id)
    {
        try {

            $query = "SELECT * FROM GuardianxSize WHERE id_guardian = :id;";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (empty($resultSet)) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $ex) {
            // throw $ex;
            echo " exc en validateGuardianxSize";
        }
    }

    function update($id, $petSize)
    {
        try {
            if ($this->validateGuardianxSize($id)) {
                $query = "UPDATE GuardianxSize SET id_petsize = :petSize WHERE id_guardian = :id;";

                $parameters['id'] = $id;
                $parameters['petSize'] = $petSize;

                $this->connection = Connection::GetInstance();

                $this->connection->Execute($query, $parameters);
            } else {
                $query = "INSERT INTO GuardianxSize (id_guardian, id_petsize) VALUES (:id, :petSize);";

                $parameters['id'] = $id;
                $parameters['petSize'] = $petSize;

                $this->connection = Connection::GetInstance();

                $this->connection->Execute($query, $parameters);
            }
        } catch (Exception $ex) {
            // throw $ex;
            echo ' exc en update() de GuardianDAO';
        }
    }

    function updateDate($id, $firstDay, $lastDay)
    {
        try {
            $query = "UPDATE Guardians SET first_available_day = :firstDay , last_available_day = :lastDay WHERE id = :id;";

            $parameters['firstDay'] = $firstDay;
            $parameters['lastDay'] = $lastDay;
            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $this->connection->Execute($query, $parameters);
        } catch (Exception $ex) {
            // throw $ex;
            echo ' exc en update() de GuardianDAO';
        }
    }

    public function getGuardiansByDate($firstDay, $lastDay)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE (first_available_day >= :firstDay
            AND last_available_day >= :lastDay);";

            $parameters['firstDay'] = $firstDay;
            $parameters['lastDay'] = $lastDay;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $guardian = new Guardian($row["first_name"], $row["last_name"], $row["email"], $row["phone"], $row["birth_date"], $row["nickname"], $row["pass"], $row["score"], $row["size"], $row["price"], $row["first_available_day"], $row["last_available_day"]);
                $guardian->setId($row["id"]);

                $guardianList = array();
                array_push($guardianList, $guardian);
            }

            return (count($guardianList) > 0) ? $guardianList : null;
        } catch (Exception $ex) {
            // throw $ex;
            echo " exc en getGuardiansByDate";
        }
    }


    // ------------------------------------------------------------ Con Mapear ------------------------------------------------------------------

    /* 
    function getAll()
    {
        try{
            $guardianList = array();

            $query = "SELECT g.id, g.email, g.pass, g.first_name, g.last_name, g.phone, g.birth_date, g.nickname, g.score, g.first_available_day, g.last_available_day, g.price, ps.size  
            FROM " . $this->tableName  . " AS g 
            LEFT JOIN GuardianXSize AS gxs
            ON g.id = gxs.id_guardian
            LEFT JOIN petsizes AS ps
            ON gxs.id_petsize = ps.id;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row){
                $guardian = new Guardian($row["first_name"], $row["last_name"], $row["email"],$row["phone"],$row["birth_date"],$row["nickname"],$row["pass"],$row["score"],$row["size"],$row["price"], $row["first_available_day"], $row["last_available_day"]);
                $guardian->setId($row["id"]);
                array_push($guardianList,$guardian);
            }
            
            return $guardianList;
        }
        catch(Exception $ex){
            throw $ex;
            echo "excepcion en getAll guardian";
        }
    }*/

    /*
    function getByEmail($email)
    {
        try{

            $query = "SELECT g.id, g.email, g.pass, g.first_name, g.last_name, g.phone, g.birth_date, g.nickname, g.score, g.first_available_day, g.last_available_day, g.price, ps.size  
            FROM " . $this->tableName  . " AS g 
            LEFT JOIN GuardianXSize AS gxs
            ON g.id = gxs.id_guardian
            LEFT JOIN petsizes AS ps
            ON gxs.id_petsize = ps.id 
            WHERE email = :email;";
           
            $parameters['email']=$email;
       
            $this->connection = Connection::GetInstance();

            //$foundGuardian =  $this->mapear($this->connection->Execute($query, $parameters));
            
            return $foundGuardian;
        }
        catch(Exception $ex){
            throw $ex;
            echo "excepcion en getByEmail guardian";
        } 
    }*/

    /*
    function getByNickname($nickname)
    {
        try{

            $query = "SELECT g.id, g.email, g.pass, g.first_name, g.last_name, g.phone, g.birth_date, g.nickname, g.score, g.first_available_day, g.last_available_day, g.price, ps.size  
            FROM " . $this->tableName  . " AS g 
            LEFT JOIN GuardianXSize AS gxs
            ON g.id = gxs.id_guardian
            LEFT JOIN petsizes AS ps
            ON gxs.id_petsize = ps.id 
            WHERE nickname = :nickname;";

         
            $parameters['nickname']=$nickname;
        


            $this->connection = Connection::GetInstance();

            $foundGuardian = $this->mapear($this->connection->Execute($query, $parameters));
  
            return $foundGuardian;
        }
        catch(Exception $ex){
            throw $ex;
            echo "excepcion en getByEmail guardian";
        } 
    }*/

    /*
    //Transforma el listado de usuario en objetos de la clase Usuario
    protected function mapear($value)
    {

        $value = is_array($value) ? $value : [];

        $resp = array_map(function ($p) {

            $guardian = new Guardian($p['first_name'], $p['last_name'], $p['email'], $p['phone'], $p['birth_date'], $p['nickname'], $p['pass'], $p['score'], $p['size'], $p['price'], $p['first_available_day'], $p['last_available_day']);
            $guardian->setId($p['id']);

            return $guardian;
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }*/
}
