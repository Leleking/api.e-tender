<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
class BidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $company = User::find($this->user_id);
        return [
            "id"=>$this->id,
            //"name"=>$this->project->name,

            "company_name"=>$company->name,
            "budget"=>$this->price,
            "experience"=>$this->experience,
            "vat"=>$this->vat,
            "tax"=>$this->tax,
            "business"=>$this->business,
            "cv"=>$this->cv,
            "status"=>$this->status



        ];
    }
}
