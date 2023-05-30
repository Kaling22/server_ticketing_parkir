<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\tb_parkir;
use App\Models\tb_mahasiswa;

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
            'nim' => $this->nim,
            'status_masuk' => $this->status_masuk,
            'status_keluar' => $this->status_keluar,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'date' => $this->date,
        ]);
    }
}
