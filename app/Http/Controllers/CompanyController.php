<?php

namespace App\Http\Controllers;

use Illuminate\Http\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //

    public function autocomplete(Request $request)
    {
        $data = Company::select("name as value", "id")
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }
}
