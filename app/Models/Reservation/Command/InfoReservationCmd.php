<?php

namespace App\Models\Reservation\Command;

class InfoReservationCmd{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }
}