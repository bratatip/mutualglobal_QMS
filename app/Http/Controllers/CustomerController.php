<?php

namespace App\Http\Controllers;

use App\Helpers\UuidGeneratorHelper;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Insurer;
use App\Models\Policy;
use App\Models\PrimaryEmail;
use App\Models\Product;
use App\Models\QuoteGenerate;
use App\Models\RiskOccupancy;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use PDF;
use Ramsey\Uuid\Uuid;

use function PHPUnit\Framework\isEmpty;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminOrEmployee');
        $this->middleware('admin')->only('destroyCustomre');
    }

    public function index(Request $request)
    {
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
            $customers = Customer::paginate(6);
            return view('customers_list', compact('customers'));
        }
    }


    public function addCustomerForm()
    {
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
        // $productId = Product::where('uuid', '=', $id)->pluck('id')->first();
        $productId = $id;
        $occupancies = RiskOccupancy::all();
        $employees = User::get();
        $products = Product::all();
        $quoteData = new QuoteGenerate();
        
        // if ($id !== null) {
        //     $quoteData = QuoteGenerate::with('customer', 'riskOccupancy')->find($id);
        // } else {
        //     // If $id is null, it's a fresh input, so create an empty $quoteData
        //     $quoteData = new QuoteGenerate();
        // }

        // return view('quote', compact('occupancies', 'employees', 'products', 'quoteData', 'productId'));
        return view('quote.quoteFire.quoteFire', compact('occupancies', 'employees', 'products', 'quoteData', 'productId'));
    }


    public function quoteEdit($id)
    {
        $quoteData = QuoteGenerate::with('customer', 'riskOccupancy')->find($id);
        $occupancies = RiskOccupancy::all();
        $employees = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->whereIn('roles.name', ['admin', 'employee'])
            ->select('users.uuid', 'users.name', 'users.email', 'users.phone')
            ->get();
        $products = Product::all();
        // return view('quote', compact('occupancies', 'employees', 'products', 'quoteData'));
        return view('quote.quoteFire.quoteFire', compact('occupancies', 'employees', 'products', 'quoteData'));
    }

    public function quoteStore(Request $request)
    {
        $basementRisk = (bool) $request->input('basement_risk');
        $claimStatus = (bool) $request->input('claim_status');
        $terrorism = (bool) $request->input('terrorism');
        $burglary = (bool) $request->input('burglary');
        try {
            $validatedData = $request->validate([
                'customer_id' => 'required|string',
                'product_id' => 'required|string',
                'rm_id' => 'required|string',
                'risk_location' => 'required|string',
                'risk_occupancy_id' => 'required|string',

                'policy_type' => 'required|string',

                'claim_status' => 'required|boolean',
                'year_of_claim' => 'required_if:claim_status,1|nullable|string',
                'cause_of_loss' => 'required_if:claim_status,1|nullable|string',
                'claim_amount' => 'required_if:claim_status,1|nullable|between:0,9999999999999.99',

                'buildings_and_other_structural_work' => 'nullable|numeric',
                'plants_and_machines' => 'nullable|numeric',
                'mbd' => 'nullable|numeric',
                'electrical_fittings' => 'nullable|numeric',
                'eei' => 'nullable|numeric',
                'computer_and_all_movables' => 'nullable|numeric',
                'furniture_and_fittings' => 'nullable|numeric',
                'stock_in_process' => 'nullable|numeric',
                'finished_good' => 'nullable|numeric',
                'fassade_glasses' => 'nullable|numeric',
                'pgi' => 'nullable|numeric',
                'loss_of_rent' => 'nullable|numeric',
                'no_of_months_loss' => 'nullable|integer',
                'business_interuption' => 'nullable|integer',
                'bi_no_of_months' => 'nullable|integer',
                'basement_risk' => 'required|boolean',

                'total_sum_insured' => 'required|numeric',
                'terrorism' => 'required|boolean',
                'burglary' => 'required|boolean',

                'cash_in_counter' => 'nullable|numeric',
                'cash_in_transit' => 'nullable|numeric',
                'cash_in_safe' => 'nullable|numeric',
                'psl' => 'nullable|numeric',
            ]);

            $productId = Product::where('uuid', '=', $validatedData['product_id'])->pluck('id')->first() ?? null;
            $customerId = Customer::where('uuid', '=', $validatedData['customer_id'])->pluck('id')->first() ?? null;
            $riskOccupancyId = RiskOccupancy::where('uuid', '=', $validatedData['risk_occupancy_id'])->pluck('id')->first() ?? null;
            $rmId = User::where('uuid', '=', $validatedData['rm_id'])->pluck('id')->first() ?? null;

            $validatedData['product_id'] = $productId;
            $validatedData['customer_id'] = $customerId;
            $validatedData['risk_occupancy_id'] = $riskOccupancyId;
            $validatedData['rm_id'] = $rmId;

            $quoteId = $request->input('quote_id') ?? null;
            if ($quoteId != null) {
                $quote = QuoteGenerate::find($quoteId);

                if (!$quote) {
                    throw new \Exception('Quote not found.');
                }

                $quote->update($validatedData);
                $message =  "Quote updated successfully";
            } else {
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
                $message =  "Quote saved successfully. $quoteId";
            }

            return redirect()->back()->with('success', $message);
        } catch (ValidationException $e) {
            $validationErrors = $e->validator->errors()->all();
            dd($validationErrors);
        } catch (\Exception $e) {
            // Handle other exceptions
            dd($e->getMessage());
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
        $quote = QuoteGenerate::with('convertedInsurer')->where('uuid', '=', $id)->first();
        $customer = Customer::findOrFail($quote->customer_id);
        $riskOccupancy = RiskOccupancy::findOrFail($quote->risk_occupancy_id);
        return view('quote_view', compact('quote', 'customer', 'riskOccupancy'));
    }


    public function store(CustomerRequest $request)
    {
        $lastCustomer = Customer::latest()->first();
        $nextCustomerId = $lastCustomer
            ? str_pad($lastCustomer->customer_id + 1, strlen($lastCustomer->customer_id), '0', STR_PAD_LEFT)
            : '001';
        $validatedData = $request->validated();
        $validatedData['uuid'] = UuidGeneratorHelper::generateUniqueUuidForTable('customers');
        $validateData['customer_id'] = $nextCustomerId;
        Customer::create($validatedData);

        return redirect()->route('customer.index')->with('success', 'Customer added successfully!');
    }

    public function searchCustomers(Request $request)
    {
        $query = $request->input('q');

        $matchingCustomers = Customer::where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json([
            'data' => $matchingCustomers
        ]);
    }

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

    public function quoteAutopopulateOnRenew(Request $request)
    {
        $query = $request->input('q');
        $policyData = Policy::join('quote_generate', 'policies.policiable_id', '=', 'quote_generate.id')
            ->join('customers', 'quote_generate.customer_id', '=', 'customers.id')
            ->select('policies.policy_number', 'quote_generate.*', 'customers.*')
            ->where('policies.policy_number', 'LIKE', '%' . $query . '%')
            ->get();

        return response()->json([
            'data' => $policyData
        ]);
    }
}
