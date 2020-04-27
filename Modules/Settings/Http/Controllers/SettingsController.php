<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\Settings;
use Session;
use File;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getUpdateSettings()
    {
        $settings = Settings::first();

        return view('settings::update-settings')->with('settings', $settings);
    }


    public function postUpdateSettings(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'address' => 'required', 
            'telephone'  => 'required|numeric', 
            'logo' => 'mimes:jpg,jpeg,png'
            ]);

        if(count($request->settings_id))
        {
            $settings = Settings::find($request->settings_id);
            $settings->company_name = $request->company_name;
            $settings->address = $request->address;
            $settings->telephone = $request->telephone;

            if($request->hasFile('logo'))
            {
               $image_path = public_path()."/images/settings/{$settings->logo}";     
               
                if(File::exists($image_path)) {
                    File::delete($image_path);
                      } 
                $name = uniqid() . $request->logo->getClientOriginalName();
                $file = $request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('images/settings'),$name, $file);
                $settings->logo = $name;

            } 

            $settings->save();
            Session::flash('success-msg', 'Settings Updated Successfully');
            return redirect()->back();
        }
        else
        {               
            $settings = new Settings;
            $settings->company_name = $request->company_name;
            $settings->address = $request->address;
            $settings->telephone = $request->telephone;
          
            if($request->hasFile('logo')) 
            {
                $name = uniqid() . $request->logo->getClientOriginalName();
                $ext = $request->logo->getClientOriginalExtension();
                $request->logo->move(public_path().'/images/settings',$name,$ext);
                $settings->logo = $name;
            }

            $settings->save();
            Session::flash('success-msg', 'Settings Updated Successfully');
            return redirect()->back();
        }
    }

}
