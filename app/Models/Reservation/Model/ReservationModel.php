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
            // 새 예약의 시작 시간이 기존 예약의 종료 시간 이전에 있는 경우 (단, 기존 예약의 종료 시간과 동일한 시작 시간은 허용)
            $query->where('endAt', '>', $startAt)
                ->where('endAt', '<=', $endAt);

            // 또는 새 예약의 종료 시간이 기존 예약의 시작 시간 이후에 있는 경우 (단, 기존 예약의 시작 시간과 동일한 종료 시간은 허용)
            $query->orWhere('startAt', '<', $endAt)
                ->where('startAt', '>=', $startAt);
        })
        ->exists();
    }

}