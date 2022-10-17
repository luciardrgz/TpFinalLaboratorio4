<?php 
namespace Models;

class Guardian extends User
{
   private $score;
   private $petsize;
   private $availability;
   
   /*
    function __construct($firstName, $lastName, $email,$phoneNumber, $nickName, $password){
        parent::__construct($firstName, $lastName, $email,$phoneNumber, $nickName, $password);
        $this->puntuacion=0;
        $this->setType("G");
    }*/

   public function getScore()
   {
      return $this->score;
   }

   public function setScore($score)
   {
      $this->score = $score;
   }

   public function getPetsize()
   {
      return $this->petsize;
   }

   public function setPetsize($petsize)
   {
      $this->petsize = $petsize;
   }

   public function getAvailability()
   {
      return $this->availability;
   }

   public function setAvailability($availability)
   {
      $this->availability = $availability;
   }
}