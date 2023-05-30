<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
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
            'nim' => $this->nim,
            'nfc_num' => $this->nfc_num,
            'name' => $this->name,
            'jurusan' => $this->jurusan,
            'fakultas' => $this->fakultas,
            'angkatan' => $this->angkatan,
            'foto' => $this->foto,
            'telepon' => $this->telepon,
            'no_kendaraan' => $this->no_kendaraan,
        ]);
    }
}
