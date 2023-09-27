@extends('layouts.master')

@section('content')
    @include('common.partials._messages')

    <div class="flex flex-wrap p-3 justify-center mb-20">
        <div class="overflow-x-auto w-11/12 shadow border border-solid rounded-lg "
            style="border-color: #CCCCCC !important;">
            <button href="#"
                id="addMoreButton"
                class="inline px-6 py-2 mt-3 border text-blue-500 border-solid focus:ring-0 focus:outline-1  focus:outline-[#FFC451] focus:border-1 rounded-2xl bg-white  text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                <i class="fa fa-plus"
                    aria-hidden="true"></i>
                Add More
            </button>

            <div class="w-full flex justify-end px-4 mb-3 max-md:w-full">
                <a href="{{ route('download-pdf', ['id' => $quoteId]) }}"
                    id="downloadPdfButton"
                    class="logout_button block px-6 py-2 mt-3 border border-solid rounded-2xl text-orange-500 text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                    Download
                </a>
            </div>
            <form id="insuranceForm"
                action="{{ route('quote-finalize') }}"
                method="POST">
                @csrf

                <!-- Loop through existing data for editing -->
                @foreach ($quoteFinalizeData as $index => $quote)
                    <div class="md:flex md:flex-row md:items-start align-top m-6">
                        <div class="w-1/2">
                            <input type="hidden"
                                value="{{ $quoteId }}"
                                name="quote_id">
                            <div>
                                <label class="text-[#0F628B] text-sm">Insurance Company <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <select
                                    class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg  sm:rounded-sm text-gray-500 text-xs"
                                    name="insurer_id[]"
                                    required>
                                    <option readonly>Select an insurance company...</option>
                                    @foreach ($insurers as $insurer)
                                        <option value="{{ $insurer->id }}"
                                            {{ $quote->insurer_id == $insurer->id ? 'selected' : '' }}>{{ $insurer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="w-1/2">
                            <div>
                                <label class="text-[#0F628B] text-sm">Net Premium <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <input type="text"
                                    name="net_premium[]"
                                    class="net-premium h-8 p-1 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg  sm:rounded-sm text-gray-500 text-xs"
                                    value="{{ $quote->net_premium }}">
                            </div>
                        </div>

                        <div class="w-1/2">
                            <div>
                                <label class="text-[#0F628B] text-sm">GST <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <input type="text"
                                    name="gst[]"
                                    class="gst h-8 p-1 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs"
                                    value="{{ $quote->gst }}">
                            </div>
                        </div>

                        <div class="w-1/2">
                            <div>
                                <label class="text-[#0F628B] text-sm">Total Premium <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <input type="text"
                                    name="total_premium[]"
                                    class="total-premium h-8 p-1 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs"
                                    value="{{ $quote->total_premium }}">
                            </div>
                        </div>

                        @if ($index < 1)
                            <div>
                                <button type="hidden"
                                    class="deleteButton w-1/12 inline mt-1 text-red-500 bg-white text-xxs hover:bg-gray-100 mt-4 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold"
                                    disabled>
                                    <i class="fa fa-trash"
                                        aria-hidden="true"
                                        aria-disabled="true"></i>
                                </button>
                            </div>
                        @endif

                        @if ($index > 0)
                            <div>
                                <button type="button"
                                    class="deleteButton w-1/12 inline mt-1 text-red-500 bg-white text-xxs hover:bg-gray-100 mt-4 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                                    <i class="fa fa-trash"
                                        aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif

                    </div>
                @endforeach

                @if (count($quoteFinalizeData) == 0)
                    <div class="md:flex md:flex-row md:items-start align-top m-6">
                        <div class="w-1/2">
                            <input type="hidden"
                                value="{{ $quoteId }}"
                                name="quote_id">
                            <div>
                                <label class="text-[#0F628B] text-sm">Insurance Company <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <select
                                    class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg  sm:rounded-sm text-gray-500 text-xs"
                                    name="insurer_id[]"
                                    required>
                                    <option readonly>Select an insurance company...</option>
                                    @foreach ($insurers as $insurer)
                                        <option value="{{ $insurer->id }}">{{ $insurer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="w-1/2">
                            <div>
                                <label class="text-[#0F628B] text-sm">Net Premium <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <input type="text"
                                    name="net_premium[]"
                                    class="net-premium h-8 p-1 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg  sm:rounded-sm text-gray-500 text-xs">
                            </div>
                        </div>

                        <div class="w-1/2">
                            <div>
                                <label class="text-[#0F628B] text-sm">GST <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <input type="text"
                                    name="gst[]"
                                    class="gst h-8 p-1 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs">
                            </div>
                        </div>

                        <div class="w-1/2">
                            <div>
                                <label class="text-[#0F628B] text-sm">Total Premium <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <input type="text"
                                    name="total_premium[]"
                                    class="total-premium h-8 p-1 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs"
                                    required>
                            </div>
                        </div>

                        <div>
                            <button type="hidden"
                                class="deleteButton w-1/12 inline mt-1 text-red-500 bg-white text-xxs hover:bg-gray-100 mt-4 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold"
                                disabled>
                                <i class="fa fa-trash"
                                    aria-hidden="true"
                                    aria-disabled="true"></i>
                            </button>
                        </div>

                    </div>
                @endif

                <!-- New fields go here -->
                <div id="inputFieldsContainer"></div>

                <div class="flex justify-center ml-5 flex-row mb-6">
                    <button
                        class="inline px-6 py-2 mt-3 border text-green-500 border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                        <i class="fa fa-paper-plane"
                            aria-hidden="true"></i>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#addMoreButton').click(function() {
                var newFieldGroup = $('<div class="md:flex md:flex-row md:items-start align-top m-6">' +
                    '<div class="w-1/2">' +
                    '<div>' +
                    '<label class="text-[#0F628B] text-sm">Insurance Company <span class="text-red-600"><strong>*</strong></span></label>' +
                    '</div>' +
                    '<div>' +
                    '<select class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1 dark:bg-gray-800 overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" name="insurer_id[]">' +
                    '<option value="" disabled selected>Select an insurance company...</option>' +
                    '@foreach ($insurers as $insurer)' +
                    '<option value="{{ $insurer->id }}">{{ $insurer->name }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="w-1/2">' +
                    '<div>' +
                    '<label class="text-[#0F628B] text-sm">Net Premium <span class="text-red-600"><strong>*</strong></span></label>' +
                    '</div>' +
                    '<div>' +
                    '<input type="text" name="net_premium[]" class="net-premium h-8 p-1 w-11/12 border-[#CCCCCC] border-1 dark:bg-gray-800 overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs">' +
                    '</div>' +
                    '</div>' +
                    '<div class="w-1/2">' +
                    '<div>' +
                    '<label class="text-[#0F628B] text-sm">GST <span class="text-red-600"><strong>*</strong></span></label>' +
                    '</div>' +
                    '<div>' +
                    '<input type="text" name="gst[]" class="gst h-8 p-1 w-11/12 border-[#CCCCCC] border-1 dark:bg-gray-800 overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs">' +
                    '</div>' +
                    '</div>' +
                    '<div class="w-1/2">' +
                    '<div>' +
                    '<label class="text-[#0F628B] text-sm">Total Premium <span class="text-red-600"><strong>*</strong></span></label>' +
                    '</div>' +
                    '<div>' +
                    '<input type="text" name="total_premium[]" class="total-premium h-8 p-1 w-11/12 border-[#CCCCCC] border-1 dark:bg-gray-800 overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" required>' +
                    '</div>' +
                    '</div>' +
                    '<div>' +
                    '<button class="deleteButton w-1/12 inline mt-1 text-red-500 bg-white text-xxs hover:bg-gray-100 mt-4 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                    '</div>' +
                    '</div>');

                newFieldGroup.find('.deleteButton').click(function() {
                    $(this).parent().parent().remove();
                });

                $('#inputFieldsContainer').append(newFieldGroup);

            });

            $('.deleteButton').click(function() {
                $(this).parent().parent().remove();
            });
        });


        // Function to calculate the Total Premium based on GST and Net Premium
        function calculateTotalPremium(netPremiumInput, gstInput, totalPremiumInput) {
            const netPremiumValue = parseFloat(netPremiumInput.value) || 0;
            const gstValue = parseFloat(gstInput.value) || 0;
            const totalPremiumValue = netPremiumValue + (netPremiumValue * (gstValue / 100));
            totalPremiumInput.value = totalPremiumValue.toFixed(2);
        }

        // Attach event listeners to input fields for dynamic calculation
        const netPremiumInputs = document.querySelectorAll('.net-premium');
        const gstInputs = document.querySelectorAll('.gst');
        const totalPremiumInputs = document.querySelectorAll('.total-premium');

        netPremiumInputs.forEach((netPremiumInput, index) => {
            netPremiumInput.addEventListener('input', () => {
                calculateTotalPremium(netPremiumInput, gstInputs[index], totalPremiumInputs[index]);
            });

            gstInputs[index].addEventListener('input', () => {
                calculateTotalPremium(netPremiumInput, gstInputs[index], totalPremiumInputs[index]);
            });
        });

        $('#inputFieldsContainer').on('input', '.net-premium', function() {
            const index = $('.net-premium').index(this);
            calculateTotalPremium(this, $('.gst').eq(index)[0], $('.total-premium').eq(index)[0]);
        });

        $('#inputFieldsContainer').on('input', '.gst', function() {
            const index = $('.gst').index(this);
            calculateTotalPremium($('.net-premium').eq(index)[0], this, $('.total-premium').eq(index)[0]);
        });
    </script>

@endsection
