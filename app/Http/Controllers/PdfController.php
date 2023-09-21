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
            $quote = QuoteGenerate::findOrFail($id);
            $customer = Customer::findOrFail($quote->customer_id);
            $riskOccupancy = RiskOccupancy::findOrFail($quote->risk_occupancy_id);
            $finalizedInsurers = $quote->quoteFinalize;
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
            // $pdfPath = storage_path('app\\temp_attachments\\quote_' . $quote->id . '.pdf');
            // $pdf->save($pdfPath);
            // $response = Response::json(['pdf_path' => $pdfPath]);

            // File::delete($pdfPath);

            // return $response;

            // $pdf->getDomPDF()->set_option("isHtml5ParserEnabled", true);
            // $pdf->getDomPDF()->set_option("isPhpEnabled", true);

            // // Render the PDF as a response with appropriate headers

            // return $pdf->stream('quote.pdf', ['Attachment' => false]);
            return $pdf->download('quote.pdf', ['Attachment' => false]);
        } catch (\Exception $e) {
            // Handle the exception here
            // For example, you can log the error and return a user-friendly error message or redirect
            // You can also customize this part based on your error handling requirements
            return Response::json(['error' => $e->getMessage()], 500);
        }
    }
}
