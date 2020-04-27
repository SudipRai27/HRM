<?php

namespace App\Http\Middleware;

use App\Http\Controllers\HelperController;
use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route_parameters = $request->route()->action;
        $module_name = $route_parameters['module'];
        $permission_type = $route_parameters['permission_type'];
        
        $helper_controller = new HelperController;
        $user_type = $helper_controller->checkUserType();
        if($user_type == 'superadmin')
        {
            return $next($request);
        }
        else
        {
            $user_role_id = $helper_controller->getUserRoleId();
            $result = Permission::allowedOrNot($module_name, $permission_type, $user_role_id);

            if($result == 'no')
            {
                abort('403');
            }

            return $next($request);
        }
        
        
    }

    public function allowedOrNot($module_name, $permission_type, $user_role_id)
    {
        $status = 'no';
        $file = \File::get(base_path().'/Modules/'.$module_name.'/access.json');

        $file = json_decode($file, true);
        
        /*echo '<pre>';
        print_r($file);
        die();*/
        if(in_array($user_role_id, $file[$permission_type]))
        {
            $status = 'yes';
            
        }

        return $status;

        
    }
}
