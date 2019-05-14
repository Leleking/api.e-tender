<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class tenderResource extends JsonResource
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
            "agency"=>$this->project_detail->agency,
            "budget"=>$this->budget,
            "category"=>$this->category->name,
            "status"=>$this->status,
            "end_date"=>$this->end_date,
            "total_bids"=>count($this->user_bids),
        ];
    }
}
