<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\tb_parkir;
use App\Models\tb_mahasiswa;
use App\Models\tb_petugas_parkir;

class ParkirResource extends JsonResource
{
    public $status;
    public $message;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ([
            'id' => $this->id,
            'nim' => $this->mahasiswa->nim,
            'status_masuk' => $this->status_masuk,
            'status_keluar' => $this->status_keluar,
            'created_by' => $this->petugas->created_by,
            'updated_by' => $this->petugas->updated_by,
            'hari' => $this->hari,
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
        ]);
    }
}
