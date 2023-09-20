<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Insurer;
use App\Models\PrimaryEmail;
use App\Models\Product;
use App\Models\QuoteGenerate;
use App\Models\Riskoccupancy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use Ramsey\Uuid\Uuid;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        // Check if the request is an AJAX request
        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            $keyword = $request->filled('keyword') ? $request->input('keyword') : null;
            $customers = Customer::where('name', 'like', '%' . $keyword . '%')
                ->orWhere('contact_person_name', 'like', '%' . $keyword . '%')
                ->orWhere('address', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->orWhere('contact_person_phone', 'like', '%' . $keyword . '%')
                ->orWhere('pan', 'like', '%' . $keyword . '%')
                ->orWhere('gst', 'like', '%' . $keyword . '%')
                ->paginate(6);

            return view('customer-table', compact('customers'));
        } else {
            // Regular page loading
            $customers = Customer::paginate(6);
            return view('customers_list', compact('customers'));
        }
    }

    
    public function addCustomerForm(){
        return view('customer');
    }

    // public function quote()
    // {
    //     $occupancies = RiskOccupancy::all();
    //     $employees = Employee::all();
    //     $products = Product::all();
    //     return view('quote', compact('occupancies', 'employees', 'products'));
    // }


    public function quote($id = null)
    {
        $occupancies = RiskOccupancy::all();
        $employees = Employee::all();
        $products = Product::all();

        if ($id !== null) {
            $quoteData = QuoteGenerate::with('customer', 'riskOccupancy')->find($id);
        } else {
            // If $id is null, it's a fresh input, so create an empty $quoteData
            $quoteData = new QuoteGenerate();
        }

        return view('quote', compact('occupancies', 'employees', 'products', 'quoteData'));
    }


    public function quoteEdit($id)
    {
        $quoteData = QuoteGenerate::with('customer', 'riskOccupancy')->find($id);
        // dd($quoteData->riskOccupancy->risk_occupancy);
        $occupancies = RiskOccupancy::all();
        $employees = Employee::all();
        $products = Product::all();
        return view('quote', compact('occupancies', 'employees', 'products', 'quoteData'));
    }

    // public function quoteStore(Request $request)
    // {
    //     // dd($request->all());
    //     $validatedData = $request->validate([
    //         'customer_id' => 'required',
    //         'risk_location' => 'required',
    //         'risk_occupancy_id' => 'required',
    //         'policy_type' => 'required',
    //         'claim_status' => 'required',
    //         'year_of_claim' => 'nullable',
    //         'cause_of_loss' => 'nullable',
    //         'claim_amount' => 'nullable',
    //         'buildings_and_other_structural_work' => 'nullable',
    //         'plants_and_machines' => 'nullable',
    //         'mbd' => 'nullable',
    //         'electrical_fittings' => 'nullable',
    //         'eei' => 'nullable',
    //         'computer_and_all_movables' => 'nullable',
    //         'furniture_and_fittings' => 'nullable',
    //         'stock_in_process' => 'nullable',
    //         'finished_good' => 'nullable',
    //         'fassade_glasses' => 'nullable',
    //         'pgi' => 'nullable',
    //         'loss_of_rent' => 'nullable',
    //         'no_of_months_loss' => 'nullable',
    //         'business_interuption' => 'nullable',
    //         'bi_no_of_months' => 'nullable',
    //         'basement_risk' => 'required',
    //         'total_sum_insured' => 'required',
    //         'terrorism' => 'nullable',
    //     ]);

    //     // dd($validatedData);
    //     $uuid = Uuid::uuid4()->toString();

    //     $lastQuote = QuoteGenerate::orderBy('id', 'desc')->first();

    //     if ($lastQuote) {
    //         $lastQuoteId = explode('/', $lastQuote->quote_no)[2];
    //         $nextQuoteId = str_pad((int)$lastQuoteId + 1, 4, '0', STR_PAD_LEFT);
    //     } else {
    //         $nextQuoteId = '0001';
    //     }

    //     $quoteId = "MGIB/FIRE/$nextQuoteId";
    //     $dataWithIds = array_merge($validatedData, [
    //         'uuid' => $uuid,
    //         'quote_no' => $quoteId,
    //     ]);
    //     QuoteGenerate::create($dataWithIds);

    //     Session::flash('success', 'Quote saved successfully.');


    //     return redirect()->back();
    // }

    public function quoteStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'customer_id' => 'required',
                'risk_location' => 'required',
                'risk_occupancy_id' => 'required',
                'policy_type' => 'required',
                'claim_status' => 'required',
                'year_of_claim' => 'nullable',
                'cause_of_loss' => 'nullable',
                'claim_amount' => 'nullable',
                'buildings_and_other_structural_work' => 'nullable',
                'plants_and_machines' => 'nullable',
                'mbd' => 'nullable',
                'electrical_fittings' => 'nullable',
                'eei' => 'nullable',
                'computer_and_all_movables' => 'nullable',
                'furniture_and_fittings' => 'nullable',
                'stock_in_process' => 'nullable',
                'finished_good' => 'nullable',
                'fassade_glasses' => 'nullable',
                'pgi' => 'nullable',
                'loss_of_rent' => 'nullable',
                'no_of_months_loss' => 'nullable',
                'business_interuption' => 'nullable',
                'bi_no_of_months' => 'nullable',
                'basement_risk' => 'required',
                'total_sum_insured' => 'required',
                'terrorism' => 'nullable',
            ]);

            // Check if an 'id' or 'quote_id' field is present in the request
            // $quoteId = $request->input('customer_id') ?: $request->input('quote_id');
            $quoteId = $request->input('quote_id') ?? null;
            if ($quoteId != null) {
                // Update existing quote
                $quote = QuoteGenerate::find($quoteId);

                if (!$quote) {
                    throw new \Exception('Quote not found.');
                }

                $quote->update($validatedData);
                Session::flash('success', 'Quote updated successfully.');
            } else {
                // Create a new quote
                $uuid = Uuid::uuid4()->toString();
                $lastQuote = QuoteGenerate::orderBy('id', 'desc')->first();

                if ($lastQuote) {
                    $lastQuoteId = explode('/', $lastQuote->quote_no)[2];
                    $nextQuoteId = str_pad((int)$lastQuoteId + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $nextQuoteId = '0001';
                }

                $quoteId = "MGIB/FIRE/$nextQuoteId";
                $dataWithIds = array_merge($validatedData, [
                    'uuid' => $uuid,
                    'quote_no' => $quoteId,
                ]);

                QuoteGenerate::create($dataWithIds);
                Session::flash('success', "Quote saved successfully. $quoteId");
            }

            return redirect()->back();
        } catch (\Exception $e) {
            // Handle exceptions here
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function quoteList(Request $request)
    {
        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {

            $keyword = $request->filled('keyword') ? $request->input('keyword') : null;

            $quotes = QuoteGenerate::with(['policy', 'convertedInsurer.insurer'])
                ->leftJoin('policies', function ($join) {
                    $join->on('policies.policiable_id', '=', 'quote_generate.id')
                        ->where('policies.policiable_type', '=', QuoteGenerate::class);
                })
                ->leftJoin('converted_insurers', function ($join) {
                    $join->on('converted_insurers.convertable_id', '=', 'quote_generate.id')
                        ->where('converted_insurers.convertable_type', '=', QuoteGenerate::class);
                })
                ->leftJoin('insurers', 'insurers.id', '=', 'converted_insurers.insurer_id')
                ->leftJoin('customers', 'customers.id', '=', 'quote_generate.customer_id')
                ->where(function ($query) use ($keyword) {
                    $query->where('quote_generate.quote_no', 'like', "%$keyword%")
                        ->orWhere('insurers.name', 'like', "%$keyword%")
                        ->orWhere('customers.name', 'like', "%$keyword%")
                        ->orWhere('customers.pan', 'like', "%$keyword%")
                        ->orWhere('policies.policy_number', 'like', "%$keyword%");
                })
                ->select(
                    'quote_generate.*',
                    'policies.policy_number',
                    DB::raw('IFNULL(MAX(converted_insurers.share_in_percentage), 0) as max_share_in_percentage')
                )
                ->groupBy('quote_generate.id', 'policies.policy_number')
                ->paginate(10);


            $quotes->each(function ($quote) {
                $maxShare = $quote->max_share_in_percentage;

                $quote->insurer_name = Insurer::join('converted_insurers', 'insurers.id', '=', 'converted_insurers.insurer_id')
                    ->where('converted_insurers.convertable_id', $quote->id)
                    ->where('converted_insurers.convertable_type', QuoteGenerate::class)
                    ->where('converted_insurers.share_in_percentage', $maxShare)
                    ->value('insurers.name');
            });

            return view('quote.common.quote_table', compact('quotes'));
        } else {
            $quotes = QuoteGenerate::with(['policy', 'convertedInsurer.insurer'])
                ->leftJoin('policies', function ($join) {
                    $join->on('policies.policiable_id', '=', 'quote_generate.id')
                        ->where('policies.policiable_type', '=', QuoteGenerate::class);
                })
                ->leftJoin('converted_insurers', function ($join) {
                    $join->on('converted_insurers.convertable_id', '=', 'quote_generate.id')
                        ->where('converted_insurers.convertable_type', '=', QuoteGenerate::class);
                })
                ->select(
                    'quote_generate.*',
                    'policies.policy_number',
                    DB::raw('IFNULL(MAX(converted_insurers.share_in_percentage), 0) as max_share_in_percentage')
                )
                ->groupBy('quote_generate.id', 'policies.policy_number')
                ->paginate(10);

            $quotes->each(function ($quote) {
                $maxShare = $quote->max_share_in_percentage;

                $quote->insurer_name = Insurer::join('converted_insurers', 'insurers.id', '=', 'converted_insurers.insurer_id')
                    ->where('converted_insurers.convertable_id', $quote->id)
                    ->where('converted_insurers.convertable_type', QuoteGenerate::class)
                    ->where('converted_insurers.share_in_percentage', $maxShare)
                    ->value('insurers.name');
            });
            return view('quote_list', compact('quotes'));
        }
    }


    public function quoteView($id)
    {
        $quote = QuoteGenerate::findOrFail($id);
        $customer = Customer::findOrFail($quote->customer_id);
        $riskOccupancy = Riskoccupancy::findOrFail($quote->risk_occupancy_id);
        // dd($quote);
        return view('quote_view', compact('quote', 'customer', 'riskOccupancy'));
    }


    public function store(CustomerRequest $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:customers',
        //     'address' => 'required',
        //     'phone_no' => 'required',
        //     'contact_person' => 'required',
        //     'pin' => 'required|digits:6',
        //     'pan' => 'nullable|unique:customers,pan',
        //     'gst' => 'nullable|unique:customers,gst',
        // ]);


        $validatedData = $request->validated();
        Customer::create($validatedData);
        // session()->set('success','Item is successfully created.');  


        return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
    }

    // public function searchCustomers(Request $request)
    // {
    //     $query = $request->input('q');

    //     // Replace with actual customer data retrieval logic
    //     $matchingCustomers = Customer::where('name', 'LIKE', '%' . $query . '%')->get();
    //     return response()->json([
    //         'data' => $matchingCustomers
    //     ]);
    // }

    public function getCustomers($id)
    {
        $customer = Customer::findOrFail($id);
        return view('view', compact('customer'));
    }

    public function destroyCustomre($id)
    {

        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully.');
    }

    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view('edit_customer', compact('customer'));
    }

    // 
    public function updateCustomer(CustomerRequest $request, $id)
    {
        $validatedData = $request->validated();
        $customer = Customer::findOrFail($id);
        $customer->update($validatedData);
        return redirect()->route('customer.index')->with('success', 'Customer updated successfully!');
    }

    // pdf generate
}
