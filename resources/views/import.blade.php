@extends('layouts.master')

@section('content')

<div class="flex flex-wrap justify-center py-5 px-48">
    <div class="flex flex-wrap -mx-4 mb-6 p-6 max-md:p-2 bg-zinc-100 border border-solid shadow-2xl rounded-2xl">
        <form action="{{ route('importContents') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class=" text-[#0F628B]">Product:<span class="text-red-600"><strong>*</strong></span> </label>
                    <select name="product_id" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="text-[#0F628B]">Product Section <span class="text-red-600"><strong>*</strong></span></label>
                    <select name="product_section_id" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs">
                        <option value="">Select Product Section</option>
                        @foreach($productSections as $section)
                        <option class="text-black" value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pin" class="text-[#0F628B]">Product Sub section <span class="text-red-600"><strong>*</strong></span></label>
                    <select name="product_sub_section_id" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs">
                        <option value="">Select Product Sub Section</option>
                        @foreach($productSubSections as $subSection)
                        <option value="{{ $subSection->id }}">{{ $subSection->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="text-[#0F628B]">Select Excel File: <span class="text-red-600"><strong>*</strong></span></label>
                    <div class="mb-4 relative">
                        <input type="file" name="excel_file" accept=".xlsx, .xls" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" id="fileInput">
                        <div class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs px-4 py-2 border border-gray-300 rounded-md" id="fileInputLabel">
                            Upload File
                        </div>
                    </div>
                </div>
            </div>




            <button type="submit" class="logout_button block px-6  py-2 mt-3 border border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                Import
            </button>

        </form>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const fileInput = document.querySelector('#fileInput');
        const fileInputLabel = document.querySelector('#fileInputLabel');

        fileInput.addEventListener('change', (event) => {
            const fileName = event.target.files[0]?.name || 'Upload File';
            fileInputLabel.textContent = fileName;
        });
    });
</script>

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