<?php

namespace App\Http\Controllers;

use App\Models\Brokerage;
use App\Models\ConvertedInsurer;
use App\Models\File;
use App\Models\FireQuoteConverted;
use App\Models\Payment;
use App\Models\QuoteGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class QuoteConvertController extends Controller
{
    public function quoteConvert(Request $request)
    {

        $validatedData = $request->validate([
            'quote_id' => 'required|integer',
            'insurer_id.*' => 'required|integer',
            'share_in_percentage.*' => 'required|integer',
            'net_od_premium.*' => 'required|numeric',
            'net_terrorism_premium.*' => 'required|numeric',
            'gst.*' => 'required|numeric',
            'gross_premium.*' => 'required|numeric',
            'brokerage_amount.*' => 'required|numeric',
            'brokerage_rewards.*' => 'required|numeric',
            'transaction_mode.*' => 'required|string',
            'transaction_number.*' => 'required|string',
            'transaction_date.*' => 'required|date',
            'transaction_amount.*' => 'required|numeric',
            'remarks.*' => 'required|string',
            'document_type.*' => 'required',
            'file.*' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,xls,xlsx,csv',
        ]);


        $quoteId = $request->quote_id;
        $quoteGenerate = QuoteGenerate::find($quoteId);
        $convertableType = get_class($quoteGenerate);
        $convertableId = $quoteGenerate->id;


        if (
            Payment::where('paymentable_type', $convertableType)
            ->where('paymentable_id', $convertableId)
            ->exists()
        ) {
            return response()->json(['message' => 'Unauthorize Access'], 400);
        }


        DB::beginTransaction();

        try {

            $quoteId = $request->quote_id;
            $quoteGenerate = QuoteGenerate::find($quoteId);

            $convertableType = get_class($quoteGenerate);
            $convertableId = $quoteGenerate->id;

            // Ensure that insurer_id and share_in_percentage have the same number of elements
            if (count($request->insurer_id) !== count($request->share_in_percentage)) {
                return response()->json(['message' => 'Invalid data'], 400);
            }

            $convertedInsurers = [];

            // Prepare data for bulk insert
            $insertData = [];
            foreach ($request->insurer_id as $key => $insurerId) {
                $shareInPercentage = $request->share_in_percentage[$key];

                $insertData[] = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'convertable_type' => $convertableType,
                    'convertable_id' => $convertableId,
                    'insurer_id' => $insurerId,
                    'share_in_percentage' => $shareInPercentage,
                    'created_at' => now(),
                    // 'updated_at' => now(),
                ];
            }

            // Perform bulk insert
            if (!empty($insertData)) {

                ConvertedInsurer::insert($insertData);
            }

            // Create and store data in the Payment model
            $paymentsData = [];

            foreach ($request->transaction_mode as $key => $mode) {
                $transactionNumbers = $request->transaction_number[$key];
                $transactionDates = $request->transaction_date[$key];
                $transactionAmounts = $request->transaction_amount[$key];
                $remarks = $request->remarks[$key];

                $paymentsData[] = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'paymentable_type' => get_class($quoteGenerate),
                    'paymentable_id' => $quoteGenerate->id,
                    'transaction_number' => $transactionNumbers,
                    'transaction_amount' => $transactionAmounts,
                    'transaction_date' => $transactionDates,
                    'transaction_mode' => $mode,
                    // 'transaction_remarks' => $remarks,
                ];
            }

            if (!empty($paymentsData)) {
                Payment::insert($paymentsData);
            }


            $brokerageData = [];
            // Create and store data in the Brokerage model
            foreach ($request->insurer_id as $key => $insurerId) {
                $brokerageAmount = $request->brokerage_amount[$key];
                $brokerageRewards = $request->brokerage_rewards[$key];

                $brokerageData[] = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'brokerageable_type' => get_class($quoteGenerate),
                    'brokerageable_id' => $quoteGenerate->id,
                    'brokerage_amount' => $brokerageAmount,
                    'brokerage_rewards' => $brokerageRewards,
                ];
            }

            // Perform bulk insert
            if (!empty($brokerageData)) {

                Brokerage::insert($brokerageData);
            }

            // Create and store data in the ConvertedFire model

            $premiumDataFire = [];
            foreach ($request->insurer_id as $key => $insurerId) {
                $netOdPremium = $request->net_od_premium[$key];
                $netTerrorismPremium = $request->net_terrorism_premium[$key];
                $gst = $request->gst[$key];
                $grossPremium = $request->gross_premium[$key];

                $premiumDataFire[] = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'firepremiable_type' => get_class($quoteGenerate),
                    'firepremiable_id' => $quoteGenerate->id,
                    'net_od_premium' => $netOdPremium,
                    'net_terrorism_premium' => $netTerrorismPremium,
                    'gst' => $gst,
                    'gross_premium' => $grossPremium,
                ];
            }

            if (!empty($premiumDataFire)) {

                FireQuoteConverted::insert($premiumDataFire);
            }


            // store file data from convert the quote data
            $filesData = [];

            $documentTypes = $validatedData['document_type'];
            $uploadedFiles = $request->file('file');
            foreach ($documentTypes as $key => $documentType) {
                $uploadedFile = $uploadedFiles[$key];
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
            }

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
