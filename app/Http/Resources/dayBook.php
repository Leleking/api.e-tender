<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class dayBook extends JsonResource
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
            'id'=> $this->id,
            'date_added'=> $this->date_added,
            'amount'=>$this->amount,
            'details'=>$this->details,
            'units'=>$this->units,
            'item'=>$this->item,
            'created_at'=>$this->created_at,
            'user'=>$this->user['name']

        ];
    }
}
