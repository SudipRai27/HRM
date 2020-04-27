<?php

namespace Modules\Job\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Department\Entities\Department;
use Modules\Job\Entities\Job;
use Session;
use DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getListJob()
    {
        $job_list = DB::table('job')
                        ->join('department','department.id','=','job.department_id')
                        ->select('job.*', 'department.department_name')
                        ->orderBy('job.created_at', 'DESC')
                        ->paginate(6);

        return view('job::list')->with('job_list', $job_list);
    }

    public function getCreateJob()
    {
        $department_list = Department::pluck('department_name', 'id');
        return view('job::create')->with('department_list', $department_list);
    }

    public function postCreateJob(Request $request)
    {
        $request->validate([
            'job_title' => 'required', 
            'department_id' => 'required'
            ]);

        $input = request()->all();
        Job::create($input); 
        Session::flash('success-msg', 'Created Successfully');
        return redirect()->back();
    }

    public function getEditJob($id)
    {
        $job = Job::findorfail($id);
        $department_list = Department::select('department_name', 'id')->get();
        return view('job::edit')->with('job', $job)
                                ->with('department_list', $department_list);
    }

    public function postEditJob(Request $request, $id)
    {   
        $request->validate([
            'job_title' => 'required', 
            'department_id' => 'required'
            ]);

        $input = request()->all();
        $job = Job::findorfail($id);
        $job->update($input); 
        Session::flash('success-msg', 'Updated Successfully'); 
        return redirect()->back();
    }

    public function getDeleteJob($id)
    {
        $job = Job::findorfail($id);
        $job->delete();
        Session::flash('success-msg', 'Deleted Successfully');
        return redirect()->back();
    }
}
