<?php 
namespace Models;

class User extends Person
{
    private $nickName;
    private $password;
    private $type;
    //private $id;
    
    function __construct($firstName, $lastName, $email,$phoneNumber,$nickName, $password){
        parent::__construct($firstName, $lastName, $email,$phoneNumber);
        $this->nickName=$nickName;
        $this->password=$password;
    }

    public function getNickName()
    {
        return $this->nickName;
    }

    public function setNickName($nickName)
    {
        $this->nickName = $nickName;
    }
 
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

   
    public function getType()
    {
        return $this->type;
    }

 
    public function setType($type)
    {
        $this->type = $type;
    }
}



?>