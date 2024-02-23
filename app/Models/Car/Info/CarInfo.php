<?php

namespace App\Models\Car\Info;

class CarInfo{
    protected $brand;
    protected $model;
    protected $type;
    protected $introduction;
    protected $del_yn;
    protected $created_at;
    protected $updated_at;

    public function __construct($brand, $model, $type, $introduction, $del_yn, $created_at, $updated_at) {
        $this->brand = $brand;
        $this->model = $model;
        $this->type = $type;
        $this->introduction = $introduction;
        $this->del_yn = $del_yn;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function toArray() {
        return [
            'brand' => $this->brand,
            'model' => $this->model,
            'type' => $this->type,
            'introduction' => $this->introduction,
            'del_yn' => $this->del_yn,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
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

    public function getCreated_At(){
        return $this->created_at;
    }

    public function getUpdated_At(){
        return $this->updated_at;
    }

}