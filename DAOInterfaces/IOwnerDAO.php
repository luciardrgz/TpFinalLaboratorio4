<?php

namespace DAOInterfaces;

use Models\Owner as Owner;

interface IOwnerDAO
{
    public function add(Owner $owner);
    public function newOwner($row);
    public function getAll();
    public function getByEmail($email);
    public function getByNickName($nickname);
    public function getNicknameById($id);
    public function changePassword($owner, $newPass);
}