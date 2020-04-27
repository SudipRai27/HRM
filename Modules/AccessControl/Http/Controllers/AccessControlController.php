<?php

namespace Modules\AccessControl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AccessControl\Entities\Roles;
use File;
use Session;

class AccessControlController extends Controller
{
    
    public function getListAllModules()
    {
        $module_dir = glob(base_path()."/Modules".'/*', GLOB_ONLYDIR);

        $dirs = array();

        foreach ($module_dir as $d) 
        {
            $files = scandir($d);
            if (in_array('access.json', $files)) 
            {
                $dirs[] = substr($d, strrpos($d, '/')+1);
            }
            # code...
        }
        return view('accesscontrol::list-modules')
                    ->with('modules', $dirs);
    }

    public function getCreatePermission($module_name)
    {   
        $roles = Roles::pluck('role_name', 'id'); 

        try {

            $access = File::get(base_path().'/Modules/'.$module_name.'/access.json');
            $access = json_decode($access, true);

        }
        catch(Exception $e)
        {
            $access = array();
            Session::flash('error-msg','Module not found');
        }

        return view('accesscontrol::create-access-permission')->with('access',$access)
                                            ->with('roles', $roles)
                                            ->with('module_name', $module_name);
    }

    public function postCreatePermissions(Request $request, $module_name)
    {

        $input = request()->all();
           
        $arr = [];

        foreach($input['permission_type'] as $permission_type){
            if(isset($input[$permission_type.'_'])){
            $arr[$permission_type] = $input[$permission_type.'_'];
        }else{
            $arr[$permission_type] = [];
        }
        
            }
        try
        {
            File::put(base_path().'/Modules/'.$module_name.'/access.json', json_encode($arr, JSON_PRETTY_PRINT)); 
            Session::flash('success-msg', 'Permission Set Successfully');
            return redirect()->back();
        }
        catch(Exception $e)
        {
            //die($e->getMessage());
            Session::flash('error-msg', 'Permission could not be set');
            return redirect()->back();
        }

        
    }


}
