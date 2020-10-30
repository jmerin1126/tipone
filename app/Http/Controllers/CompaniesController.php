<?php

namespace App\Http\Controllers;

use App\companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$companies = companies::latest()->paginate(10);
		return view('companies.index',compact('companies'))
		->with('i', (request()->input('page', 1) -1) * 10);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('companies.create');
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
		$request->validate(['name' =>'required', 'email'=> 'required', 'logo'=> 'image|max:2048', 'website'=>'required']);
		$file = $request->file('logo');
	
		if($request-> hasFile('logo')){
			$destinationPath = 'storage/app/public/';
			$profileImage = date('YmdHis').".".$file->getClientOriginalExtension();
			$file->move($destinationPath, $profileImage);
		
		}
		
		else {
		$profileImage = "No Image";	
		}
		
		$form_data = array (
		'name' => $request->name,
		'email' => $request->email,
		'logo' => $profileImage,
		'website' =>$request->website
		);
		
		companies::create($form_data);
		
		return redirect()->route('companies.index')->with('success', 'Company created successfully.');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\companies  $company
     * @return \Illuminate\Http\Response
     */
    public function show(companies $company)
    {
		return view ('companies.show',compact('company'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\companies  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(companies $company)
    {
		return view ('companies.edit',compact('company'));
		
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\companies  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, companies $company)
    {
		$request->validate(['name' =>'required', 'email'=>'required', 'logo'=> 'image|max:2048', 'website'=>'required']);
		$file = $request->file('logo');
	
		if($request-> hasFile('logo')){
			$destinationPath = 'storage/app/public/';
			$profileImage = date('YmdHis').".".$file->getClientOriginalExtension();
			$file->move($destinationPath, $profileImage);
		
		}
		
		else {
		$profileImage = "No Image";	
		}
		
		$form_data = array (
		'name' => $request->name,
		'email' => $request->email,
		'logo' => $profileImage,
		'website' =>$request->website
		
		);
		
		$company->update($form_data);
		return redirect()->route('companies.index')
		->with('success', 'Company updated successfully.');
        //
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\companies  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(companies $company)
    {
		$company->delete();
		return redirect() ->route('companies.index')->with('success', 'Company deleted successfully.');
        //
    }
}
