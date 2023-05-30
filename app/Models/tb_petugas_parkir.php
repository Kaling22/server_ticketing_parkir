<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tb_mahasiswa;
class tb_petugas_parkir extends Model
{
    use HasFactory;
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

  
}
