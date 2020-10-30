<?php

namespace App\Http\Controllers;

use App\employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$employees = employees::latest()->paginate(10);
		return view('employees.index',compact('employees'))
		->with('i', (request()->input('page', 1) -1) * 10);
        //
		
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
	{
    
		return view('employees.create');
        //
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->validate(['firstname' =>'required','lastname' =>'required', 'company' => 'required|exists:App\companies,name', 'email'=>'required', 'phone'=>'required']);
		employees::create($request->all());
		return redirect()->route('employees.index')
		->with('success', 'Employees created successfully.');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(employees $employee)
    {
       return view ('employees.show',compact('employee'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(employees $employee)
    {
       return view ('employees.edit',compact('employee'));
		
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employees $employee)
    {
       $request->validate(['firstname' =>'required','lastname' =>'required', 'company'=> 'required|exists:App\companies,name', 'email'=>'required', 'phone'=>'required']);
		$employee->update($request->all());
		return redirect()->route('employees.index')->with('success', 'Employees update successfully.');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(employees $employee)
    {
       $employee->delete();
		return redirect() ->route('employees.index')->with('success', 'Employees deleted successfully.');
        //
    }
}
