<?php

namespace App\Http\Controllers;

use App\Exports\ExportCustomer;
use App\Imports\ProductConditionImport;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCondition;
use App\Models\ProductSection;
use App\Models\ProductSubSection;
use App\Models\QuoteGenerate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ExportToExcelController extends Controller
{
    public function exportToExcel($id)
    {
        $quote = QuoteGenerate::findOrFail($id);
        $customer = Customer::findOrFail($quote->customer_id);
        return Excel::download(new ExportCustomer($id), $customer->name . '.xlsx');
    }

    public function importView()
    {
        $products = Product::get()->all();
        $productSections = ProductSection::get()->all();
        $productSubSections = ProductSubSection::get()->all();
        return view('import', compact('products', 'productSections', 'productSubSections'));
    }

    public function importContent(Request $request)
    {
        try {
            $product_uuid = $request->input('product_id');
            $product_section_uuid = $request->input('product_section_id');
            $product_sub_section_uuid = $request->input('product_sub_section_id');

            $product_id = Product::where('uuid', '=', $product_uuid)->pluck('id')->first();
            $product_section_id = ProductSection::where('uuid', '=', $product_section_uuid)->pluck('id')->first();
            $product_sub_section_id = ProductSubSection::where('uuid', '=', $product_sub_section_uuid)->pluck('id')->first();
            $file = $request->file('excel_file');

            Excel::import(new ProductConditionImport($product_id, $product_section_id, $product_sub_section_id), $file);

            return back()->with('success', 'Data imported successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
