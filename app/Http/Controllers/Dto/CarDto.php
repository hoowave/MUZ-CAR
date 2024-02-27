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
            'introduction' => 'required|string',
            'year' => 'nullable|integer|between:2010,2024',
            'fuel' => 'nullable|string|in:휘발유,경유,LPG',
            'seats' => 'nullable|integer|between:1,8',
            'gear' => 'nullable|string|in:수동,자동',
        ]);

        return new CreateCarCmd(
            $validatedData['brand'],
            $validatedData['model'],
            $validatedData['type'],
            $validatedData['introduction'],
            $validatedData['year'],
            $validatedData['fuel'],
            $validatedData['seats'],
            $validatedData['gear'],
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