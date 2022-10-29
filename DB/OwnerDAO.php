<?php 

namespace DB;
use Models\Owner as Owner;
use DAOInterfaces\IOwnerDAO as IOwnerDAO;
use DB\Connection as Connection;
use \Exception as Exception;

class OwnerDAO implements IOwnerDAO{
    
    private $connection;
    private $tableName = "Owners";

    function add(Owner $owner)
    {
        try{
            $query = "INSERT INTO " . $this->tableName . " (email, pass, first_name, last_name, phone, birth_date, nickname) VALUES (:email,:password,:firstName,:lastName,:phoneNumber,:birthDate,:nickName);";

            echo " pasó el insertinto";

            $parameters["email"] = $owner->getEmail();
            $parameters["password"] = $owner->getPassword();
            $parameters["firstName"] = $owner->getFirstName();
            $parameters["lastName"] = $owner->getLastName();
            $parameters["phoneNumber"] = $owner->getPhoneNumber(); 
            $parameters["birthDate"] = $owner->getBirthDate();
            $parameters["nickName"] = $owner->getNickName();

            echo " pasó los parameters";

            $this->connection = Connection::GetInstance();

            echo " pasó getinstance";
        
            $this->connection->ExecuteNonQuery($query, $parameters);

            echo " pasó ENQ";

        }
        catch(Exception $insertExc){
            throw $insertExc;
            echo " excepcion en add de ownerdao";
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
                $owner->setPassword($row["pass"]);
                $owner->setFirstName($row["first_name"]);
                $owner->setLastName($row["last_name"]);
                $owner->setPhoneNumber($row["phone"]);
                $owner->setBirthDate($row["birth_date"]);
                $owner->setNickName($row["nickname"]);
                $owner->setType("O");

                array_push($ownerList, $owner);
                
            }

            return $ownerList;

            //return (count($ownerList) > 0) ? $ownerList[0] : null;

            return count($ownerList) > 0 ? $ownerList : $ownerList['0'];
        }
        catch(Exception $ex){
            throw $ex;
            echo "excepcion en getAll";
        }
    }

    public function getByEmail($email) 
    {
        try
        {
            $ownerList = array();

            $query = "SELECT * FROM ".$this->tableName." WHERE (email = :email);";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach ($resultSet as $row)
            {    
                $owner = new Owner();  

                // Nombre de columnas de la BD
                $owner->setId($row["id"]);
                $owner->setEmail($row["email"]);
                $owner->setPassword($row["pass"]);
                $owner->setFirstName($row["first_name"]);
                $owner->setLastName($row["last_name"]);
                $owner->setPhoneNumber($row["phone"]);
                $owner->setBirthDate($row["birth_date"]);
                $owner->setNickName($row["nickname"]);
                $owner->setType("O");
                
                array_push($ownerList, $owner);
            }
                ///return the array in position 0
                return (count($ownerList) > 0) ? $ownerList[0] : null;

        }catch(Exception $ex){
            //throw $ex;
            echo "excepcion en getbyemail owner";
        }
    }    

    
    /*
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
            throw $ex;
            echo "excepcion en getByEmail";
        } 
    }*/

	
    /*
    function getByNickname($nickname)
    {
        try{
            $owner = new Owner();

            $query = "SELECT * FROM " . $this->tableName . " WHERE nickname = " . $nickname;

            $this->connection = Connection::GetInstance();

            $foundOwner = $this->connection->Execute($query);
            $parameters['nickname']=$nickname;
            $foundOwner = $this->mapear($this->connection->Execute($query, $parameters));

                
                /*$owner->setId($foundOwner["id"]);
                $owner->setEmail($foundOwner["email"]);
                $owner->setPassword($foundOwner["password"]);
                $owner->setFirstName($foundOwner["firstname"]);
                $owner->setLastName($foundOwner["lastname"]);
                $owner->setPhoneNumber($foundOwner["phonenumber"]);
                $owner->setBirthDate($foundOwner["birthdate"]);
                $owner->setNickName($foundOwner["nickname"]);
                $owner->setType("O");
        
                return $foundOwner;
        }
        catch(Exception $ex){
           throw $ex;
           echo "excepcion en getByNickname";
        }  

        
    }*/

    public function getByNickName($nickname) 
    {
        try
        {
            $ownerList = array();

            $query = "SELECT * FROM ".$this->tableName." WHERE (nickname = :nickname);";

            $parameters['nickname'] = $nickname;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach ($resultSet as $row)
            {    
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
                
                array_push($ownerList, $owner);
            }
                ///return the array in position 0
                return (count($ownerList) > 0) ? $ownerList[0] : null;

        }catch(Exception $ex)
        {
            //throw $ex;
            echo "excepcion en getbynickname owner";
        }
    }  

    	/*Transforma el listado de usuario en objetos de la clase Usuario*/
		protected function mapear($value) { 

			$value = is_array($value) ? $value : [];

			$resp = array_map(function($p){
				$owner=new Owner($p['first_name'], $p['last_name'], $p['email'], $p['phone'],$p['birth_date'], $p['nickname'], $p['pass']);
                $owner->setId($p['id']);

                return $owner;
			}, $value);

               return count($resp) > 1 ? $resp : $resp['0'];

		}
}