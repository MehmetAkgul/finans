<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    use HasFactory;

    protected $guarded = [];

    static function getList($type)
    {
        return Fatura::where('faturaTipi', $type)->get();
    }

    static function getTotal($id)
    {
        return FaturaIslem::where('faturaId', $id)->sum('genel_toplam_tutar');
    }

    static function getNo($id)
    {
        $c = Fatura::where('id', $id)->count();
        if ($c != 0) {
            return Fatura::where('id', $id)->first()->faturaNo;
        } else {
            return '#';
        }
    }





    public static function getGelirCount()
    {
        return Fatura::where('faturaTipi',FATURA_GELIR)->count();

    }
    public static function getGiderCount()
    {
        return Fatura::where('faturaTipi',FATURA_GIDER)->count();

    }


}
