<?php 
namespace Models;

class User 
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $phoneNumber;
    private $birthDate;
    private $nickName;
    private $password;
    private $type;
    
    function __construct($firstName = "", $lastName = "",$email = "",$phoneNumber = "",$birthDate = "",$nickName = "",$password = ""){
        $this->firstName=$firstName;
        $this->email=$email;
        $this->lastName=$lastName;
        $this->phoneNumber=$phoneNumber;
        $this->birthDate=$birthDate;
        $this->nickName=$nickName;
        $this->password=$password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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