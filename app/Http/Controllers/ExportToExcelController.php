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
        return Excel::download(new ExportCustomer($id), $customer->name .'.xlsx');

    }

    public function importView(){
        $products = Product::get()->all();
        $productSections = ProductSection::get()->all();
        $productSubSections = ProductSubSection::get()->all();
        return view('import', compact('products','productSections','productSubSections'));
    }

    public function importContent(Request $request){
        $product_id = $request->input('product_id');
        $product_section_id = $request->input('product_section_id');
        $product_sub_section_id = $request->input('product_sub_section_id');
        $file = $request->file('excel_file');

        Excel::import(new ProductConditionImport($product_id, $product_section_id, $product_sub_section_id), $file);
        return redirect()->back()->with('success', 'Data imported successfully.');

    }
}
