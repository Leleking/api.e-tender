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
        //move_uploaded_file($_FILES['photo']['tmp_name'], './img/' . $_FILES['photo']['name']);
       /*  $image = $request->file('business');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img');
       $image->move($destinationPath, $name);  */
       $business_image = save_image($request->file('business'),"/img/business");
       $vat_image = save_image($request->file('vat'),"/img/vat");
       $tax_image = save_image($request->file('tax'),"/img/tax");

        return response()->json(['data'=>$request->file('business')->getClientOriginalName()]);
        
    }
}
