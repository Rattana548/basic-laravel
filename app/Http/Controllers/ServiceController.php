<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;

class ServiceController extends Controller
{
    function index(){
        $service = Service::paginate(5);
        return View('admin.service.index')->with('service',$service);
    }

    function insert(Request $req){
        $req->validate([
            'service_name'=>'required|unique:services|max:255',
            'service_image'=>'required|mimes:jpg,png,jpeg',
        ],[
            'service_name.required' => "Plase Input",
            'service_name.max' => "Max Value",
            'service_image.required'=>"Plase Input Image",
            'service_image.mimes'=>"plase INnput Jpg , png , jpeg",
        ]);

        $service_image = $req->file('service_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($service_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;

        $upload_location = 'image/service/';
        $fullpath = $upload_location.$img_name;
        $service_image->move($upload_location,$img_name);


        Service::insert([
            'service_name'=>$req->service_name,
            'service_image'=>$fullpath,
            'created_at'=>Carbon::now(),
        ]);
        return redirect()->route('service')->with('success',"Insert Service Success");

    }

    function edit($id){
        $service = Service::find($id);
        return View('admin.service.edit')->with('service',$service);
    }

    
    function update(Request $req,$id){

        $req->validate([
            'service_name'=>'required|max:255',
        ],[
            'service_name.max' => "Max Value",
            'service_name.required' => "Input Value",
        ]);

        $service_image = $req->file('service_image');

        if($service_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($service_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
    
            $upload_location = 'image/service/';
            $fullpath = $upload_location.$img_name;
    
            
    
            Service::find($id)->update([
                'service_name'=>$req->service_name,
                'service_image'=>$fullpath,
            ]);

            $old_image = $req->old_image;
            unlink($old_image);
            $service_image->move($upload_location,$img_name);
            return redirect()->route('service')->with('success',"Update Service Success");

        }else{
            Service::find($id)->update([
                'service_name'=>$req->service_name,
            ]);
            return redirect()->route('service')->with('success',"Update Service Success");
        }
    }

    function delete($id){

        $img = Service::find($id)->service_image;
        unlink($img);

        $delete = Service::find($id)->Delete();

        return redirect()->route('service')->with('success',"Delete Service Success");
    }
}
