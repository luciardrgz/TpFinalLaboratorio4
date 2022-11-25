<?php 
namespace Exceptions;
use Exception as Exception;

class DuplicatedValueException extends Exception{
    
    protected $msg;

    public function __construct($message){
        $this->msg = $message;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    public function setMsg($message)
    {
        $this->msg = $message;
    }
}