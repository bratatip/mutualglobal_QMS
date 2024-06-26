@extends('layouts.master')

@section('content')
    @if ($errors->any())
        <div class="text-red-500 text-xs mt-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="overflow-x-auto w-8/12 border border-slate-400 border-solid shadow  rounded mx-auto"
         style="border-color: #CCCCCC !important;">
        <div class="flex flex-wrap justify-center bg-transparent py-3 px-3">
            <form action="{{ route('admin.storeEmployee') }}"
                  method="POST"
                  class="w-full">
                @csrf
                <div class="md:flex md:flex-row md:items-start align-top mb-6">
                    <div class="w-1/2">
                        <div>
                            <label class=" text-[#0F628B] text-sm">Employee Name <span
                                      class="text-red-600"><strong>*</strong></span> </label>
                        </div>
                        <div>
                            <input type="text"
                                   class="h-8 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs"
                                   name="name"
                                   placeholder="Enter Employee Name"
                                   value="{{ old('name') }}">

                            @error('name')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div>
                            <label class="text-[#0F628B] text-sm">Role <span
                                      class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <select name="role_id"
                                    class="h-8 p-1 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>

                            @error('role_id')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>
                </div>

                <div class="md:flex md:flex-row md:items-start align-top mb-6">
                    <div class="w-1/2">
                        <div>
                            <label class="text-[#0F628B] text-sm">Manager <span
                                      class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <select name="manager_id"
                                    class="h-8 p-1 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs">
                                <option value="">Select Manager</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->uuid }}" {{ old('role_id') == $user->uuid ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>

                            @error('manager_id')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>
                </div>

                <div class="md:flex md:flex-row md:items-start align-top mb-6">
                    <div class="w-1/2">
                        <div>
                            <label class=" text-[#0F628B] text-sm">Email <span
                                      class="text-red-600"><strong>*</strong></span> </label>
                        </div>
                        <div>
                            <input type="email"
                                   class="h-8 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs"
                                   name="email"
                                   placeholder="Employee Email"
                                   value="{{ old('email') }}">

                            @error('email')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div>
                            <label class="text-[#0F628B] text-sm">Contact Number <span
                                      class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="number"
                                   class="h-8 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs"
                                   name="phone"
                                   placeholder="Employee Contact Number"
                                   oninput="this.value = this.value.slice(0, 10);"
                                   value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                            class="block px-6  py-2 mt-3 border border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                        Add Customer
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        display: none;
        -webkit-appearance: none;
        appearance: none;
    }
</style>
{{--                                 class="h-8 p-1 w-11/12 bg-white border-[#CCCCCC] rounded-lg border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
 --}}
