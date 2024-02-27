<?php

namespace App\Models\Reservation\Info;

use DateTime;

class ShowInfo{
    protected $id;
    protected $carId;
    protected $carName;
    protected $startAt;
    protected $endAt;
    protected $minutes;
    protected $cost;
    protected $pay_yn;
    protected $created_at;
    protected $updated_at;

    public function __construct($id, $carId, $carName, $startAt, $endAt, $minutes, $cost, $pay_yn, $created_at, $updated_at){
        $this->id = $id;
        $this->carId = $carId;
        $this->carName = $carName;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->minutes = $minutes;
        $this->cost = $cost;
        $this->pay_yn = $pay_yn;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function toArray() {
        $dateCreatedAt = new DateTime($this->created_at);
        $dateUpdatedAt = new DateTime($this->updated_at);
        
        return [
            'id' => $this->id,
            'carId' => $this->carId,
            'carName' => $this->carName,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'minutes' => $this->minutes,
            'cost' => $this->cost,
            'pay_yn' => $this->pay_yn,
            'created_at' => $dateCreatedAt->format('Y-m-d H:i'),
            'updated_at' => $dateUpdatedAt->format('Y-m-d H:i')
        ];
    }

    public function __toString() {
        return $this->id . ' ' . $this->carId . ' ' .  $this->carName . ' ' . $this->startAt  . ' ' . $this->endAt  . ' ' . $this->minutes  . ' ' . $this->cost . ' ' . $this->pay_yn . ' ' . $this->created_at . ' ' . $this->updated_at;
    }

    public function getId(){
        return $this->id;
    }

    public function getCarId(){
        return $this->carId;
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

    public function getCreated_At(){
        return $this->created_at;
    }

    public function getUpdated_At(){
        return $this->updated_at;
    }
}