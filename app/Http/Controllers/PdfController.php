<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\View;
use App\Models\QuoteGenerate;
use App\Models\Customer;
use App\Models\ProductCondition;
use App\Models\ProductSection;
use App\Models\QuoteFinalize;
use App\Models\RiskOccupancy;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class PdfController extends Controller
{
    public function generatePDF($id)
    {
        try {
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


            $productSectionName = ProductSection::pluck('name')->toArray();
            $quote = QuoteGenerate::with(['user', 'product'])->findOrFail($id);
            $customer = Customer::findOrFail($quote->customer_id);
            $riskOccupancy = RiskOccupancy::findOrFail($quote->risk_occupancy_id);
            $finalizedInsurers = $quote->quoteFinalize;

            $customerName = implode('', array_map('ucwords', explode(' ', $customer->name)));
            $productName = implode('', array_map('ucwords', explode(' ', $quote->product->name)));

            $fileName = "{$customerName}-{$productName}-quote.pdf";


            if (!$finalizedInsurers->isEmpty()) {
                $insurerNames = [];

                foreach ($finalizedInsurers as $finalizedInsurer) {
                    // Access the insurer relationship to get the insurer's name
                    $insurerName = $finalizedInsurer->insurer->name; // Assuming "name" is the column in your "Insurer" model for the insurer's name.
                    $insurerNames[] = $insurerName;
                }
            }
            $pdf = PDF::loadView('pdf_quote', [
                'customer' => $customer,
                'riskOccupancy' => $riskOccupancy,
                'quote' => $quote,
                'productConditionsBurglary' => $productConditionsBurglary,
                'productConditionsMachinery' => $productConditionsMachinery,
                'productConditionsGlasses' => $productConditionsGlasses,
                'productConditionsStandardFire' => $productConditionsStandardFire,
                'productSectionName' => $productSectionName,
                'finalizedInsurers' => $finalizedInsurers
            ]);

            return $pdf->download($fileName, ['Attachment' => false]);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return back()->with('error', $errorMessage);
        }
    }
}
