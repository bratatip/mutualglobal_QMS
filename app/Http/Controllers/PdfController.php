<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteTempFileJob;
use App\Jobs\NotificationToCustomerFinalJob;
use Illuminate\Http\Request;
use PDF;
use App\Models\QuoteGenerate;
use App\Models\Customer;
use App\Models\ProductCondition;
use App\Models\ProductSection;
use App\Models\RiskOccupancy;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function generatePDF(Request $request, $id)
    {
        try {
            $condition = $request->query('condition');

            $quote = QuoteGenerate::with(['user', 'product'])->findOrFail($id);
            $productConditionsBurglary = ProductCondition::whereHas('product', function ($query) use ($quote) {
                $query->where('id', $quote->product_id);
            })
                ->whereHas('productSection', function ($query) {
                    $query->where('name', 'Burglary Coverage terms and Conditions');
                })
                ->whereHas('productSubSection', function ($query) {
                    $query->where('name', 'Excess');
                })
                ->pluck('content')
                ->toArray();

            $productConditionsMachinery = ProductCondition::whereHas('product', function ($query) use ($quote) {
                $query->where('id', $quote->product_id);
            })
                ->whereHas('productSection', function ($query) {
                    $query->where('name', 'Machinery Breakdown Terms and Conditions');
                })
                ->whereHas('productSubSection', function ($query) {
                    $query->where('name', 'Excess');
                })
                ->pluck('content')
                ->toArray();

            $productConditionsGlasses = ProductCondition::whereHas('product', function ($query) use ($quote) {
                $query->where('id', $quote->product_id);
            })
                ->whereHas('productSection', function ($query) {
                    $query->where('name', 'Plate Glass Insurance Terms and Conditions');
                })
                ->whereHas('productSubSection', function ($query) {
                    $query->where('name', 'Excess');
                })
                ->pluck('content')
                ->toArray();

            $productConditionsStandardFire = ProductCondition::whereHas('product', function ($query) use ($quote) {
                $query->where('id', $quote->product_id);
            })
                ->whereHas('productSection', function ($query) {
                    $query->where('name', 'Standard Fire & Special Perils Policy Conditions');
                })
                ->whereHas('productSubSection', function ($query) {
                    $query->where('name', 'Excess');
                })
                ->pluck('content')
                ->toArray();


            $productConditionsStandardFireClauses = ProductCondition::whereHas('product', function ($query) use ($quote) {
                $query->where('id', $quote->product_id);
            })
                ->whereHas('productSection', function ($query) {
                    $query->where('name', 'Standard Fire & Special Perils Policy Conditions');
                })
                ->whereHas('productSubSection', function ($query) {
                    $query->where('name', 'Clauses');
                })
                ->pluck('content')
                ->toArray();


            $productConditionsStandardFireConditionsWarranties = ProductCondition::whereHas('product', function ($query) use ($quote) {
                $query->where('id', $quote->product_id);
            })
                ->whereHas('productSection', function ($query) {
                    $query->where('name', 'Standard Fire & Special Perils Policy Conditions');
                })
                ->whereHas('productSubSection', function ($query) {
                    $query->where('name', 'Conditions/Warranties');
                })
                ->pluck('content')
                ->toArray();


            $productSectionName = ProductSection::pluck('name')->toArray();
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
                'productConditionsStandardFireClauses' => $productConditionsStandardFireClauses,
                'productConditionsStandardFireConditionsWarranties' => $productConditionsStandardFireConditionsWarranties,
                'productSectionName' => $productSectionName,
                'finalizedInsurers' => $finalizedInsurers
            ]);

            if ($condition === 'true') {
                try {
                    $tempPdfPath = 'temp_attachments/' . $fileName;
                    Storage::put($tempPdfPath, $pdf->output());

                    $toEmail = is_array($quote->customer->email) ? implode(', ', $quote->customer->email) : $quote->customer->email;
                    $attachmentPaths = $tempPdfPath;

                    dispatch(new NotificationToCustomerFinalJob($toEmail, $attachmentPaths));

                    Queue::later(now()->addSeconds(120), new DeleteTempFileJob($tempPdfPath));

                    return back();
                    // Storage::delete($tempPdfPath);
                } catch (\Exception $e) {
                    $errorMessage = $e->getMessage();
                    return back()->with('error', $errorMessage);
                }
            } else {
                return $pdf->download($fileName, ['Attachment' => false]);
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return back()->with('error', $errorMessage);
        }
    }
}
