<?php

namespace DB;

use Models\Owner as Owner;

use DAOInterfaces\IOwnerDAO as IOwnerDAO;
use DB\Connection as Connection;
use \Exception as Exception;

class OwnerDAO implements IOwnerDAO
{
    private $connection;
    private $tableName = "Owners";

    function add(Owner $owner)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (email, pass, first_name, last_name, phone, birth_date, nickname) VALUES (:email,:password,:firstName,:lastName,:phoneNumber,:birthDate,:nickName);";

            $parameters["email"] = $owner->getEmail();
            $parameters["password"] = $owner->getPassword();
            $parameters["firstName"] = $owner->getFirstName();
            $parameters["lastName"] = $owner->getLastName();
            $parameters["phoneNumber"] = $owner->getPhoneNumber();
            $parameters["birthDate"] = $owner->getBirthDate();
            $parameters["nickName"] = $owner->getNickName();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $insertExc) {
            throw $insertExc;
            echo " excepcion en add de ownerdao";
        }
    }

    function getAll()
    {
        try {
            $ownerList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $owner = new Owner($row["first_name"], $row["last_name"], $row["email"], $row["phone"], $row["birth_date"], $row["nickname"], $row["pass"]);
                $owner->setId($row["id"]);

                array_push($ownerList, $owner);
            }

            return count($ownerList) > 0 ? $ownerList : $ownerList['0'];
        } catch (Exception $ex) {
            throw $ex;
            echo "excepcion en getAll";
        }
    }

    public function getByEmail($email)
    {
        try {
            $ownerList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (email = :email);";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {

                $owner = new Owner($row["first_name"], $row["last_name"], $row["email"], $row["phone"], $row["birth_date"], $row["nickname"], $row["pass"]);
                $owner->setId($row["id"]);

                array_push($ownerList, $owner);
            }
            return (count($ownerList) > 0) ? $ownerList[0] : null;
        } catch (Exception $ex) {
            //throw $ex;
            echo "excepcion en getbyemail owner";
        }
    }

    # Si usamos el constructor de Owner, en los $row[] usamos nombre de columnas de la BD*
    # Si usamos los set ($owner->setAlgo($row["algo"]), podemos no usar los nombres de columnas 

    public function getNicknameById($id)
    {
        try {
            $query = "SELECT nickname FROM " . $this->tableName . " where id = :id";

            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $nickname = ($row['nickname']);
            }

            return $nickname;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getByNickName($nickname)
    {
        try {
            $ownerList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (nickname = :nickname);";

            $parameters['nickname'] = $nickname;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $owner = new Owner($row["first_name"], $row["last_name"], $row["email"], $row["phone"], $row["birth_date"], $row["nickname"], $row["pass"]);
                $owner->setId($row["id"]);

                array_push($ownerList, $owner);
            }

            return (count($ownerList) > 0) ? $ownerList[0] : null;
        } catch (Exception $ex) {
            //throw $ex;
            echo "excepcion en getbynickname owner";
        }
    }
}