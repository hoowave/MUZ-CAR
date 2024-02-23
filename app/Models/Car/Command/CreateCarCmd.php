<?php

namespace App\Models\Car\Command;

use App\Models\Car\Domain\Car;

class CreateCarCmd{
    protected $brand;
    protected $model;
    protected $type;
    protected $introduction;

    public function __construct($brand, $model, $type, $introduction)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->type = $type;
        $this->introduction = $introduction;
    }

    public function toEntity(){
        return new Car($this);
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

} 