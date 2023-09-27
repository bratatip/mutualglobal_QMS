<?php

namespace App\Http\Controllers;

use App\Exports\ExportCustomer;
use App\Jobs\NotificationToCustomerCloserJob;
use App\Jobs\NotificationToInsurerConvertJob;
use App\Jobs\NotificationToInsurerJob;
use App\Models\CCEmail;
use App\Models\Customer;
use App\Models\Insurer;
use App\Models\PrimaryEmail;
use App\Models\Product;
use App\Models\QuoteGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class NotificationController extends Controller
{
    public function createNotificationForm($id)
    {
        $quoteInfo= QuoteGenerate::where('uuid', '=',$id)->first();
        $insurers = Insurer::get()->all();

        // $templatePath = base_path('resources/views/admin/email/custom_notification.blade.php');
        $templatePath = file_get_contents(resource_path('views/admin/email/custom_notification.blade.php'));

        $template = strip_tags($templatePath);


        return view('notification-form', compact('quoteInfo', 'insurers', 'template'));
    }

    public function sendNotification(Request $request)
    {
        $validatedData = $request->validate([
            'emailData' => 'required',
        ], [
            'emailData.required' => 'Please Select Insurer and Try Again !', 
        ]);
        
        // dd($emailBody);

        // $toEmailsString = $request->toEmails;
        // $toEmailsArray = explode(', ', $toEmailsString);

        // $ccEmailsString = $request->ccEmails;
        // $ccEmailsArray = explode(', ', $ccEmailsString);

        $emailDataJson = $request->input('emailData');
        $emailData = json_decode($emailDataJson);

        $inputEmails = $request->toMails;
        $pattern = '/[,;\s]+/';

        $emailAddresses = preg_split($pattern, $inputEmails);

        foreach ($emailAddresses as $email) {
            $email = trim($email); // Remove leading/trailing spaces
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailData[] = (object)[
                    'toEmail' => $email,
                    'ccEmails' => [],
                ];
            }
        }


        $id = $request->customerInfo;
        $quote = QuoteGenerate::findOrFail($id);
        $customer = Customer::findOrFail($quote->customer_id);

        $defaultSubject = $customer->name . ', FIRE ,' . $quote->policy_type ;

        $emailSubject = $request->subject ?? $defaultSubject;
        $emailBody = $request->message;




        // generate excel file
        $customerNameWithoutSpaces = str_replace(' ', '_', $customer->name);

        $excelFileName = $customerNameWithoutSpaces . '.xlsx';
        $excelFilePath = 'temp_attachments/' . $excelFileName;

        Excel::store(new ExportCustomer($id), $excelFilePath);

        // $selectedEmails = $request->input('email');
        $attachmentPath = $excelFilePath;
        // $attachmentPath = $attachment->store('temp_attachments');

        foreach ($emailData as $data) {
            $toEmail = $data->toEmail;
            $ccEmails = $data->ccEmails;

            // $ccEmails = "hello@yopmail.com";
            // Send notification to primary recipient with CC recipients
            dispatch(new NotificationToInsurerJob($toEmail, $ccEmails, $emailSubject, $emailBody, $attachmentPath));
        }

        // foreach ($selectedEmails as $email) {
        //     dispatch(new NotificationToInsurerJob($email, $attachmentPath));
        // }
        Storage::delete($excelFilePath);
        return redirect()->back()->with('success', 'Email sent with attachment.');
    }



    public function getEmails(Request $request)
    {
        $selectedInsurerIds  = $request->input('insurerIds');
        $productId = $request->input('productId');
        
        $toEmails = [];
        $ccEmails = [];
        $emailData = [];

        $primaryEmails = PrimaryEmail::whereHas('insurer', function ($query) use ($selectedInsurerIds) {
            $query->whereIn('id', $selectedInsurerIds);
        })->whereHas('products', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })->with('ccEmails')->get();

        foreach ($primaryEmails as $primaryEmail) {
            $toEmails[] = $primaryEmail->email; // Assuming the email field is 'email'
            foreach ($primaryEmail->ccEmails as $ccEmail) {
                $ccEmails[] = $ccEmail->email; // Assuming the email field is 'email'
            }
        }

        $allCcEmails = implode(', ', $ccEmails);


        // object email and cc emails


        foreach ($primaryEmails as $primaryEmail) {
            $toEmail = $primaryEmail->email; // Assuming the email field is 'email'
            $ccEmails = [];

            foreach ($primaryEmail->ccEmails as $ccEmail) {
                $ccEmails[] = $ccEmail->email; // Assuming the email field is 'email'
            }

            $emailData[] = [
                'toEmail' => $toEmail,
                'ccEmails' => $ccEmails,
            ];
        }

        return response()->json([
            'toEmails' => implode(', ', $toEmails),
            'ccEmails' => $allCcEmails,
            'emailData' => $emailData,

            // 'toEmails' => $toEmails,
            // 'ccEmails' => $ccEmails,
        ]);
    }


    public function emailToInsurerClient($id)
    {
        $quoteData = QuoteGenerate::find($id);
        $quoteId = $id;
        $relatedInsurerData = $quoteData->convertedInsurer;
        $selectedInsurerIds = $relatedInsurerData->pluck('insurer_id')->all();

        $productId = 1;

        $toEmails = [];
        $ccEmails = [];
        $emailData = [];

        $primaryEmails = PrimaryEmail::whereHas('insurer', function ($query) use ($selectedInsurerIds) {
            $query->whereIn('id', $selectedInsurerIds);
        })->whereHas('products', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })->with('ccEmails')->get();

        foreach ($primaryEmails as $primaryEmail) {
            $toEmails[] = $primaryEmail->email; // Assuming the email field is 'email'
            foreach ($primaryEmail->ccEmails as $ccEmail) {
                $ccEmails[] = $ccEmail->email; // Assuming the email field is 'email'
            }
        }
        $alltoEmails = implode(',', $toEmails);
        $allCcEmails = implode(', ', $ccEmails);




        foreach ($primaryEmails as $primaryEmail) {
            $toEmail = $primaryEmail->email;
            $ccEmails = [];

            foreach ($primaryEmail->ccEmails as $ccEmail) {
                $ccEmails[] = $ccEmail->email;
            }

            $emailData[] = [
                'toEmail' => $toEmail,
                'ccEmails' => $ccEmails,
            ];
        }
        return view('emailToInsurerClient', compact('allCcEmails', 'alltoEmails', 'emailData', 'quoteId'));
    }


    public function emailToInsurerClientSend(Request $request)
    {

        $emailDataJson = $request->input('emailData');
        $emailData = json_decode($emailDataJson);

        $quoteData = QuoteGenerate::find($request->quoteId);
        $relatedFiles = $quoteData->file;
        $filteredFiles = $relatedFiles->filter(function ($file) {
            return $file->document_type !== 'policy';
        });

        $files = $filteredFiles->pluck('file_path', 'document_type')->all();
        foreach ($emailData as $data) {
            $toEmail = $data->toEmail;
            $ccEmails = $data->ccEmails;
            $attachmentPaths = array_values($files);

            dispatch(new NotificationToInsurerConvertJob($toEmail, $ccEmails, $attachmentPaths));
        }
        return redirect('/quote_list');
    }


    public function emailToCustomer($id)
    {
        $quoteData = QuoteGenerate::find($id);
        $alltoEmails = $quoteData->customer->email;
        // dd($quoteData->customer->email);
        $quoteId = $id;
        return view('emailToInsurerClient', compact('alltoEmails', 'quoteId'));
    }

    public function emailToCustomerSend(Request $request)
    {
        $quoteData = QuoteGenerate::find($request->quoteId);
        $relatedFiles = $quoteData->file;
        $filteredFiles = $relatedFiles->filter(function ($file) {
            return $file->document_type == 'policy';
        });

        $files = $filteredFiles->pluck('file_path', 'document_type')->all();

        $toEmail = $request->toEmails;
        $attachmentPaths = array_values($files);
        $attachmentPath = isset($attachmentPaths[0]) ? $attachmentPaths[0] : '';

        dispatch(new NotificationToCustomerCloserJob($toEmail, $attachmentPath));

        return redirect('/quote_list');
    }


    //     public function getEmails(Request $request)
    // {
    //     $selectedInsurerIds = $request->input('insurerIds');
    //     $productId = $request->input('productId');

    //     $emailData = []; // Initialize an array to store email data

    //     $primaryEmails = PrimaryEmail::whereHas('insurer', function ($query) use ($selectedInsurerIds) {
    //         $query->whereIn('id', $selectedInsurerIds);
    //     })->whereHas('products', function ($query) use ($productId) {
    //         $query->where('product_id', $productId);
    //     })->with('ccEmails')->get();

    //     foreach ($primaryEmails as $primaryEmail) {
    //         $toEmail = $primaryEmail->email; // Assuming the email field is 'email'
    //         $ccEmails = [];

    //         foreach ($primaryEmail->ccEmails as $ccEmail) {
    //             $ccEmails[] = $ccEmail->email; // Assuming the email field is 'email'
    //         }

    //         $emailData[] = [
    //             'toEmail' => $toEmail,
    //             'ccEmails' => $ccEmails,
    //         ];
    //     }
    //     dd($emailData);
    //     return response()->json([
    //         'emailData' => $emailData,
    //     ]);
    // }

}
