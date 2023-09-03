<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tb_mahasiswa;
use App\Models\User;


class tb_parkir extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'nim',
        'nfc_num',
        'nfc_num_ktp',
        'status_masuk',
        'status_keluar',
        'created_by',
        'updated_by',
        'hari',
        'tanggal',
        'jam'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(tb_mahasiswa::class, 'nim', 'nim');
    }
    public function mahasiswa_nfc()
    {
        return $this->belongsTo(tb_mahasiswa::class, 'nfc_num', 'nfc_num');
    }
    public function mahasiswa_ktp()
    {
        return $this->belongsTo(tb_mahasiswa::class, 'nfc_num_ktp', 'nfc_num_ktp');
    }
    

    public function petugasMasuk()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function petugasKeluar()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
