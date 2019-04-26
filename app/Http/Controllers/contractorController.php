<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class contractorController extends Controller
{
    public function index(){
        $contractors = User::where("isAdmin",0)->get();
        return response()->json(["data"=>$contractors]);
    }
}
