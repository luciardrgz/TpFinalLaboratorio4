<?php 
namespace Models;

class Guardian extends User
{
   private $puntuacion;
    
    function __construct($firstName, $lastName, $email,$phoneNumber, $nickName, $password,$puntuacion){
        parent::__construct($firstName, $lastName, $email,$phoneNumber, $nickName, $password);
        $this->puntuacion=$puntuacion;
        $this->setType("guardian");
    }

}

?>