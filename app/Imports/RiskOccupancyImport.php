<?php

namespace App\Imports;

use App\Helpers\UuidGeneratorHelper;
use App\Models\RiskOccupancy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class RiskOccupancyImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            foreach ($collection as $row) {

                if (empty($row['iib_code']) || empty($row['risk_occupancy']) || empty($row['risk_code'])) {
                    throw new \Exception('One or more columns in a row are missing or empty');
                }
                RiskOccupancy::create([
                    'uuid' => UuidGeneratorHelper::generateUniqueUuidForTable('risk_occupancies'),
                    'iib_code' => $row['iib_code'],
                    'risk_occupancy' => $row['risk_occupancy'],
                    'risk_code' => $row['risk_code'],
                ]);
            }

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction if an exception occurs
            throw $e; // Rethrow the exception
        }
    }
}
