<?php

namespace App\Http\Controllers;
use App\Models\Companies;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $title = "Data Company";
        $companies = Companies::orderBy('id', 'asc')->paginate();
        return view('companies.index', compact('companies', 'title'));
    }

    public function create()
    {
        $title = "Tambah data Company";
        $managers = Companies::where('position', '1')->orderBy('id', 'asc')->get();
        return view('companies.create', compact('title', 'managers'));
    }

}