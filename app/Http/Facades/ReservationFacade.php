<?php

namespace App\Http\Facades;

use App\Models\Reservation\ReservationService;
use App\Models\Reservation\Command\ReservationCmd;

class ReservationFacade{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService){
        $this->reservationService = $reservationService;
    }

    public function reservation(ReservationCmd $reservationCmd){
        return $this->reservationService->reservation($reservationCmd);
    }

    public function reservationIntro(ReservationCmd $reservationCmd){
        return $this->reservationService->reservationIntro($reservationCmd);
    }
}