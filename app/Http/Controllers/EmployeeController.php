<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     * Making all the methods of the controller to go through auth middleware
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * showing create blade from resource view folders
     * 
     * @return void
     */

    public function create()
    {
        return view('employee.create');
    }

    /**
     * storing employee details 
     * storing images to "public/uploads/employees"
     * inserting value into salary
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => ['required', 'email', 'unique:employees,email'],
            'phone_no' => ['required', 'regex:"^(?:\+88|01)?\d{11}$"'],
            'address' => ['required'],
            'image' => ['required','image','mimes:jpeg,jpg,png', 'max:2048'],
            'salary' => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
        ]);
        $path = "";
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $path = '/uploads/employees/'.$filename;
            $file->move(public_path().'/uploads/employees/',$filename);
        }
        
        $employee = Employee::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone_no' => $request['phone_no'],
            'address' => $request['address'],
            'image' => $path,
        ]);

        $employee->salary()->create([
            'salary' => $request['salary']
        ]);

        return redirect()->route('home')->with('status',"Employee Added Successfully!");
    }

    /**
     * showing edit blade from resource view folders
     * 
     * @return void
     */

    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    /**
     * storing employee details 
     * storing images to "public/uploads/employees"
     * inserting value into salary
     * @return void
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone_no' => ['required', 'regex:"^(?:\+88|01)?\d{11}$"'],
            'address' => ['required'],
            'image' => ['image','mimes:jpeg,jpg,png', 'max:2048'],
            'salary' => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
        ]);
        $path = "";
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $path = '/uploads/employees/'.$filename;
            $file->move(public_path().'/uploads/employees/',$filename); //uploads file

            $image_path = public_path().$employee->image;
            if(File::exists($image_path)) {
                File::delete($image_path);
            } //delete previous file

            $employee->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone_no' => $request['phone_no'],
                'address' => $request['address'],
                'image' => $path,
            ]); //updates user with new files and inputs given

        } else{
            $employee->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone_no' => $request['phone_no'],
                'address' => $request['address'],
            ]); //update without image attribute
        }
        $employee->salary()->update([
            'salary' => $request['salary']
        ]); //Updates salary

        return redirect()->route('home')->with('status',"Employee Added Successfully!");
    }

    /**
     * showing employee details in a seperate view
     * blade located in "resources/views/show.blade.php"
     * @return void
     */
    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }
    /**
     * deleting employee details
     * deleting image associated with employee
     * @return void
     */
    public function destroy(Employee $employee)
    {
        $image_path = public_path().$employee->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $employee->delete();
        return redirect()->route('home')->with('status',"Employee Deleted Successfully!");
    }
}
