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
        }
    }

    function newOwner($resultSet)
    {
        $ownerList = array();

        foreach ($resultSet as $row) {
            $owner = new Owner(
                $row["first_name"],
                $row["last_name"],
                $row["email"],
                $row["phone"],
                $row["birth_date"],
                $row["nickname"],
                $row["pass"]
            );
            $owner->setId($row["id"]);
            array_push($ownerList, $owner);
        }

        return $ownerList;
    }

    function getAll()
    {
        try {
            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $ownerList = $this->newOwner($resultSet);
            return count($ownerList) > 0 ? $ownerList : null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getByEmail($email)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE (email = :email);";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $ownerList = $this->newOwner($resultSet);
            return (count($ownerList) > 0) ? $ownerList[0] : null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getByNickName($nickname)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE (nickname = :nickname);";

            $parameters['nickname'] = $nickname;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            $ownerList = $this->newOwner($resultSet);
            return (count($ownerList) > 0) ? $ownerList[0] : null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

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
}