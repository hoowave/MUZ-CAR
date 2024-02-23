<?php

namespace App\Models\Car\Model;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model{
    protected $table = 'cars';
    protected $fillable = ['brand', 'model', 'type', 'introduction', 'del_yn'];

    public static function isModel($modelName){
        return self::where('model', $modelName)->exists();
    }

    public static function getList() {
        return self::orderBy('created_at', 'desc')->get();
    }

    public static function findById($id) {
        return self::find($id);
    }
}