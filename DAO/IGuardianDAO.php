<?php 
namespace DAO;
use Models\Guardian as Guardian;

interface IGuardianDAO{
    function add(Guardian $guardian);
    function getAll();
    function getByNickname($nickname);
    function loadData();
    function saveData();
}