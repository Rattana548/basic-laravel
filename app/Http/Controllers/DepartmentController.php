<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DepartmentController extends Controller
{
    function index(){
        $department = department::paginate(5);
        $trashdepartment = department::onlyTrashed()->paginate(5);

        // $department = DB::table("departments")->join('users','departments.department_id','users.id')
        // ->select('departments.*','users.name')->paginate(5);
        return View('admin.department.index')->with('department',$department)->with('trashdepartment',$trashdepartment);
    }

    function insert(Request $req){
        $req->validate([
            'department_name' => 'required|unique:departments|max:255',
        ],[
            'department_name.required'=>"อิอิข้อมูลไม่ครบ",
            'department_name.max' =>"อิอิข้อมูลเกิน",
            'department_name.unique' => "มีแล้ว", 
        ]);

        // $department = new department;
        // $department->department_name = $req->department_name;
        // $department->department_id = Auth::user()->id;
        // $department->save();

        $data = array();
        $data["department_name"] = $req->department_name;
        $data["department_id"] = Auth::user()->id;

        DB::table("departments")->insert($data);
        
        return redirect()->back()->with('success',"Save Success");
    }

    function edit($id){
        $department = department::find($id);
        return View('admin.department.edit')->with('department',$department);
    }

    function update(Request $req,$id){
        $req->validate([
            'department_name' => 'required|unique:departments|max:255',
        ],[
            'department_name.required'=>"อิอิข้อมูลไม่ครบ",
            'department_name.max' =>"อิอิข้อมูลเกิน",
            'department_name.unique' => "มีแล้ว", 
        ]);

        // $department = new department;
        // $department->department_name = $req->department_name;
        // $department->department_id = Auth::user()->id;
        // $department->save();

        $update = department::find($id)->update([
            'department_name'=>$req->department_name,
            'department_id'=> Auth::user()->id,
        ]);

        return redirect()->route('department')->with('success',"Update Success");
    }
    function softdelete($id){
        $delete = department::find($id)->delete();
        return redirect()->route('department')->with('success',"Move to Bin Success");
    }
    function bin(){
        $trashdepartment = department::onlyTrashed()->paginate(5);
        // $department = DB::table("departments")->join('users','departments.department_id','users.id')
        // ->select('departments.*','users.name')->paginate(5);
        return View('admin.department.bin')->with('department',$trashdepartment);
    }

    function restore($id){
        $restore = department::withTrashed()->find($id)->restore();
        return redirect()->route('department')->with('success',"Restore Success");
    
    }

    function delete($id){
        $delete = department::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('department')->with('success',"Delete Success");
   
    }
}
