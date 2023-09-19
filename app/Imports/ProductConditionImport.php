<?php

namespace App\Imports;

use App\Models\ProductCondition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductConditionImport implements ToCollection
{
    protected $product_id;
    protected $product_section_id;
    protected $product_sub_section_id;

    public function __construct($product_id, $product_section_id, $product_sub_section_id)
    {
        $this->product_id = $product_id;
        $this->product_section_id = $product_section_id;
        $this->product_sub_section_id = $product_sub_section_id;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        try {
            foreach ($rows as $row) {
                ProductCondition::create([
                    'product_id' => $this->product_id,
                    'product_section_id' => $this->product_section_id,
                    'product_sub_section_id' => $this->product_sub_section_id,
                    'content' => $row[0], // Assuming the content is in the first column
                    // Other fields as needed
                ]);
            }

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction if an exception occurs
            throw $e; // Rethrow the exception
        }
    }
}
