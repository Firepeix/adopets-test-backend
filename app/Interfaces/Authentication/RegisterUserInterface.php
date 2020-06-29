<?php


namespace App\Interfaces\Authentication;


interface RegisterUserInterface
{
    public function getEmail() : string;
    public function getName() : string;
    public function getPassword() : string;
    public function createUUID() : string;

}
