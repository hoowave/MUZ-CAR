<?php

namespace App\Models\Car\Command;

use App\Models\Car\Domain\Car;
use App\Models\Car\Domain\CarDetail;

class CreateCarCmd{
    protected $brand;
    protected $model;
    protected $type;
    protected $introduction;
    protected $year;
    protected $fuel;
    protected $seats;
    protected $gear;

    public function __construct($brand, $model, $type, $introduction,
                                $year, $fuel, $seats, $gear)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->type = $type;
        $this->introduction = $introduction;
        $this->year = $year;
        $this->fuel = $fuel;
        $this->seats = $seats;
        $this->gear = $gear;
    }

    public function toCarEntity(){
        return new Car($this);
    }

    public function toCarDetailEntity($carId){
        return new CarDetail($this, $carId);
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