<?php

namespace App\Models\Reservation\Domain;

use DateTime;
use App\Exceptions\BaseErrorException;
use App\Models\Reservation\Command\ReservationCmd;
use App\Models\Reservation\Model\ReservationModel;

class Reservation{
    protected $id;
    protected $carId;
    protected $startAt;
    protected $endAt;
    protected $minutes;
    protected $cost;
    protected $pay_yn;

    public function __construct(ReservationCmd $reservationCmd){
        $this->carId = $reservationCmd->getCarId();
        $dateStartAt = new DateTime($reservationCmd->getStartAt());
        $this->startAt = $dateStartAt->format('Y-m-d H:i');
        $dateEndAt = new DateTime($reservationCmd->getEndAt());
        $this->endAt = $dateEndAt->format('Y-m-d H:i');
        $interval = $dateStartAt->diff($dateEndAt);
        $minutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
        if ($minutes < 60) {
            throw new BaseErrorException("예약 시간은 최소 1시간(60분) 이상이어야 합니다.");
        }
        $this->minutes = $minutes;
        $this->cost = $minutes * 100;
        $this->pay_yn = 'N';
    }

    public function toModel(){
        return new ReservationModel([
            'carId' => $this->carId,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'minutes' => $this->minutes,
            'cost' => $this->cost,
            'pay_yn' => $this->pay_yn
        ]);
    }

    public function __toString() {
        return $this->carId . ' ' . $this->startAt . ' ' . $this->endAt  . ' ' . $this->minutes  . ' ' . $this->cost  . ' ' . $this->pay_yn;
    }

    public function getId(){
        return $this->id;
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

    public function getMinutes(){
        return $this->minutes;
    }

    public function getCost(){
        return $this->cost;
    }

    public function getPay_Yn(){
        return $this->pay_yn;
    }
}