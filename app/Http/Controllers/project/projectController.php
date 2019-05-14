<?php

namespace App\Http\Controllers\project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\project;
use App\model\project_detail;
use App\model\category;
use App\Http\Resources\projectResource;
use App\Http\Resources\projectOldResource;
use App\Http\Resources\projectResourceAdmin;
use App\Http\Resources\projectCalenderResource;
use App\model\userBid;
use App\Http\Resources\tenderResource;
use Carbon\Carbon;
class projectController extends Controller
{
    public function getProjects(){
        $project = project::all();
        return tenderResource::collection($project);
        //return response()->json(['data'=>$project]);
    }
    public function searchProject(Request $request){
        $project = project::where('name',$request->name)->orWhere('name', 'like', '%' . $request->name . '%')->get();
        return response()->json(['data'=>$project]);

    }
    public function getProjectDetails(Request $request,$id){
        $project = project::find($id);
        $userBids = userBid::where('user_id',$request->user()->id)->where('project_id',$project->id)->get();
        if(!count($userBids)){
            return new projectResource($project);
        }else{
            return new projectOldResource($project);
        }
        
        
    }
    public function getProjectsByCategory($name){
        $category = category::where('name',$name)->first();
        if($category){
            $projects =$category->project;
            return response()->json(['data'=>$projects]);
        }else{
            return response()->json(['data'=>null]);
        }
    }
    public function search(Request $request){
        $projects = project::where('name','LIKE','%'.$request->name.'%')->get();
        return response()->json(['data'=>$projects]);
    }

    //admin functions
    public function postProject(Request $request){
        $project= project::create($request->all());
        $project_detail = project_detail::create(array_merge($request->all(),['project_id'=>$project->id]));
        return response()->json(['data'=>"successful"]);
    }
    public function viewAllProjects(){
        $project = project::all();
        return projectResourceAdmin::collection($project);
    }
    public function viewCompletedProjects(){
        $project = project::where('status',1)->get();
        return response()->json(['data'=>$project]);
    }
    public function viewProjectsDue(){
        $projects = project::where('end_date','<',Carbon::now())->get();
        return tenderResource::collection($projects);
    }
    public function getProjectCalender(){
        $project = project::all();
        return projectCalenderResource::collection($project);
    }

}
