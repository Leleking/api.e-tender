<?php

namespace App\Http\Controllers\bid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\userBid;
use App\Http\Resources\userBidResource;
use App\Http\Resources\BidResource;
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
        $userBids = userBid::where('project_id',$id)->get();
        //return response()->json(["data"=>$userBids]);
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
}
