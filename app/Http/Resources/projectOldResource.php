<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class projectOldResource extends JsonResource
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
            "project_detail"=> new project_detailResource($this->project_detail),
            "new"=>false
        ];
    }
}
