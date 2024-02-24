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

}