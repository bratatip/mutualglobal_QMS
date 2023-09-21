<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Stancl\Tenancy\Contracts\Tenant;

class PasswordGeneratorHelper
{
    public static function generateUniquePasswordForTable(string $tableName, string $columnName = 'password', $length = 16): string
    {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $symbols = '!@#$%^&*=+';

        $allCharacters = $lowercase . $numbers . $symbols;

        $password = '';

        do {
            $password = '';
            $prevChar = '';

            for ($i = 0; $i < $length; $i++) {
                $randomIndex = random_int(0, strlen($allCharacters) - 1);
                $char = $allCharacters[$randomIndex];

                // Ensure that uppercase letters are not consecutive
                if ($prevChar !== strtoupper($char)) {
                    $password .= $char;
                    $prevChar = $char;
                } else {
                    $i--; // Retry generating this character
                }
            }
        } while (DB::table($tableName)->where($columnName, $password)->exists());

        return $password;
    }
}
