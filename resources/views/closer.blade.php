@extends('layouts.master')

@section('content')
    @include('common.partials._messages')

    <div class="flex flex-wrap p-3 justify-center mb-20">
        <div class="overflow-x-auto w-11/12 shadow border border-solid rounded-lg "
            style="border-color: #CCCCCC !important;">
            <form id="myForm"
                action="{{ route('closer-quote-post') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden"
                    name="quote_id"
                    value="{{ $quoteId }}">
                <div class="md:flex md:flex-row md:items-start align-top m-6">

                    <div class="w-1/4">
                        <div class="flex-row align-items-center">
                            <label for="customerAddress"
                                class="text-[#0F628B] ml-3 text-sm">Insurer</label>
                        </div>
                        @if (!empty($insurerNames))
                            @foreach ($insurerNames as $name)
                                <div class="first-input-suminsured">
                                    <label
                                        class="text-[#0F628B] ml-3 text-xs italic text-red-500">{{ $name }}</label>
                                </div>
                            @endforeach
                        @else
                            <div class="first-input-suminsured">
                                <label class="text-[#0F628B] ml-3 text-xs italic text-red-500">No insurer names
                                    found.</label>
                        @endif
                    </div>

                    <div class="w-1/4">
                        <div class="flex w-full items-center">
                            <label for="customerName"
                                class="text-[#0F628B] text-sm">Total Premium<span class="text-red-600"></label>
                        </div>
                        <div>
                            @if (!empty($premiumInfo))
                                @foreach ($premiumInfo as $data)
                                    <input type="number"
                                        id="totalPremium"
                                        class="h-8 border-0 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs"
                                        placeholder="Total Premium"
                                        value="{{ $data }}"
                                        readonly>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="md:flex md:flex-row md:items-start p-3 ">
                    <div class="w-1/4">
                        <div class="flex-row align-items-center">
                            <label for="customerAddress"
                                class="text-[#0F628B] ml-3 text-sm">Policy Number</label>
                        </div>
                        <div class="first-input-suminsured">
                            <input type="text"
                                name="policy_number"
                                class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs">
                        </div>
                    </div>

                    <div class="w-1/4">
                        <div class="flex-row align-items-center">
                            <label for="customerAddress"
                                class="text-[#0F628B] ml-3 text-sm">Policy Start Date</label>
                        </div>
                        <div class="first-input-suminsured">
                            <input type="date"
                                name="policy_start_date"
                                class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs">
                        </div>
                    </div>


                    <div class="w-1/4">
                        <div class="flex-row align-items-center">
                            <label for="customerAddress"
                                class="text-[#0F628B] ml-3 text-sm">Policy End Date</label>
                        </div>
                        <div class="first-input-suminsured">
                            <input type="date"
                                name="policy_end_date"
                                class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs">
                        </div>
                    </div>

                </div>

                <div class="md:flex md:flex-row md:items-start p-3">
                    <div class="w-1/4">
                        <div class="flex-row align-items-center">
                            <label for="customerAddress"
                                class="text-[#0F628B] ml-3 text-sm">Product</label>
                        </div>
                        <div class="first-input-suminsured">
                            <select type="number"
                                name="product_id"
                                class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs">
                                <option value="">Select a Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="w-1/4">
                        <div class="flex-row align-items-center">
                            <label for="customerAddress"
                                class="text-[#0F628B] ml-3 text-sm">Premium</label>
                        </div>
                        <div class="first-input-suminsured">
                            <input type="number"
                                name="premium_amount"
                                id="premiumInput"
                                class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs"
                                placeholder="0.00 "
                                inputmode="numeric"
                                step="any">
                        </div>
                    </div>

                    <div class="w-1/4">
                        <div class="flex-row align-items-center">
                            <label class="text-[#0F628B] ml-3 text-sm">Policy Copy</label>
                        </div>
                        <div class="flex-row items-center">
                            <label for="file"
                                class="cursor-pointer bg-transparent border border-black-200 py-2 px-4 ml-2 rounded-lg hover:bg-blue-600 text-gray-500 text-xs transition duration-300 ease-in-out flex">
                                <span id="file-name"
                                    class=" w-11/12">Upload Policy here</span>
                                <input type="file"
                                    id="file"
                                    name="file"
                                    class="hidden"
                                    onchange="displayFileName(this)" />
                                <button type="button"
                                    id="remove-file"
                                    class="ml-2 text-red-600 hover:text-red-800 hidden focus:outline-0"
                                    onclick="removeFile()">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </label>
                        </div>
                    </div>




                </div>




                <div class="flex justify-center ml-5 flex-row mb-6">
                    <button href="#"
                        id="submit"
                        class="inline px-6 py-2 mt-3 border text-blue-500 border-solid focus:ring-0 focus:outline-1  focus:outline-[#FFC451] focus:border-1 rounded-2xl bg-white  text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                        <i class="far fa-save"
                            aria-hidden="true"></i>
                        Save
                    </button>

                    <a href="{{ route('email-to-customer', ['id' => $quoteId]) }}"
                        class="inline px-6 py-2 mt-3 border text-dark border-solid rounded-2xl bg-[#e5e7eb] text-xs  ml-2 font-bold focus:outline-0 hover:no-underline">
                        Add Template
                    </a>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#submit').click(function() {
                var totalPremium = parseFloat($('#totalPremium').val());
                var premiumInputValue = $('#premiumInput').val();
                var premiumInput = parseFloat(premiumInputValue) || 0;

                if (premiumInput < totalPremium) {
                    var difference = totalPremium - premiumInput;
                    var confirmationMessage =
                        `Premium is ${difference.toFixed(2)} less than Total Premium. Are you sure you want to proceed?`;

                    if (!confirm(confirmationMessage)) {
                        return false;
                    }
                }
            });
        });





        const fileInput = document.getElementById('file');
        const fileNameSpan = document.getElementById('file-name');
        const removeFileButton = document.getElementById('remove-file');
        let previousFileName = null;
        let fileSelected = false;

        fileInput.addEventListener('change', function() {
            const selectedFile = this.files[0];
            if (selectedFile) {
                const fileName = selectedFile.name;
                const maxDisplayLength = 20;

                const lastDotIndex = fileName.lastIndexOf('.');
                if (lastDotIndex !== -1) {
                    const extension = fileName.substring(lastDotIndex + 1);
                    const baseName = fileName.substring(0, lastDotIndex);

                    let truncatedFileName;

                    if (baseName.length > maxDisplayLength) {
                        truncatedFileName = baseName.substring(0, maxDisplayLength - 3) + '..._';
                    } else {
                        truncatedFileName = baseName;
                    }

                    truncatedFileName += '.' + extension;

                    fileNameSpan.textContent = truncatedFileName;
                } else {
                    fileNameSpan.textContent = fileName;
                }

                removeFileButton.classList.remove('hidden');
                fileSelected = true;
            }

        });

        function removeFile() {
            fileInput.value = ''; // Clear the file input
            if (!fileSelected) {
                previousFileName = null; // Clear the previous value only when no file is selected
            }
            fileNameSpan.textContent = previousFileName || 'Upload Policy here';
            removeFileButton.classList.add('hidden');
        }
    </script>
@endsection

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
