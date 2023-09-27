<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UuidGeneratorHelper;
use App\Http\Controllers\Controller;
use App\Imports\RiskOccupancyImport;
use App\Models\Category;
use App\Models\CCEmail;
use App\Models\Insurer;
use App\Models\PrimaryEmail;
use App\Models\PrimaryEmailCategory;
use App\Models\PrimaryEmailCcEmail;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Models\ProductSection;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Contracts\Service\Attribute\Required;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function addRiskOccupancy()
    {
        return view('admin.settings.risk_occupancy');
    }

    public function storeRiskOccupancy(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            $file = $request->file('excel_file');
            Excel::import(new RiskOccupancyImport, $file);
            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }

    public function storeProductSections(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|exists:products,name',
            'product_section_name' => 'required|string|max:225',
        ]);
        DB::beginTransaction();
        try {
            $uuid = UuidGeneratorHelper::generateUniqueUuidForTable('product_sections');
            $productSection = ProductSection::create([
                'uuid' =>  $uuid,
                'product_id' => Product::where('name', '=', $validatedData['product_name'])->pluck('id')->first(),
                'name' => $validatedData['product_section_name'],
            ]);

            DB::commit();

            return back()->with('success', 'Product Section added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage(); // Capture the error message
            return back()->with('error', $errorMessage);
        }
    }

    # Product Management
    public function manageProducts()
    {
        $categories = Category::with('products')->get();

        return view('admin.settings.manage_products', compact('categories'));
    }

    public function storeCategory(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
        DB::beginTransaction();
        try {
            $uuid = UuidGeneratorHelper::generateUniqueUuidForTable('categories');
            $user = Category::create([
                'uuid' =>  $uuid,
                'name' => $validatedData['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::commit();

            return back()->with('success', 'Category added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage(); // Capture the error message
            return back()->with('error', $errorMessage);
        }
    }

    public function storeProducts(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
        ]);
        $data = $validatedData;
        DB::beginTransaction();
        try {
            $categoryId = Category::where('name', '=', $data['category_name'])->pluck('id')->first();
            $uuid = UuidGeneratorHelper::generateUniqueUuidForTable('categories');
            $user = Product::create([
                'uuid' =>  $uuid,
                'name' => $data['name'],
                'category_id' => $categoryId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::commit();

            return back()->with('success', 'Category added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage(); // Capture the error message
            return back()->with('error', $errorMessage);
        }
    }

    # Manage Insurers and Emails
    public function manageInsurersAndEmails()
    {
        $roles = Role::whereIn('name', ['admin', 'employee'])->pluck('id');
        $CcEmails = User::whereIn('role_id', $roles)->pluck('email');
        $categories = Category::with('products')->get();
        $products = Product::get();
        $insurers = Insurer::get();

        return view('admin.settings.manage_insurers_emails', compact('categories', 'products', 'insurers', 'CcEmails'));
    }

    public function storeInsurers(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:insurers,name',
        ]);

        $data = $validatedData;
        DB::beginTransaction();
        try {
            $uuid = UuidGeneratorHelper::generateUniqueUuidForTable('insurers');
            $insurer = Insurer::create([
                'uuid' =>  $uuid,
                'name' => $data['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::commit();

            return back()->with('success', 'Category added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage(); // Capture the error message
            return back()->with('error', $errorMessage);
        }
    }

    public function storeEmails(Request $request)
    {
        $validatedData = $request->validate([
            'insurer_name' => 'required|string|max:255|exists:insurers,name',
            'product_name' => 'required|string|max:255|exists:products,name',
            'primary_email' => 'required|email',
            'Cc_emails.*' => 'required|email|exists:users,email',
            'custome_cc_emails' => [
                'nullable',
                'regex:/^[\w\.-]+@[\w\.-]+(?:[, ]+[\w\.-]+@[\w\.-]+)*$/',
            ],
        ]);

        $data = $validatedData;

        if (!empty($data['custome_cc_emails'])) {
            $customCCEmails = explode(',', $data['custome_cc_emails']);
            $customCCEmails = array_map('trim', $customCCEmails);
            $data['Cc_emails'] = array_merge($data['Cc_emails'], $customCCEmails);
        }


        $insurerId = Insurer::where('name', '=', $data['insurer_name'])->pluck('id')->first();
        $productId = Product::where('name', '=', $data['product_name'])->pluck('id')->first();


        DB::beginTransaction();
        try {
            if (!empty($data['Cc_emails'])) {
                foreach ($data['Cc_emails'] as $ccEmail) {
                    $ccEmailRecord = CCEmail::create([
                        'uuid' => UuidGeneratorHelper::generateUniqueUuidForTable('c_c_emails'),
                        'email' => $ccEmail,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    $ccEmailIds[] = $ccEmailRecord->id;
                }
            }


            $primaryEmails = PrimaryEmail::create([
                'uuid' => UuidGeneratorHelper::generateUniqueUuidForTable('primary_emails'),
                'email' => $data['primary_email'],
                'insurer_id' => $insurerId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $primaryEmailsCategory = PrimaryEmailCategory::create([
                'uuid' => UuidGeneratorHelper::generateUniqueUuidForTable('primary_email_category'),
                'primary_email_id' =>  $primaryEmails->id,
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);


            if (!empty($ccEmailIds)) {
                foreach ($ccEmailIds as $ccEmailId) {
                    $primaryEmailCcEmails = PrimaryEmailCcEmail::create([
                        'uuid' => UuidGeneratorHelper::generateUniqueUuidForTable('primary_email_cc_email'),
                        'primary_email_id' => $primaryEmails->id,
                        'cc_email_id' => $ccEmailId,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }

            $testData = PrimaryEmailCcEmail::get();

            DB::commit();

            return back()->with('success', 'Emails added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage(); // Capture the error message
            return back()->with('error', $errorMessage);
        }
    }
}
