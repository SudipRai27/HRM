<?php

namespace Modules\Department\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Department\Entities\Department;
use Session;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function postApiCreateDepartment(Request $request)
    {
        
        $input = request()->all();
        Department::create($input);
        return 'success-msg';
    }

    public function getListDepartment()
    {
        $department = Department::orderBy('created_at', 'DESC')->paginate(6);
        return view('department::list')->with('department', $department);
    }


    public function getCreateDepartment()
    {
        return view('department::create');
    }

    public function postCreateDepartment(Request $request)
    {
        $request->validate([
            'department_name' => 'required'
            ]);
        $input = request()->all();
        Department::create($input);
        Session::flash('success-msg', 'Created Successfully'); 
        return redirect()->back();
    }

    public function getEditDepartment($id)
    {
        $department = Department::findOrfail($id); 
        return view('department::edit')->with('department', $department);
    }

    public function postEditDepartment(Request $request, $id)
    {
        $request->validate([
            'department_name' => 'required'
            ]);
        $input = request()->all();
        $department = Department::findOrfail($id);
        $department->update($input); 
        Session::flash('success-msg', 'Updated Successfully'); 
        return redirect()->back();
    }

    public function getDeleteDepartment($id)
    {
        $department = Department::findOrfail($id); 
        $department->delete();
        Session::flash('success-msg', 'Deleted Successfully'); 
        return redirect()->back();
    }
}
