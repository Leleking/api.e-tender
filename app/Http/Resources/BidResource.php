<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\model\project;
use App\model\userBid;
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
        $project = project::find($this->project_id);
        $specifications = $project->specification;
        //shortlist with experience
        if($this->experience >= $specifications->experience ){
           if($this->status == 1){
                $this->status = 1;
           }elseif($this->status == 2){
                $this->status = 2;

           }
           else{
            $this->status = 0;
           }
        }else{
            if($this->status == 1){
                $this->status = 1;
           }elseif($this->status == 2){
                $this->status = 2;

           }
           else{
            $this->status = 3;
           }
        }

        //shortlist average
        $avg = userBid::where('project_id',$this->project_id)->avg('price');
        if($this->price > $avg){
            if($this->status == 1){
                $this->status = 1;
           }elseif($this->status == 2){
                $this->status = 2;

           }
           else{
            $this->status = 0;
           }
        }else{
            if($this->status == 1){
                $this->status = 1;
           }elseif($this->status == 2){
                $this->status = 2;

           }
           else{
            $this->status = 3;
           }
        }
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
