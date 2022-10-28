<?php 
namespace Models;

class Owner extends User
{

    function __construct($firstName = "", $lastName = "",$email = "",$phoneNumber = "",$birthDate = "",$nickName = "",$password = ""){
        parent::__construct($firstName , $lastName,$email ,$phoneNumber,$birthDate ,$nickName ,$password );
        $this->setType("O");
    }
}


?>