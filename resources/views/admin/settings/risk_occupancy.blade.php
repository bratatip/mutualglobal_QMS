@extends('layouts.master')

@section('content')
    <div class="flex flex-wrap justify-center py-5 px-48">
        <div class="flex flex-wrap w-8/12 -mx-4 mb-6 p-6 max-md:p-2 bg-zinc-100 border border-solid shadow-2xl rounded-2xl">
            <form action="{{ route('admin.store-riskoccupancy') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="relative w-11/12">
                    <label class="text-[#0F628B]">Select Excel File: <span class="text-red-600"><strong>*</strong></span>
                    </label>
                    
                    <input type="file"
                        name="excel_file"
                        accept=".xlsx, .xls"
                        class="absolute inset-0 opacity-0 w-full h-full cursor-pointer"
                        id="fileInput">
                    <div class="h-8 w-[500px] underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs px-4 py-2 border border-gray-300 rounded-md"
                        id="fileInputLabel">
                        Upload File
                    </div>

                </div>
                <button type="submit"
                    class="logout_button block px-6  py-2 mt-3 border border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
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
