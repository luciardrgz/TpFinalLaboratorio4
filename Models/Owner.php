<?php 
namespace Models;

class Owner extends User
{

    //private $id;
    
    function __construct($firstName, $lastName, $email,$phoneNumber,$nickName, $password){
        parent::__construct($firstName, $lastName, $email,$phoneNumber,$nickName, $password);
        $this->nickName=$nickName;
        $this->password=$password;
        $this->setType("owner");
    }


}


?>