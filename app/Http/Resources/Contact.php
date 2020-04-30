<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'activity' => $this->activity,
            'place' => $this->place,
            'date' => $this->date,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,                  
            'phone' => $this->phone,
            'email' => $this->email
        ];
    }
}
