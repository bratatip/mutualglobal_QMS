<?php

namespace App\Http\Controllers;

use App\Models\Insurer;
use App\Models\QuoteFinalize;
use App\Models\QuoteGenerate;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use function PHPUnit\Framework\isEmpty;

class QuoteController extends Controller
{
    public function finalizeQuoteGet($id)
    {
        // $quote = QuoteGenerate::find($id);
        // dd($quote->quoteFinalize);
        $quoteId = $id;
        $insurers = Insurer::select('id', 'name')->orderBy('name', 'asc')->get();
        $quoteFinalizeData = QuoteFinalize::where('finalizable_id', $quoteId)->get();
        foreach ($quoteFinalizeData as $quote) {
            $netPremium = $quote->net_premium;
            $gstPercentage = $quote->gst; // Assuming GST is stored as a percentage
            $totalPremium = $netPremium + ($netPremium * $gstPercentage / 100);
            $quote->total_premium = $totalPremium;
        }
        return view('final', compact('insurers', 'quoteId', 'quoteFinalizeData'));
    }

    // public function finalizeQuote(request $request)
    // {
    //     $validatedData = $request->validate([
    //         'insurer_id.*' => 'required|integer',
    //         'net_premium.*' => 'required|numeric',
    //         'gst.*' => 'required|numeric',
    //         'total_premium.*' => 'required|numeric',
    //     ]);

    //     $quoteId = $request->quote_id;
    //     $quoteGenerate = QuoteGenerate::find($quoteId);



    //     foreach ($validatedData['insurer_id'] as $index => $insurerId) {
    //         $quoteFinalizeData = [
    //             'uuid' => Uuid::uuid4()->toString(),
    //             'finalizable_type' => get_class($quoteGenerate),
    //             'finalizable_id' =>$quoteGenerate->id,
    //             'insurer_id' => $insurerId,
    //             'net_premium' => $validatedData['net_premium'][$index],
    //             'gst' => $validatedData['gst'][$index],
    //         ];

    //         QuoteFinalize::create($quoteFinalizeData);
    //     }

    // }


    public function finalizeQuote(Request $request)
    {
        $validatedData = $request->validate([
            'insurer_id.*' => 'required|integer',
            'net_premium.*' => 'required|numeric',
            'gst.*' => 'required|numeric',
            'total_premium.*' => 'required|numeric',
        ]);

        $quoteId = $request->quote_id;
        $quoteGenerate = QuoteGenerate::find($quoteId);

        // Retrieve all existing records for the given quote
        $existingRecords = QuoteFinalize::where('finalizable_id', $quoteGenerate->id)->get();

        // Loop through existing records and delete those missing in the form
        foreach ($existingRecords as $existingRecord) {
            $insurerId = $existingRecord->insurer_id;

            if (!in_array($insurerId, $validatedData['insurer_id'])) {
                $existingRecord->delete();
            }
        }

        // Loop through form data and add new records or update existing ones
        foreach ($validatedData['insurer_id'] as $index => $insurerId) {
            $netPremium = $validatedData['net_premium'][$index];
            $gst = $validatedData['gst'][$index];
            // $totalPremium = $validatedData['total_premium'][$index];

            // Check if the record exists in the existing records
            $existingRecord = $existingRecords->where('insurer_id', $insurerId)->first();

            if ($existingRecord) {
                // Update the existing record with form data
                $existingRecord->update([
                    'net_premium' => $netPremium,
                    'gst' => $gst,
                    // 'total_premium' => $totalPremium,
                ]);
            } else {
                // Create a new record in the database
                QuoteFinalize::create([
                    'uuid' => Uuid::uuid4()->toString(),
                    'finalizable_type' => get_class($quoteGenerate),
                    'finalizable_id' => $quoteGenerate->id,
                    'insurer_id' => $insurerId,
                    'net_premium' => $netPremium,
                    'gst' => $gst,
                    // 'total_premium' => $totalPremium,
                ]);
            }
        }

        return redirect()->back();
    }




    public function convertQuoteGet($id)
    {
        // $selectedFiles = [];
        $quoteId = $id;
        $quoteData = QuoteGenerate::find($quoteId);
        $isFinalize = $quoteData->quoteFinalize->isNotEmpty() ? $quoteData->quoteFinalize : null;

        if ($isFinalize == null) {
            return redirect()->back()->with('error', 'Quote Not Finalized yet !');
        }

        // $insurers= $quoteData->quoteFinalize;
        $insurerIds = $quoteData->quoteFinalize->pluck('insurer_id')->toArray();
        $insurers = Insurer::select('id', 'name')
            ->whereIn('id', $insurerIds)
            ->orderBy('name', 'asc')
            ->get();

        // dd($insurers);

        return view('convert', compact('insurers', 'quoteId'));
    }
}
