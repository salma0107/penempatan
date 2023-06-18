<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyDetail;
use Illuminate\Http\Request;
use App\Models\User;

class PenempatanController extends Controller
{
    public function index()
    {
        $title = "Data Departements";
        $companies = Company::orderBy('id', 'asc')->paginate(5);
        return view('companies.index', compact(['companies', 'title']));
    }

    public function create()
    {
        $title = "Tambah data";
        $managers = User::where('position', 'Manager')->get();
        return view('companies.create', compact(['managers', 'title']));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'nullable',
            'manager_id' => 'required',
        ]);

        Company::create($validatedData);

        return redirect()->route('companies.index')->with('success', 'Departement created successfully.');
    }


    public function show(Company $departement)
    {
        return view('companies.show', compact('companies'));
    }


    public function edit(Company $departement)
    {
        $title = "Edit Data departement";
        $managers = User::where('position', 'Manager')->get();
        return view('companies.edit', compact(['departement', 'managers', 'title']));
    }


    public function update(Request $request, Company $departement)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);

        $departement->fill($request->post())->save();

        return redirect()->route('companies.index')->with('success', 'Departemnt Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $departement)
    {
        $departement->delete();
        return redirect()->route('companies.index')->with('success', 'departements has been deleted successfully');
    }

    // public function exportPdf()
    // {
    //     $title = "Laporan Data Departement";
    //     $companies = Company::orderBy('id', 'asc')->get();
    //     $pdf = PDF::loadview('departements.pdf', compact(['departements', 'title']));
    //     return $pdf->stream('laporan-departement-pdf');
    // }

    public function chartLine()
    {
        $api = url('/chart-line-ajax');
   
        $chart = new UserLineChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
          
        return view('chartLine', compact('chart'));
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $users = User::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', $year)
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
  
        $chart = new UserLineChart;
  
        $chart->dataset('New User Register Chart', 'line', $users)->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);
  
        return $chart->api();
    }


    
}
