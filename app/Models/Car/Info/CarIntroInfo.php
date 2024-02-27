<?php

namespace App\Models\Car\Info;

use App\Models\Car\Info\CarInfo;
use App\Models\Car\Info\CarDetailInfo;

class CarIntroInfo{
    protected $id;
    protected $brand;
    protected $model;
    protected $type;
    protected $introduction;
    protected $del_yn;
    protected $year;
    protected $fuel;
    protected $seats;
    protected $gear;

    public function __construct(CarInfo $carInfo, CarDetailInfo $carDetailInfo) {
        $this->id = $carInfo->getId();
        $this->brand = $carInfo->getBrand();
        $this->model = $carInfo->getModel();
        $this->type = $carInfo->getType();
        $this->introduction = $carInfo->getIntroduction();
        $this->del_yn = $carInfo->getDel_Yn();
        $this->year = $carDetailInfo->getYear();
        $this->fuel = $carDetailInfo->getFuel();
        $this->seats = $carDetailInfo->getSeats();
        $this->gear = $carDetailInfo->getGear();
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'model' => $this->model,
            'type' => $this->type,
            'introduction' => $this->introduction,
            'del_yn' => $this->del_yn,
            'year' => $this->year,
            'fuel' => $this->fuel,
            'seats' => $this->seats,
            'gear' => $this->gear
        ];
    }

    public function getId(){
        return $this->id;
    }

    public function getBrand(){
        return $this->brand;
    }

    public function getModel(){
        return $this->model;
    }

    public function getType(){
        return $this->type;
    }

    public function getIntroduction(){
        return $this->introduction;
    }

    public function getDel_Yn(){
        return $this->del_yn;
    }

    public function getYear(){
        return $this->year;
    }

    public function getFuel(){
        return $this->fuel;
    }

    public function getSeats(){
        return $this->seats;
    }

    public function getGear(){
        return $this->gear;
    }

}