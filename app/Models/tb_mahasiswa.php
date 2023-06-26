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

    protected $table = 'tb_mahasiswas';
    protected $fillable = [
        'nim',
        'nfc_num',
        'nfc_num_ktp',
        'name',
        'jurusan',
        'fakultas',
        'angkatan',
        'foto',
        'telepon',
        'id_kendaraan',
        'status_mahasiswa'
    ];
    public function parkir()
    {
        return $this->hasMany(tb_parkir::class, 'nim', 'id');
    }
    public function parkir_nfc()
    {
        return $this->hasMany(tb_parkir::class, 'nfc_num', 'id');
    }
    public function parkir_ktp()
    {
        return $this->hasMany(tb_parkir::class, 'nfc_num_ktp', 'id');
    }

    

    public function plat()
    {
        return $this->belongsTo(tb_kendaraan::class, 'id_kendaraan', 'id');
    }

}
