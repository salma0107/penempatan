<?php

namespace App\Http\Controllers;
use App\Models\Positions;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $title = "Data Position";
        $positions = Positions::orderBy('id','desc')->paginate(5);
        return view('positions.index', compact('positions','title'));
    }

    public function create()
    {
        $title = "Add Data Position";
        return view('positions.create', compact('title'));
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
            'keterangan' => 'required',
            'alias' => 'required',
        ]);
        
        Positions::create($request->post());

        return redirect()->route('positions.index')->with('success','Positions has been created successfully.');
    }
}
