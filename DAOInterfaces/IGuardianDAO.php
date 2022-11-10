<?php 
namespace DAOInterfaces;
use Models\Guardian as Guardian;

interface IGuardianDAO{
    function add(Guardian $guardian);
    function getAllVisible();
    function getByNickname($nickname);
    function update($email,$petSize);
    function updateDate($email, $firstDay, $lastDay);
    function getByEmail($email);
}