<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Response\CommonResponse;
use App\Http\Facades\ReservationFacade;
use App\Http\Controllers\Dto\ReservationDto;

class ReservationController extends Controller{
    
    protected ReservationFacade $reservationFacade;

    public function __construct(ReservationFacade $reservationFacade){
        $this->reservationFacade = $reservationFacade;
    }

    public function reservation(Request $request){
        $reservationCmd = (new ReservationDto($request))->reservationInitCmd();
        $ReservationInfo =$this->reservationFacade->reservation($reservationCmd);
        return CommonResponse::success("차량 예약이 완료되었습니다.", $ReservationInfo);
    }

    public function reservationIntro(Request $request){
        $reservationCmd = (new ReservationDto($request))->reservationInitCmd();
        $ReservationInfo = $this->reservationFacade->reservationIntro($reservationCmd);
        return CommonResponse::successForData($ReservationInfo);
    }
    
}