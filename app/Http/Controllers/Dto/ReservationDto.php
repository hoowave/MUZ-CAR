<?php

namespace App\Http\Controllers\Dto;

use Illuminate\Http\Request;
use App\Models\Reservation\Command\ReservationCmd;

class ReservationDto{
    protected $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function reservationInitCmd(){
        $validatedData = $this->request->validate([
            'carId' => 'required|numeric',
            'startAt' => 'required|date|after_or_equal:today',
            'endAt' => 'required|date|after:startAt'
        ]);

        return new ReservationCmd(
            $validatedData['carId'],
            $validatedData['startAt'],
            $validatedData['endAt']
        );
    }
}