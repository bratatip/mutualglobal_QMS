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

<!-- <div class="center-screen w-100"> -->
<div class="flex flex-wrap justify-center py-5 px-48">
    <div class="flex flex-wrap -mx-4 mb-6 p-6 max-md:p-2 bg-zinc-100 border border-solid shadow-2xl rounded">
        <form action="{{ url('/customers') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="customerName" class=" text-[#0F628B]">Customer Name <span class="text-red-600"><strong>*</strong></span> </label>
                    <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs @error('name') border-red-500 @enderror" name="name" id="customerName" value="{{ old('name') }}">
                    @error('name')
                    <span class="text-red-500 text-xs overflow-hidden">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="customerAddress" class="text-[#0F628B]">Customer Mailing Address <span class="text-red-600"><strong>*</strong></span></label>
                    <textarea class="h-8 underline-input custom-textarea bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs @error('address') border-red-500 @enderror" name="address" id="customerAddress" rows="2" cols="50">{{ old('address') }}</textarea>
                    @error('address')
                    <span class="text-red-500 text-xs overflow-hidden">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pin" class="text-[#0F628B]">Pin <span class="text-red-600"><strong>*</strong></span></label>
                    <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs @error('zip_code') border-red-500 @enderror" name="zip_code" id="pin" value="{{ old('zip_code') }}" maxlength="6">
                    @error('zip_code')
                    <span class="text-red-500 text-xs overflow-hidden">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="text-[#0F628B]">Email <span class="text-red-600"><strong>*</strong></span></label>
                    <input type="email" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs @error('email') border-red-500 @enderror" name="email" id="email" value="{{ old('email') }}">
                    @error('email')
                    <span class="text-red-500 text-xs overflow-hidden">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="contact" class="text-[#0F628B]">Contact No. <span class="text-red-600"><strong>*</strong></span></label>
                    <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs @error('contact_person_phone') border-red-500 @enderror" name="contact_person_phone" id="contact" value="{{ old('contact_person_phone') }}" maxlength="10">
                    @error('contact_person_phone')
                    <span class="text-red-500 text-xs overflow-hidden">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="contactPerson" class="text-[#0F628B]">Contact Person <span class="text-red-600"><strong>*</strong></span></label>
                    <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs @error('contact_person_name') border-red-500 @enderror" name="contact_person_name" id="contactPerson" value="{{ old('contact_person_name') }}">
                    @error('contact_person_name')
                    <span class="text-red-500 text-xs overflow-hidden">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pan" class="text-[#0F628B]">PAN</label>
                    <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs @error('pan') border-red-500 @enderror" name="pan" id="pan" value="{{ old('pan') }}">
                    @error('pan')
                    <span class="text-red-500 text-xs overflow-hidden">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="gst" class="text-[#0F628B]">GSTIN</label>
                    <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs @error('gst') border-red-500 @enderror" name="gst" id="gst" value="{{ old('gst') }}">
                    @error('gst')
                    <span class="text-red-500 text-xs overflow-hidden">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="logout_button block px-6  py-2 mt-3 border border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                Save
            </button>

        </form>
    </div>
</div>


@endsection




<style>
    .custom-card {
        border: 1px solid #bec1c4;
        margin-top: 20px;
        margin-bottom: 20px;
        width: 90%;
        max-width: 90%;
        border-radius: 5px;
        background-color: whitesmoke;
        padding: 30px;
        color: black;
    }

    .underline-input {

        border-radius: 2;
        padding: 5px 0;
        width: 100%;
        background-color: transparent;
        color: black;
        padding: 0 10px 0 10px;
    }

    .custom-textarea {
        width: 100%;
        max-height: 60px;
        min-height: 60px;
        font-size: 12px;
        overflow: hidden;

    }

    .form-row {
        margin-bottom: -15px;
    }
</style>