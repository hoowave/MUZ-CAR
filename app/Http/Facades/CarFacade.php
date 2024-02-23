<?php

namespace App\Http\Facades;

use App\Models\Car\CarService;
use App\Models\Car\Command\CarCmd;
use App\Models\Car\Command\InfoCarCmd;
use App\Models\Car\Command\CreateCarCmd;

class CarFacade{

    protected $carService;

    public function __construct(CarService $carService){
        $this->carService = $carService;
    }

    public function create(CreateCarCmd $createCarCmd){
        return $this->carService->create($createCarCmd);
    }

    public function list(){
        return $this->carService->list();
    }

    public function info(InfoCarCmd $infoCarCmd){
        return $this->carService->info($infoCarCmd);
    }
}