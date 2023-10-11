<?php

namespace App\Http\Controllers\Quote\Car;

use App\Http\Controllers\Controller;
use App\Models\RiskOccupancy;
use Illuminate\Http\Request;

class CarQuoteController extends Controller
{
    public function formView()
    {
        try {
            $dummyData = [
                [
                    'category' => 'Category 1',
                    'subcategories' => ['Subcategory 1.1', 'Subcategory 1.2', 'Subcategory 1.3'],
                ],
                [
                    'category' => 'Category 2',
                    'subcategories' => ['Subcategory 2.1', 'Subcategory 2.2', 'Subcategory 2.3'],
                ],
                [
                    'category' => 'Category 3',
                    'subcategories' => ['Subcategory 3.1', 'Subcategory 3.2'],
                ],
            ];

            $occupancies = RiskOccupancy::all();
            return view('quote.quoteCar.quoteCarForm', compact('occupancies', 'dummyData'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            dd($errorMessage);
            return back()->with('error', $errorMessage);
        }
    }

    public function quoteStore(Request $request)
    {
        try {
            dd($request->all());
            return back()->with('success', 'hi !');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            dd($errorMessage);
            return back()->with('error', $errorMessage);
        }
    }
}
