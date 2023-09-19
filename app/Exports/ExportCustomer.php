<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCondition;
use App\Models\ProductSection;
use App\Models\QuoteGenerate;
use App\Models\RiskOccupancy;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;


class ExportCustomer implements FromView, ShouldAutoSize
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Customer::all();
    // }

    public function view(): View
    {
        $productConditionsBurglary = ProductCondition::where([
            'product_id' => 1,
            'product_section_id' => 1,
            'product_sub_section_id' => 1
        ])->pluck('content')->toArray();

        $productConditionsMachinery = ProductCondition::where([
            'product_id' => 1,
            'product_section_id' => 2,
            'product_sub_section_id' => 1
        ])->pluck('content')->toArray();

        $productConditionsGlasses = ProductCondition::where([
            'product_id' => 1,
            'product_section_id' => 3,
            'product_sub_section_id' => 1
        ])->pluck('content')->toArray();

        $productConditionsStandardFire = ProductCondition::where([
            'product_id' => 1,
            'product_section_id' => 4,
            'product_sub_section_id' => 1
        ])->pluck('content')->toArray();

        // $productConditionsPlate = ProductCondition::where([
        //     'product_id' => 1,
        //     'product_section_id' => 1,
        //     'product_sub_section_id' => 1
        // ])->pluck('content')->toArray();

        // $productConditionsPlate = ProductCondition::where([
        //     'product_id' => 1,
        //     'product_section_id' => 1,
        //     'product_sub_section_id' => 1
        // ])->pluck('content')->toArray();
        // $product = Product::find(1);
        // dd($product->conditions);
        $productSectionName = ProductSection::pluck('name')->toArray();
        $quote = QuoteGenerate::findOrFail($this->id);
        $customer = Customer::findOrFail($quote->customer_id);
        $riskOccupancy = RiskOccupancy::findOrFail($quote->risk_occupancy_id);
    
        // dd($quote);
        // dd($quote->total_sum_insured);
        return view('quote-export', [
            'customer' => $customer,
            'riskOccupancy' => $riskOccupancy,
            'quote' => $quote,
            'productConditionsBurglary'=>$productConditionsBurglary,
            'productConditionsMachinery'=>$productConditionsMachinery,
            'productConditionsGlasses'=>$productConditionsGlasses,
            'productConditionsStandardFire'=>$productConditionsStandardFire,
            'productSectionName'=>$productSectionName
        ]);
    }
}
