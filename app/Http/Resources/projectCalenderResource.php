<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class projectCalenderResource extends JsonResource
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
            "title"=>$this->name,
            "details"=>$this->body,
            "date"=>$this->end_date,
            "open"=>false
        ];
    }
}
