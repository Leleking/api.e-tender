<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userBidResource extends JsonResource
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
            "id"=>$this->project->id,
            "name"=>$this->project->name,
            "budget"=>$this->project->budget,
            "end_date"=>$this->project->end_date

        ];
    }
}
