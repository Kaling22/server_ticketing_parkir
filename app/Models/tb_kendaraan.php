<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tb_mahasiswa;

class tb_kendaraan extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey = 'id';
    protected $table = 'tb_kendaraans';
    protected $fillable = [
        'no_kendaraan',
        'id_kendaraan'
    ];
    public function mahasis()
    {
        return $this->hasMany(tb_mahasiswa::class, 'id_kendaraan', 'id');
    }
}
