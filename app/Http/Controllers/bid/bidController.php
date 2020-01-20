<?php

namespace App\Http\Controllers\bid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\userBid;
use App\Http\Resources\userBidResource;
use App\Http\Resources\BidResource;
use App\Http\Controllers\sendSMSController;
use App\model\project;
class bidController extends Controller
{
    public function userBids (Request $request) {
        $userBids = userBid::where('user_id',$request->user()->id)->get();
        return userBidResource::collection($userBids);
    }
    public function userCompletedBids(Request $request){
        $userBids = userBid::where('user_id',$request->user()->id)->where("status",1)->get();
        return userBidResource::collection($userBids);
    }
    public function getProjectBids($id){
        $project = project::find($id);
        $specifications = $project->specification;
        if($specifications->shuffle == 1){
            $userBids = userBid::where('project_id',$id)->orderByRaw("RAND()")->get();
        }else{
            //shortlist specifictions
            $avg = userBid::where('project_id',$id)->avg('price');
            $userBids = userBid::where('project_id',$id)->orderBy("id","asc")->get();
        }
       
        return BidResource::collection($userBids);  
    }
    public function test(Request $request){
        $bid = new userBid;
        $bid->project_id = $request->project_id;
        $bid->user_id= $request->user_id;
        $bid->experience=$request->experience;
        $bid->price=$request->price;
        if($request->file('business')){
            $business_image = save_image($request->file('business'),"/img/business");
            $bid->business = $business_image;
        }
        if($request->file('vat')){
            $vat_image = save_image($request->file('vat'),"/img/vat");
            $bid->vat = $vat_image;
        }
        if($request->file('tax')){
            $tax_image = save_image($request->file('tax'),"/img/tax");
            $bid->tax = $tax_image;
        }
        if($request->file('cv')){
            $cv_file = save_image($request->file('cv'),"/files");
            $bid->cv = $cv_file;
        }
        $bid->status=0;
        $bid->save();
        return response()->json(['data'=>$request->all()]);
        
    }
    public function grantInterview(Request $request){
        $bid = userBid::find($request->id);
        $bid->status = 1;
        $bid->save();
        $phone = $bid->user->user_detail->phone;
        $send = new sendSMSController();
        $send->key = "taConV0E1Fu0ibY5leaQXCon9";
        $send->message = $request->message;
        $send->numbers = $phone;
        $send->sender = "Vector";
        $isError = true;
        $response = $send->sendMessage(); 
        return response()->json(["data"=>$response]);
    
    }
}
