<?php

namespace App\Http\Controllers;

use App\Models\jobs;
use App\Models\User;
use App\Http\Requests\StorejobsRequest;
use App\Http\Requests\UpdatejobsRequest;
use App\Http\Resources\JobResource;
use App\Http\Resources\ApplicationResource;
use Illuminate\Http\Request;
use Validator;

/**
 * @api
 * @apiResource('jobs')
 */

class JobsController extends Controller
{
    /**
     * @authenticated
     * @header Bearer Token
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Jobs::paginate();

        return JobResource::collection($jobs);
    }

    /**
     * @authenticated
     * @header Bearer Token
     * Store a newly created resource in storage.
     */
    public function store(StorejobsRequest $request)
    {
        $validated = $request->validated();
        $created = Jobs::create(array_merge($validated,['user_id'=>auth()->id()]));
        if(!$created){
            return response()->json(['status'=>false, 'message'=>'error while creating job'], 400);
        }else{
            return new JobResource($created);
        }
    }

    /**
     * @authenticated
     * @header Bearer Token
     * Display the specified resource.
     */
    public function show(jobs $jobs)
    {
        return new JobResource($jobs);
    }

    /**
     * @authenticated
     * @header Bearer Token
     * Update the specified resource in storage.
     */
    public function update(UpdatejobsRequest $request, jobs $jobs)
    {
        $validated = $request->validated();
        $updated = $jobs->update(array_merge($validated,['user_id'=>auth()->id()]));
        if(!$updated){
            return response()->json(['status'=>false, 'message'=>'error while updating job'], 400);
        }else{
            return new JobResource($jobs);
        }
    }

    /**
     * @authenticated
     * @header Bearer Token
     * Remove the specified resource from storage.
     */
    public function destroy(jobs $jobs)
    {
        $deleted = $jobs->delete();
        if(!$deleted){
            return response()->json(['status'=>false, 'message'=>'error while deleting job'], 400);
        }else{
            return response()->json(['status'=>true, 'message'=>'Deleted successfully']);
        }
    }

    /**
     * @authenticated
     * @header Bearer Token
     */
    public function apply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required'
        ]);
   
        if($validator->fails()){
            return response()->json(['status'=>false, 'message'=>'Validation Error.', 'data'=>$validator->errors()], 401);       
        }

        $user = User::where('user_id', auth()->id())->first();

        $user->applictions()->attach($request->job_id);

        return response()->json(['status'=>true, 'message'=>'Applied successfully']);
    }

    /**
     * @authenticated
     * @header Bearer Token
     */
    public function applications(Request $request)
    {
        $jobs = Jobs::where('user_id', auth()->id())->get();

        if(!count($jobs)){
            return response()->json(['status'=>false, 'message'=>'No record found.'], 400);
        }else{
            return ApplicationResource::collection($jobs);
        }
    }
}
