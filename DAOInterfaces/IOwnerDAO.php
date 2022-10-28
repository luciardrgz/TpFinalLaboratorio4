<?php 
namespace DAOInterfaces;
use Models\Owner as Owner;

interface IOwnerDAO{
    function add(Owner $owner);
    function getAll();
    function getByNickname($nickname);
    function getByEmail($email);
}