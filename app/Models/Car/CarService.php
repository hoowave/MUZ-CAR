<?php

namespace App\Models\Car;


use App\Models\Car\Domain\Car;
use App\Models\Car\Info\CarInfo;
use App\Models\Car\Command\CarCmd;
use App\Models\Car\Model\CarModel;
use App\Models\Car\Info\CarListInfo;
use App\Models\Car\Info\CarIntroInfo;
use App\Exceptions\BaseErrorException;
use App\Models\Car\Command\InfoCarCmd;
use App\Models\Car\Info\CarDetailInfo;
use App\Models\Car\Command\CreateCarCmd;
use App\Models\Car\Model\CarDetailModel;


class CarService{

    public function create(CreateCarCmd $createCarCmd){
        $carDomain = $createCarCmd->toCarEntity();
        if(CarModel::isModel($carDomain->getModel())){
            throw new BaseErrorException('이미 존재하는 모델입니다.');
        }
        $carModel = $carDomain->toModel();
        $carModel->save();

        $carId = $carModel->id;
        $carDetailDomain = $createCarCmd->toCarDetailEntity($carId);
        $carDetailModel = $carDetailDomain->toModel();
        $carDetailModel->save();

        return $carDomain->getModel();
    }

    public function list(){
        $carModels = CarModel::getList();
        $carInfos = [];
    
        foreach ($carModels as $carModel) {
            $carInfoTemp = new CarInfo(
                $carModel->id,
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
            $carModel->id,
            $carModel->brand,
            $carModel->model,
            $carModel->type,
            $carModel->introduction,
            $carModel->del_yn,
            $carModel->created_at,
            $carModel->updated_at
        );

        $carDetailModel = CarDetailModel::findByCarId($infoCarCmd->getId());

        $carDetailInfo = new CarDetailInfo(
            $carDetailModel->id,
            $carDetailModel->carId,
            $carDetailModel->year,
            $carDetailModel->fuel,
            $carDetailModel->seats,
            $carDetailModel->gear,
            $carDetailModel->created_at,
            $carDetailModel->updated_at
        );

        $carIntroInfo = new CarIntroInfo($carInfo, $carDetailInfo);
        
        return $carIntroInfo->toArray();
    }
    
}