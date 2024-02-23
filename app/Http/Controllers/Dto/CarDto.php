<?php

namespace App\Http\Controllers\Dto;

use Illuminate\Http\Request;
use App\Models\Car\Command\CarCmd;
use App\Models\Car\Command\InfoCarCmd;
use App\Models\Car\Command\CreateCarCmd;

class CarDto
{
    protected $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function createInitCmd(){
        $validatedData = $this->request->validate([
            'brand' => 'required|string|max:20',
            'model' => 'required|string|max:50',
            'type' => 'required|string|max:10',
            'introduction' => 'required|string'
        ]);

        return new CreateCarCmd(
            $validatedData['brand'],
            $validatedData['model'],
            $validatedData['type'],
            $validatedData['introduction']
        );
    }

    public function infoInitCmd(){
        $validatedData = $this->request->validate([
            'id' => 'required|numeric'
        ]);

        return new InfoCarCmd(
            $validatedData['id']
        );
    }

}