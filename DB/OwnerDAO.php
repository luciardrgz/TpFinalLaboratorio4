<?php 

namespace DB;
use Models\Owner as Owner;
use DAOInterfaces\IOwnerDAO as IOwnerDAO;
use DB\Connection as Connection;

class OwnerDAO implements IOwnerDAO{
    
    private $connection;
    private $tableName = "Owners";

    function add(Owner $owner)
    {
        try{
            $query = "INSERT INTO " . $this->tableName . " (email, pass, first_name, last_name, phone, birth_date, nickname) VALUES (:email,:password,:firstName,:lastname,:phoneNumber,:birthDate,:nickName);";

            $parameters["email"] = $owner->getEmail();
            $parameters["password"] = $owner->getPassword();
            $parameters["firstName"] = $owner->getFirstName();
            $parameters["lastName"] = $owner->getLastName();
            $parameters["phoneNumber"] = $owner->getPhoneNumber(); 
            $parameters["birthDate"] = $owner->getBirthDate();
            $parameters["nickName"] = $owner->getNickName();

            $this->connection = Connection::GetInstance();
        
            $this->connection->ExecuteNonQuery($query, $parameters);

        }
        catch(Exception $insertExc){
            //throw $insertExc;
            echo "excepcion en add de ownerdao";
        }
    }

    function getAll()
    {
        try{
            $ownerList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row){
                $owner = new Owner();

                $owner->setId($row["id"]);
                $owner->setEmail($row["email"]);
                $owner->setPassword($row["password"]);
                $owner->setFirstName($row["firstname"]);
                $owner->setLastName($row["lastname"]);
                $owner->setPhoneNumber($row["phonenumber"]);
                $owner->setBirthDate($row["birthdate"]);
                $owner->setNickName($row["nickname"]);
                $owner->setType("O");
            }

            return $ownerList;
        }
        catch(Exception $ex){
            //throw $ex;
            echo "excepcion en getAll";
        }
    }

    function getByEmail($email)
    {
        try{

            $query = "SELECT * FROM " . $this->tableName . " WHERE email = :email";

            $parameters['email']=$email;
            $this->connection = Connection::GetInstance();

            $foundOwner = $this->mapear($this->connection->Execute($query, $parameters));
                
            return $foundOwner;
        }
        catch(Exception $ex){
            //throw $ex;
            echo "excepcion en getByEmail";
        } 
    }

		/*Transforma el listado de usuario en objetos de la clase Usuario*/
		protected function mapear($value) { 

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				return new Owner($p['first_name'], $p['last_name'], $p['email'], $p['phone'],$p['birth_date'], $p['nickname'], $p['pass'], $p['id']);
			}, $value);

               return count($resp) > 1 ? $resp : $resp['0'];

		}

    function getByNickname($nickname)
    {
        try{
            $owner = new Owner();

            $query = "SELECT * FROM " . $this->tableName . " WHERE nickname = " . $nickname;

            $this->connection = Connection::GetInstance();

            $foundOwner = $this->connection->Execute($query);
            
                $owner->setId($foundOwner["id"]);
                $owner->setEmail($foundOwner["email"]);
                $owner->setPassword($foundOwner["password"]);
                $owner->setFirstName($foundOwner["firstname"]);
                $owner->setLastName($foundOwner["lastname"]);
                $owner->setPhoneNumber($foundOwner["phonenumber"]);
                $owner->setBirthDate($foundOwner["birthdate"]);
                $owner->setNickName($foundOwner["nickname"]);
                $owner->setType("O");
        
            return $owner;
        }
        catch(Exception $ex){
           // throw $ex;
           echo "excepcion en getByNickname";
        }  
    }
}