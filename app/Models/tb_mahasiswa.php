<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tb_parkir;
use App\Models\tb_kendaraan;

class tb_mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function parkir()
    {
        return $this->hasMany(tb_parkir::class);
    }

    public function plat()
    {
        return $this->hasMany(tb_kendaraan::class);
    }
}
