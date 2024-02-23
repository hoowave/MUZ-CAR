<?php

namespace App\Models\Reservation\Command;

use App\Models\Reservation\Domain\Reservation;

class ReservationCmd{
    protected $carId;
    protected $startAt;
    protected $endAt;

    public function __construct($carId, $startAt, $endAt)
    {
        $this->carId = $carId;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }

    public function toEntity(){
        return new Reservation($this);
    }

    public function getCarId(){
        return $this->carId;
    }

    public function getStartAt(){
        return $this->startAt;
    }

    public function getEndAt(){
        return $this->endAt;
    }
}