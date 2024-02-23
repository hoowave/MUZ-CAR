<?php

namespace App\Models\Car;


use App\Models\Car\Domain\Car;
use App\Models\Car\Info\CarInfo;
use App\Models\Car\Command\CarCmd;
use App\Models\Car\Model\CarModel;
use App\Models\Car\Info\CarListInfo;
use App\Exceptions\BaseErrorException;
use App\Models\Car\Command\InfoCarCmd;
use App\Models\Car\Command\CreateCarCmd;


class CarService{

    public function create(CreateCarCmd $createCarCmd){
        $carDomain = $createCarCmd->toEntity();
        if(CarModel::isModel($carDomain->getModel())){
            throw new BaseErrorException('이미 존재하는 모델입니다.');
        }
        $carModel = $carDomain->toModel();
        $carModel->save();
        return $carDomain->getModel();
    }

    public function list(){
        $carModels = CarModel::getList();
        $carInfos = [];
    
        foreach ($carModels as $carModel) {
            $carInfoTemp = new CarInfo(
                $carModel->brand,
                $carModel->model,
                $carModel->type,
                $carModel->introduction,
                $carModel->del_yn,
                $carModel->created_at,
                $carModel->updated_at
            );
            $carInfos[] = $carInfoTemp->toArray();
        }
        return $carInfos;
    }

    public function info(InfoCarCmd $infoCarCmd){
        $carModel = CarModel::findById($infoCarCmd->getId());
        if(!$carModel){
            throw new BaseErrorException('차량 정보를 찾을 수 없습니다.');
        }
        $carInfo = new CarInfo(
            $carModel->brand,
            $carModel->model,
            $carModel->type,
            $carModel->introduction,
            $carModel->del_yn,
            $carModel->created_at,
            $carModel->updated_at
        );
        return $carInfo->toArray();
    }
    
}