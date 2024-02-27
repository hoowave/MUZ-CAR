<?php

namespace App\Models\Car\Model;

use App\Models\Car\Model\CarModel;
use Illuminate\Database\Eloquent\Model;

class CarDetailModel extends Model
{
    protected $table = 'car_details';

    protected $fillable = [
        'carId', 'year', 'fuel', 'seats', 'gear'
    ];

    public function car()
    {
        return $this->belongsTo(CarModel::class, 'car_id');
    }

    public static function findByCarId($carId) {
        return self::where('carId', $carId)->first();
    }
}