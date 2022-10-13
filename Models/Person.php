<?php 
    namespace Models;

    abstract class Person
    {
        private $firstName;
        private $lastName;
        private $email;
        private $phoneNumber;
        private $birthDate;
        
        /*
        function __construct($firstName, $lastName, $email,$phoneNumber,$birthDate){
            $this->firstName=$firstName;
            $this->lastName=$lastName;
            $this->email=$email;
            $this->phoneNumber=$phoneNumber;
            $this->birthDate=$birthDate;
        }*/

        public function getFirstName()
        {
                return $this->firstName;
        }

        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;
        }

        public function getLastName()
        {
                return $this->lastName;
        }

        public function setLastName($lastName)
        {
                $this->lastName = $lastName;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;

        }
  
        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;
        }

        public function getBirthDate()
        {
                return $this->birthDate;
        }

        public function setBirthDate($birthDate)
        {
                $this->birthDate = $birthDate;
        }
    }

        

?>