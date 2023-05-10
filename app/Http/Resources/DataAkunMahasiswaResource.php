<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataAkunMahasiswaResource extends JsonResource
{
    // define properties
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
            'id_mahasiswa' => $this->id_mahasiswa,
            'nim' => $this->nim,
            'nama_mahasiswa' => $this->nama_mahasiswa,
            'angkatan' => $this->angkatan,
            'foto' => $this->foto,
            'nomer_kendaraan' => $this->nomer_kendaraan,
        ]);
    }
}
