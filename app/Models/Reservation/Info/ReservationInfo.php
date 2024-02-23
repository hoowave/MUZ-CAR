<?php

namespace App\Models\Reservation\Info;

use App\Models\Reservation\Domain\Reservation;

class ReservationInfo{
    protected $carName;
    protected $startAt;
    protected $endAt;
    protected $minutes;
    protected $cost;
    protected $pay_yn;
    protected $reservation_yn;

    public function __construct(Reservation $reservation, $carName, $reservation_yn){
        $this->carName = $carName;
        $this->startAt = $reservation->getStartAt();
        $this->endAt = $reservation->getEndAt();
        $this->minutes = $reservation->getMinutes();
        $this->cost = $reservation->getCost();
        $this->pay_yn = $reservation->getPay_Yn();
        $this->reservation_yn = $reservation_yn;
    }

    public function toArray() {
        return [
            'carName' => $this->carName,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'minutes' => $this->minutes,
            'cost' => $this->cost,
            'pay_yn' => $this->pay_yn,
            'reservation_yn' => $this->reservation_yn
        ];
    }

    public function __toString() {
        return $this->carName . ' ' . $this->startAt . ' ' . $this->endAt  . ' ' . $this->minutes  . ' ' . $this->cost  . ' ' . $this->pay_yn;
    }

    public function getId(){
        return $this->id;
    }

    public function getCarName(){
        return $this->carName;
    }

    public function getStartAt(){
        return $this->startAt;
    }

    public function getEndAt(){
        return $this->endAt;
    }

    public function getMinutes(){
        return $this->Minutes;
    }

    public function getCost(){
        return $this->cost;
    }

    public function getPay_Yn(){
        return $this->pay_yn;
    }
}