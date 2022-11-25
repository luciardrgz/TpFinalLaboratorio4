<?php

namespace DAOInterfaces;

use Models\Guardian as Guardian;

interface IGuardianDAO
{
    public function add(Guardian $guardian);
    public function addScore($idGuardian, $score);
    public function newGuardian($row);
    public function getAllVisible();
    public function getGuardiansByDate($firstDay, $lastDay);
    public function getById($id);
    public function getByEmail($email);
    public function getByNickName($nickname);
    public function validateGuardianxSize($id);
    public function update($id, $petSize);
    public function updateDate($id, $firstDay, $lastDay);
    public function updatePrice($id, $price);
    public function updateScore($idGuardian);
    public function changePassword($guardian, $newPass);
}