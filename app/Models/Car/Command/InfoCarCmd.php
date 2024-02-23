<?php

namespace App\Models\Car\Command;

class InfoCarCmd{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }
    
}