<?php

namespace App\Models\Car\Domain;

use App\Models\Car\Model\CarModel;
use App\Models\Car\Command\CreateCarCmd;

class Car{
    protected $id;
    protected $brand;
    protected $model;
    protected $type;
    protected $introduction;
    protected $del_yn;

    public function __construct(CreateCarCmd $createCarCmd)
    {
        $this->brand = $createCarCmd->getBrand();
        $this->model = $createCarCmd->getModel();
        $this->type = $createCarCmd->getType();
        $this->introduction = $createCarCmd->getIntroduction();
        $this->del_yn = 'N';
    }

    public function toModel(){
        return new CarModel([
            'brand' => $this->brand,
            'model' => $this->model,
            'type' => $this->type,
            'introduction' => $this->introduction,
            'del_yn' => $this->del_yn,
        ]);
    }

    public function __toString() {
        return $this->brand . ' ' . $this->model . ' ' . $this->type  . ' ' . $this->type  . ' ' . $this->introduction  . ' ' . $this->del_yn;
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

} 