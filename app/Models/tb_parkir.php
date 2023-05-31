<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tb_mahasiswa;
use App\Models\tb_petugas;


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
        return $this->belongsTo(tb_mahasiswa::class, 'nim', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(tb_petugas::class);
    }
}
