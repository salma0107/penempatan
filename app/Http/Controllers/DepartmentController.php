<?php

namespace App\Http\Controllers;
use App\Models\Departments;
use Illuminate\Http\Request;
use App\Models\Positions;


class DepartmentController extends Controller
{
    public function index()
    {
        $title = "Penampatan Kerja";
        $departments= Departments::orderBy('id', 'asc')->paginate(5);
        return view('departments.index', compact(['departments', 'title']));
    }

    public function create()
    {
        $title = "Tambah data";
        $managers = Positions::where('alias', 'Manager')->get();
        return view('departments.create', compact('managers', 'title'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'nullable',
            'manager_id' => 'required',
        ]);

        Departments::create($validatedData);

        return redirect()->route('departments.index')->with('success', 'Departement created successfully.');
    }


    public function show(Departments $department)
    {
        return view('departments.show', compact('departments'));
    }


    public function edit(Departments $department)
    {
        $title = "Edit Data departement";
        $managers = Positions::where('alias', 'Manager')->get();
        return view('departments.edit', compact('department', 'managers', 'title'));
    }


    public function update(Request $request, Departments $department)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);

        $department->fill($request->post())->save();

        return redirect()->route('departments.index')->with('success', 'Departemnt Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departments
     *  $Departments
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departments $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'departments has been deleted successfully');
    }
}
