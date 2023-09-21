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

    @if (Session::has('success'))
        <div class="text-green-500 text-xs mt-2">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="bg-transparent text-center py-4 lg:px-4">
            <div class="p-2 bg-red-600 items-center text-indigo-100 leading-none lg:rounded-md flex lg:inline-flex"
                role="alert">
                {{-- <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">Alert</span> --}}
                <span class="font-semibold mr-2 text-left flex-auto">{{ Session::get('error') }}</span>
            </div>
        </div>
    @endif

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
