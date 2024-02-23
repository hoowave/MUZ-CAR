<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Facades\CarFacade;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Dto\CarDto;
use App\Http\Response\CommonResponse;

class CarController extends Controller{
    
    protected $carFacade;

    public function __construct(CarFacade $carFacade){
        $this->carFacade = $carFacade;
    }

    public function create(Request $request){
        $carCmd = (new CarDto($request))->createInitCmd();
        $carModel = $this->carFacade->create($carCmd);
        return CommonResponse::success($carModel . " 차량의 등록이 완료되었습니다.");
    }

    public function list(){
        $carInfos = $this->carFacade->list();
        return CommonResponse::successForData($carInfos);
    }

    public function info(Request $request){
        $infoCarCmd = (new CarDto($request))->infoInitCmd();
        $carInfo = $this->carFacade->info($infoCarCmd);
        return CommonResponse::successForData($carInfo);
    }
}