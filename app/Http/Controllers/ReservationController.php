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
        $carModel =$this->reservationFacade->reservation($reservationCmd);
        $response = CommonResponse::successForMessage($carModel . " 차량의 예약이 완료되었습니다.");
        return $response;
    }

    public function reservationIntro(Request $request){
        $reservationCmd = (new ReservationDto($request))->reservationInitCmd();
        $ReservationInfo = $this->reservationFacade->reservationIntro($reservationCmd);
        $response = CommonResponse::successForData($ReservationInfo);
        return $response;
    }

    public function reservationShow(Request $request){
        $reservationInfos = $this->reservationFacade->reservationShow();
        $response = CommonResponse::successForData($reservationInfos);
        return $response; 
    }

    public function info(Request $request){
        $infoReservationCmd = (new ReservationDto($request))->infoInitCmd();
        $showInfo = $this->reservationFacade->info($infoReservationCmd);
        $response = CommonResponse::successForData($showInfo);;
        return $response;
    }
    
}