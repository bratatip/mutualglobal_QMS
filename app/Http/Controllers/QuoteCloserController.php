<?php

namespace App\Http\Controllers;

use App\Models\ConvertedInsurer;
use App\Models\File;
use App\Models\Policy;
use App\Models\Product;
use App\Models\QuoteGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class QuoteCloserController extends Controller
{
    public function quoteGet($id)
    {

        $quoteId = $id;
        $quotegenerateData = QuoteGenerate::find($id);
        $relatedData = $quotegenerateData->convertedInsurer;

        $isConverted = $quotegenerateData->quoteFinalize->isNotEmpty() ? $quotegenerateData->quoteFinalize : null;

        if ($isConverted == null) {
            return redirect()->back()->with('error', 'Quote Not Converted yet !');
        }


        $products = Product::select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        if (!$relatedData->isEmpty()) {

            // Initialize an array to store insurer names
            $insurerNames = [];

            foreach ($relatedData as $convertedInsurer) {
                // Access the insurer relationship to get the insurer's name
                $insurerName = $convertedInsurer->insurer->name; // Assuming "name" is the column in your "Insurer" model for the insurer's name.
                $insurerNames[] = $insurerName;
            }
            return view('closer', compact('insurerNames', 'relatedData', 'products', 'quoteId'));
            // Now you have an array of insurer names in $insurerNames variable.
            // You can use it as needed.
        } else {
            return redirect()->back()->with('error', 'First Convert the Quote');
            // Handle the case where the QuoteGenerate with the given ID was not found.
            // You might want to return an error response or handle it differently.
        }
    }

    public function policyStore(Request $request)
    {
        $validatedData = $request->validate([
            'policy_number' => 'required|string',
            'policy_start_date' => 'required|string',
            'policy_end_date' => 'required|string',
            'product_id' => 'required|integer',
            'premium_amount' => 'required|integer',
            'file.*' => 'required|file|mimes:pdf,doc,docx',
        ]);

        DB::beginTransaction();

        try {

            $quoteId = $request->quote_id;
            $uploadedFile = $request->file;
            $documentType = "policy";

            $quoteId = $request->quote_id;
            $quoteGenerate = QuoteGenerate::find($quoteId);

            $policiableType = get_class($quoteGenerate);
            $policiableId = $quoteGenerate->id;

            // store the policy details to policy table

            $policyData[] = [
                'uuid' => Uuid::uuid4()->toString(),
                'product_id' => $request->product_id,
                'policiable_type' => get_class($quoteGenerate),
                'policiable_id' => $quoteGenerate->id,
                'policy_number' => $request->policy_number,
                'policy_start_date' => $request->policy_start_date,
                'policy_end_date' => $request->policy_end_date,
                'premium_amount' => $request->premium_amount,
            ];

            if (!empty($policyData)) {
                Policy::insert($policyData);
            }


            // store file data from convert the quote data
            $filesData = [];

            $customerName = str_replace(' ', '', strtolower($quoteGenerate->customer->name));
            $fileName = $customerName . '_' . $documentType . '_' . Uuid::uuid4()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            // $filePath = $uploadedFile->store('uploaded_files'); 
            $filePath = $uploadedFile->storeAs('uploaded_files', $fileName);


            $filesData[] = [
                'uuid' => Uuid::uuid4()->toString(),
                'fileable_type' => get_class($quoteGenerate),
                'fileable_id' => $quoteGenerate->id,
                'document_type' => $documentType,
                'file_path' => $filePath,
            ];


            if (!empty($filesData)) {

                File::insert($filesData);
            }


            DB::commit();

            return response()->json(['message' => 'Data successfully saved'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return response()->json(['message' => 'Error saving data'], 500);
        }
    }
}
