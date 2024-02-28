<?php

namespace App\Models\Reservation\Model;

use Illuminate\Database\Eloquent\Model;

class ReservationModel extends Model{
    protected $table = 'reservations';
    protected $fillable = ['carId', 'startAt', 'endAt', 'minutes', 'cost', 'pay_yn'];

    public static function findById($id) {
        return self::find($id);
    }

    public static function isReservation($carId, $startAt, $endAt) {
        return self::where('carId', $carId)
        ->where(function ($query) use ($startAt, $endAt) {
            $query->where('endAt', '>', $startAt)
                ->where('endAt', '<=', $endAt);
            $query->orWhere('startAt', '<', $endAt)
                ->where('startAt', '>=', $startAt);
        })
        ->exists();
    }

    public static function getList() {
        return self::join('cars', 'reservations.carId', '=', 'cars.id')
        ->orderBy('reservations.created_at', 'desc')
        ->get(['reservations.*', 'cars.model as model']);
    }

    public static function findByIdWithCar($id) {
        return self::join('cars', 'reservations.carId', '=', 'cars.id')
                   ->where('reservations.id', '=', $id)
                   ->first(['reservations.*', 'cars.model as model']);
    }

}