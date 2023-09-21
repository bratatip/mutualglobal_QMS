<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\RiskOccupancyImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function addRiskOccupancy()
    {
        return view('admin.settings.risk_occupancy');
    }

    public function storeRiskOccupancy(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            $file = $request->file('excel_file');
            Excel::import(new RiskOccupancyImport, $file);
            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }
}
