<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapor extends Model
{
    use HasFactory;

    public static function getOdeme()
    {
        return Islem::where('type', 0)->sum('fiyat');
    }

    public static function getTahsilat()
    {
        return Islem::where('type', 1)->sum('fiyat');
    }

    public static function getMusteriOdeme($id)
    {
        $fatura = FaturaIslem::leftJoin('faturas', 'faturas.id', '=', 'fatura_islems.faturaId')
            ->where('faturas.musteriId', $id)
            ->where('faturas.faturaTipi', FATURA_GIDER)
            ->sum('fatura_islems.genel_toplam_tutar');
        $islem = Islem::where('musteriId', $id)->where('type', ISLEM_ODEME)->sum('fiyat');
        return $fatura - $islem;

    }

    public static function getMusteriTahsilat($id)
    {
        $fatura = FaturaIslem::leftJoin('faturas', 'faturas.id', '=', 'fatura_islems.faturaId')
            ->where('faturas.musteriId', $id)
            ->where('faturas.faturaTipi', FATURA_GELIR)
            ->sum('fatura_islems.genel_toplam_tutar');
        $islem = Islem::where('musteriId', $id)->where('type', ISLEM_TAHSILAT)->sum('fiyat');
        return $fatura - $islem;
    }

    public static function getMusteriBakiye($id)
    {
        return  self::getMusteriOdeme($id)-self::getMusteriTahsilat($id) ;
    }

}

