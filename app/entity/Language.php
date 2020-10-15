<?php

namespace App\Entity;

use App\Model\Model;

class Language extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll():array
    {
        return $this->selectquery("SELECT * FROM Language");
    }
}