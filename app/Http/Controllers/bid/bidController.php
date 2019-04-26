<?php

namespace App\Http\Controllers\bid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\userBid;
class bidController extends Controller
{
    public function userBids (Request $request) {
        $userBids = userBid::where('user_id',$request->user()->id)->get();
        return response()->json(['data'=>$userBids]);
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
        $bid->status=0;
        $bid->save();
        return response()->json(['data'=>$request->all()]);
        
    }
}
