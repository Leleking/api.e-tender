<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class projectResourceAdmin extends JsonResource
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
            "id"=>$this->id,
            "name"=>$this->name,
            "status"=>$this->status,
            "budget"=>$this->budget,
            "category"=>$this->category->name,
            "agency"=>$this->project_detail->agency,
            "region"=>$this->project_detail->region->name,
            "tender_type"=>$this->project_detail->tender_type->name
        ];
    }
}
