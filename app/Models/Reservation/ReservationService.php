<?php

namespace App\Models\Reservation;

use App\Models\Car\Model\CarModel;
use App\Exceptions\BaseErrorException;
use App\Models\Reservation\Info\ShowInfo;
use App\Models\Reservation\Info\ReservationInfo;
use App\Models\Reservation\Command\ReservationCmd;
use App\Models\Reservation\Model\ReservationModel;

class ReservationService{

    public function reservation(ReservationCmd $reservationCmd){
        $reservationDomain = $reservationCmd->toEntity();
        if(!CarModel::findById($reservationDomain->getCarId())){
            throw new BaseErrorException('차량 정보를 찾을 수 없습니다.');
        }
        if (ReservationModel::isReservation(
            $reservationDomain->getCarId(),
            $reservationDomain->getStartAt(),
            $reservationDomain->getEndAt()
        )){
            throw new BaseErrorException('선택한 시간에 이미 다른 예약이 존재합니다.');
        }
        $reservationModel = $reservationDomain->toModel();
        $reservationModel->save();
        $carModel = CarModel::findById($reservationCmd->getCarId());
        $reservationInfo = new ReservationInfo(
            $reservationDomain,
            $carModel->model,
            "Y"
        );
        return $reservationInfo->toArray();
    }

    public function reservationIntro(ReservationCmd $reservationCmd){
        $reservationDomain = $reservationCmd->toEntity();
        $carModel = CarModel::findById($reservationCmd->getCarId());
        if (!$carModel) {
            throw new BaseErrorException('차량 정보를 찾을 수 없습니다.');
        }
        $reservation_yn = "Y";
        if (ReservationModel::isReservation(
            $reservationDomain->getCarId(),
            $reservationDomain->getStartAt(),
            $reservationDomain->getEndAt()
        )){
            $reservation_yn = "N";
        }
        $reservationInfo = new ReservationInfo(
            $reservationDomain,
            $carModel->model,
            $reservation_yn
        );
        return $reservationInfo->toArray();
    }

    public function reservationShow(){
        $reservationModels = ReservationModel::getList();
        $ShowInfos = [];
        foreach ($reservationModels as $reservationModel) {
            $reservationTemp = new ShowInfo(
                $reservationModel->id,
                $reservationModel->carId,
                $reservationModel->model,
                $reservationModel->startAt,
                $reservationModel->endAt,
                $reservationModel->minutes,
                $reservationModel->cost,
                $reservationModel->pay_yn,
                $reservationModel->created_at,
                $reservationModel->updated_at
            );
            $ShowInfos[] = $reservationTemp->toArray();
        }
        return $ShowInfos;
    }

    public function info(InfoReservationCmd $infoReservationCmd){

    }
    
}