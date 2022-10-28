<?php 
namespace Models;

class Guardian extends User
{
   private $score;
   private $petsize;
   private $price;
   private $firstAvailableDay;
   private $lastAvailableDay;

   function __construct($firstName = "", $lastName = "",$email = "",$phoneNumber = "",$birthDate = "",$nickName = "",$password = "",$score="",$petsize="",$price="",$firstAvailableDay="",$lastAvailableDay=""){
      parent::__construct($firstName , $lastName,$email ,$phoneNumber,$birthDate ,$nickName ,$password);
      $this->score=$score;
      $this->setType("G");
      $this->petsize=$petsize;
      $this->price=$price;
      $this->firstAvailableDay=$firstAvailableDay;
      $this->lastAvailableDay=$lastAvailableDay;
  }

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

   public function getPrice()
   {
      return $this->price;
   }

   public function setPrice($price)
   {
      $this->price = $price;
   }

   public function getFirstAvailableDay()
   {
      return $this->firstAvailableDay;
   }

   public function setFirstAvailableDay($firstAvailableDay)
   {
      $this->firstAvailableDay = $firstAvailableDay;
   }

   public function getLastAvailableDay()
   {
      return $this->lastAvailableDay;
   }

   public function setLastAvailableDay($lastAvailableDay)
   {
      $this->lastAvailableDay = $lastAvailableDay;
   }
   
}