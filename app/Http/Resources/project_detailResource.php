<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class project_detailResource extends JsonResource
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
            "data"=>parent::toArray($request),
            "region"=>$this->region->name,
            "tender_type"=>$this->tender_type->name
        ];
    }
}
