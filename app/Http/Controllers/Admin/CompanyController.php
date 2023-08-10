<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = Company::paginate(10);

        return view('admin.company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.company.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:companies',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'required|url',
        ]);

        $company = Company::create($request->all());
        if ($request->logo) {
            $folderPath = public_path('assets/company_logo/' . $company->id . '/');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $file = $request->file('logo');
            $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
            $imageName = time() . $imageoriginalname;
            $file->move($folderPath, $imageName);
            $company->logo = 'assets/company_logo/' . $company->id . '/' . $imageName;
            $company->save();
        }
        return redirect()->route('admin.get.company')->with('message', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $Company = Company::find($id);
        if ($Company) {
            return view('admin.company.view', ['Company' => $Company]);
        } else {
            return redirect()->back()->with('error', 'Company Not Found..!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $Company = Company::find($id);
        if ($Company) {
            return view('admin.company.edit', ['Company' => $Company]);
        } else {
            return redirect()->back()->with('error', 'Company Not Found..!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'required|url',
        ]);

        $company = Company::find($request->id);
        $company->update($request->all());
        if ($request->logo) {
            $folderPath = public_path('assets/company_logo/' . $company->id . '/');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $file = $request->file('logo');
            $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
            $imageName = time() . $imageoriginalname;
            $file->move($folderPath, $imageName);
            $company->logo = 'assets/company_logo/' . $company->id . '/' . $imageName;
            $company->save();
        }
        return redirect()->route('admin.get.company')->with('message', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if ($id) {
            $Company = Company::find($id);
            $Company = $Company->delete();
            if ($Company) {
                return redirect()->route('admin.get.company')->with('message', 'Company Delete  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'Company Not Found..!');
        }
    }
}