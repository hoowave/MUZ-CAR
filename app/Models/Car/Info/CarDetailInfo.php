<?php

namespace App\Models\Car\Info;

use DateTime;

class CarDetailInfo{
    protected $id;
    protected $carId;
    protected $year;
    protected $fuel;
    protected $seats;
    protected $gear;
    protected $created_at;
    protected $updated_at;

    public function __construct($id, $carId, $year, $fuel, $seats, $gear, $created_at, $updated_at) {
        $this->id = $id;
        $this->carId = $carId;
        $this->year = $year;
        $this->fuel = $fuel;
        $this->seats = $seats;
        $this->gear = $gear;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function toArray() {
        $dateCreatedAt = new DateTime($this->created_at);
        $dateUpdatedAt = new DateTime($this->updated_at);
        return [
            'id' => $this->id,
            'carId' => $this->carId,
            'year' => $this->year,
            'fuel' => $this->fuel,
            'seats' => $this->seats,
            'gear' => $this->gear,
            'created_at' => $dateCreatedAt->format('Y-m-d H:i'),
            'updated_at' => $dateUpdatedAt->format('Y-m-d H:i')
        ];
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

    public function getCreated_At(){
        return $this->created_at;
    }

    public function getUpdated_At(){
        return $this->updated_at;
    }

}