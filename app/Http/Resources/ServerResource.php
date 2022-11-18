<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'ipv4' => $this->ipv4,
            'domain_name' => $this->domain_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
