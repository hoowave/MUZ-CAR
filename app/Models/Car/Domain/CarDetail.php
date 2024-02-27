<?php

namespace App\Models\Car\Domain;

use App\Models\Car\Command\CreateCarCmd;
use App\Models\Car\Model\CarDetailModel;

class CarDetail{
    protected $id;
    protected $carId;
    protected $year;
    protected $fuel;
    protected $seats;
    protected $gear;

    public function __construct(CreateCarCmd $createCarCmd, $carId)
    {
        $this->carId = $carId;
        $this->year = $createCarCmd->getYear();
        $this->fuel = $createCarCmd->getFuel();
        $this->seats = $createCarCmd->getSeats();
        $this->gear = $createCarCmd->getGear();
    }

    public function toModel(){
        return new CarDetailModel([
            'carId' => $this->carId,
            'year' => $this->year,
            'fuel' => $this->fuel,
            'seats' => $this->seats,
            'gear' => $this->gear,
        ]);
    }

    public function __toString() {
        return $this->carId . ' ' . $this->year . ' ' . $this->fuel  . ' ' . $this->seats  . ' ' . $this->gear;
    }

    public function getId(){
        return $this->id;
    }

    public function getCarId(){
        return $this->carId;
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