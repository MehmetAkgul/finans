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
}
