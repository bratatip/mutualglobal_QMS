<?php

namespace App\Services\Auth;

use App\Helpers\PasswordGeneratorHelper;
use App\Helpers\UuidGeneratorHelper;
use App\Jobs\SendNewUserNotificationJob;
use App\Models\Role;
use Exception;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationService
{
    public function register($data, $role)
    {
        DB::beginTransaction();
        try {

            $uuid = UuidGeneratorHelper::generateUniqueUuidForTable('users');
            $password = PasswordGeneratorHelper::generateUniquePasswordForTable('users', 'password', 8);


            $user = User::create([
                'role_id' => Role::where('name', '=', $role)->pluck('id')->first(),
                'uuid' =>  $uuid,
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($password),
                'verification_token' => Str::random(40),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::commit();

            switch ($role) {
                case 'admin':
                    // Send email notification to the newly created agency user
                    dispatch(new SendNewUserNotificationJob($user->email, $user->name, $password));
                    break;
                case 'employee':
                    // // Send Verification Mail
                    // dispatch(new SendEmailVerificationMailClientJob($user));

                    // // Send email notification to the agency about client
                    // dispatch(new SendNewClientNotificationJob($user, $agency->id));
                    dispatch(new SendNewUserNotificationJob($user->email, $user->name, $password));
                    break;
                case 'client':
                    // dispatch(new NewCandidateNotificationJob($user, $agency->id));
                    break;
                default:
                    throw new Exception("Invalid role");
            }

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // public function verify(Request $request, $token)
    // {
    //     $user = User::where('verification_token', $token)->firstOrFail();
    //     $user->email_verified_at = Carbon::now();
    //     $user->save();

    //     return view('email-verified');
    // }
}
