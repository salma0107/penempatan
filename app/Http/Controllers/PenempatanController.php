<?php

namespace App\Http\Controllers;

use App\Models\Penempatan;
use App\Models\PenempatanDetail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Charts\PenempatanLineChart;

class PenempatanController extends Controller
{
    public function index()
    {
        $title = "Data Penempatan";
        $penempatans = Penempatan::orderBy('id', 'asc')->paginate(5);
        return view('penempatans.index', compact('title', 'penempatans'));
    }

    public function create()
    {
        $title = "Tambah data Penempatan";
        $managers = User::where('id', '1')->orderBy('id', 'asc')->get();
        return view('penempatans.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_penempatan' => 'required'
        ]);

        $penempatan = Penempatan::create([
            'no_penempatan' => $request->no_penempatan,
            'id_hrd' => $request->id_hrd,
            'tgl_penempatan' => $request->tgl_penempatan,
        ]);

        if ($penempatan) {
            for ($i = 1; $i <= $request->jml; $i++) {
                $details = [
                    'no_penempatan' => $request->no_penempatan,
                    'id_company' => $request['companyId' . $i],
                    'company_name' => $request['companyName' . $i],
                    'departmenCompany' => $request['departmenCompany' . $i],
                    'posisi' => $request['posisi' . $i],
                ];
                PenempatanDetail::create($details);
            }
        }

        return redirect()->route('penempatans.index')->with('success', 'Penempatan created successfully.');
    }

    public function show(Penempatan $penempatan)
    {
        return view('penempatans.show', compact('penempatan'));
    }

    public function edit(Penempatan $penempatan)
    {
        $title = "Edit Data penempatan";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        $detail = PenempatanDetail::where('no_penempatan', $penempatan->no_penempatan)->orderBy('id', 'asc')->get();
        return view('penempatans.edit', compact('penempatan', 'title', 'managers', 'detail'));
    }

    public function update(Request $request, Penempatan $penempatan)
    {
        $penempatan->update([
            'no_penempatan' => $request->no_penempatan,
            'id_hrd' => $request->id_hrd,
            'tgl_penempatan' => $request->tgl_penempatan,
        ]);

        if ($penempatan) {
            PenempatanDetail::where('no_penempatan', $penempatan->no_penempatan)->delete();
            for ($i = 1; $i <= $request->jml; $i++) {
                $details = [
                    'no_penempatan' => $request->no_penempatan,
                    'id_company' => $request['companyId' . $i],
                    'company_name' => $request['companyName' . $i],
                    'departmenCompany' => $request['departmenCompany' . $i],
                    'posisi' => $request['posisi' . $i],
                ];
                PenempatanDetail::create($details);
            }
        }

        return redirect()->route('penempatans.index')->with('success', 'Penempatan Has Been updated successfully');
    }

    public function destroy(Penempatan $penempatan)
    {
        $penempatan->delete();
        return redirect()->route('penempatans.index')->with('success', 'Penempatan has been deleted successfully');
    }

    public function chartLine()
    {
        $api = url('penempatans.chartLineAjax');

        $chart = new PenempatanLineChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
        $title = "Beranda";
        return view('home', compact('chart', 'title'));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function chartLineAjax(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $penempatans = Penempatan::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('tgl_penempatan', $year)
            ->groupBy(\DB::raw("MONTH(tgl_penempatan)"))
            ->pluck('count');

        $chart = new PenempatanLineChart;

        $chart->dataset('Penempatan Chart', 'bar', $penempatans)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0'
        ]);

        return $chart->api();
    }
}
