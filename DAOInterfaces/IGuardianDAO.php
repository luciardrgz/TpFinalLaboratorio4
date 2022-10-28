<?php 
namespace DAOInterfaces;
use Models\Guardian as Guardian;

interface IGuardianDAO{
    function add(Guardian $guardian);
    function getAll();
    function getByNickname($nickname);
    function update($email,$petSize);
    function updateDate($email,$availability);
    function getByEmail($email);
}