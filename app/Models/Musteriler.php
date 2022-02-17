<?php

namespace App\Models;

use App\Http\Controllers\Admin\MusteriController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musteriler extends Model
{
    use HasFactory;

    protected $guarded = [];

    static function getPublicName($id)
    {
        $data = Musteriler::where('id', $id)->get();

        if ($data[0]['musteriTipi'] == 0) {
            return $data[0]['ad'] . " " . $data[0]['soyad'];
        } else {
            return $data[0]['firmaAdi'];
        }


    }

    public static function getPhoto($id)
    {
        $data = Musteriler::where('id', $id)->first();

        if ($data->photo != "") {
            return $data->photo;
        } else {
            return "/assets/dist/img/default-150x150.png";
        }
    }

}
