<?php

namespace ExceptionHandler;
use Exception;

class SQLInsert extends Exception
{
    private $msg;

    public function getMessage()
    {
        $excMsg = "Couldn't insert data on database";
        return $excMsg;
    }
}