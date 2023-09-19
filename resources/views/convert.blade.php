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
 

<div class="flex flex-wrap p-3 justify-center mb-20">
    <div class="overflow-x-auto w-11/12 shadow border border-slate-400 border-solid rounded-lg " style="border-color: #CCCCCC !important;">

        <form id="myForm" action="{{ route('quote-convert') }}" method="POST" enctype="multipart/form-data" onsubmit="submitForm(event);">
            @csrf
            <input type="hidden" value="{{ $quoteId }}" name="quote_id">

            <div class="md:flex md:flex-row md:items-start p-3 ">

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Insurer</label>
                    </div>
                    <div>
                        <select class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" name="insurer_id[]" required>
                            <option class="w-11/12" readonly>Select an insurance company...</option>
                            @foreach ($insurers as $insurer)
                            <option class="w-11/12" value="{{ $insurer->id }}">{{ $insurer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Share in %</label>
                    </div>
                    <div>
                        <input type="number" name="share_in_percentage[]" id="premiumInput" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00" min="0" max="100" oninput="validity.valid||(value='');" inputmode="decimal">
                    </div>
                </div>
                <div class="w-1/4  mt-4">
                    <a href="#" class="inline px-6 py-2 mt-3 border text-dark border-solid rounded-2xl bg-[#e5e7eb] text-xs  ml-2  dark:text-gray-200 hover:text-[#0F628B] font-bold hover:no-underline" onclick="addDynamicFields()">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Add Co Insurer
                    </a>
                </div>
            </div>



            <!-- <hr class="my-3 border-t-1 border-[#020617]"> -->
            <div class="md:flex md:flex-row md:items-start p-3 ">
                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class=" text-[#0F628B] ml-3 text-sm">Net OD Premium</label>
                    </div>
                    <div>
                        <input type="number" id="net_od_premium" name="net_od_premium[]" class="net-od-premium h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00" inputmode="decimal">
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class=" text-[#0F628B] ml-3 text-sm">Net Terrorism Premium</label>
                    </div>
                    <div>
                        <input type="number" id="net_terrorism_premium" name="net_terrorism_premium[]" class="net-terrorism-premium h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal">
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class=" text-[#0F628B] ml-3 text-sm">GST %</label>
                    </div>
                    <div>
                        <input type="number" id="gst" name="gst[]" class="gst h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " placeholder="0.00" min="0" max="18" oninput="validity.valid||(value='');" inputmode="decimal">
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Gross Premium</label>
                    </div>
                    <div>
                        <input type="number" id="gross_premium" name="gross_premium[]" class="total-premium h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal">
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Brokerage Amount</label>
                    </div>
                    <div>
                        <input type="number" name="brokerage_amount[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal">
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Reward Brokerage </label>
                    </div>
                    <div>
                        <input type="number" name="brokerage_rewards[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal">
                    </div>
                </div>
            </div>

            <div id="dynamicFieldsContainer"></div>


            <!-- <div id="dynamicBrokerageContainer"></div> -->
            <!-- ==========================================================PAYMENT SECTION============================================ -->
            <!-- border-[#020617] border-[#9ca3af] -->
            <hr class="my-3 border-t-2  border-[#9ca3af]">

            <div class="md:flex md:flex-row md:items-start p-3">
                <div class="flex flex-row items-center"> 
                    <label class="text-[#0F628B] ml-3 text-sm">Mode Of Payment</label>
                    <div class="ml-3 flex ">
                        <input type="checkbox" id="paymentNeftCheckbox" class="h-3 w-3 mt-1 text-[#0F628B] focus:ring-0 border-gray-300" {{ old('transaction_mode') && in_array('neft', old('transaction_mode')) ? 'checked' : '' }}>
                        <label for="paymentNeft" class="ml-1 text-sm text-gray-700">NEFT</label>
                    </div>
                    <div class="ml-3 flex ">
                        <input type="checkbox" id="paymentChequeCheckbox" class="h-3 w-3 mt-1 text-[#0F628B] focus:ring-0 border-gray-300" {{ old('transaction_mode') && in_array('cheque', old('transaction_mode')) ? 'checked' : '' }}>
                        <label for="paymentCheck" class="ml-1  text-sm text-gray-700">Cheque</label>
                    </div>

                    <div class="ml-3 flex ">
                        <input type="checkbox" id="paymentOtherCheckbox" class="h-3 w-3 mt-1 text-[#0F628B] focus:ring-0 border-gray-300" {{ old('transaction_mode') && in_array('other', old('transaction_mode')) ? 'checked' : '' }}>
                        <label for="paymentCheck" class="ml-1  text-sm text-gray-700">Other</label>
                    </div>
                </div>
            </div>

            <div class="md:flex md:flex-row justify-start md:items-start p-3 mt-[-20px]" id="neftDiv" hidden>

                <input type="text" value="neft" name="transaction_mode[]" hidden disabled>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label for="chequeNumber" class="text-[#0F628B] ml-3 text-sm">NEFT Number</label>
                    </div>
                    <div>
                        <input type="text" name="transaction_number[]" id="chequeNumber" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="Enter NEFT Number " disabled>
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Payment Date</label>
                    </div>
                    <div>
                        <input type="date" name="transaction_date[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="numeric" disabled>
                    </div>
                </div>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Amount </label>
                    </div>
                    <div>
                        <input type="number" name="transaction_amount[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal" disabled>
                    </div>
                </div>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Remarks </label>
                    </div>
                    <div>
                        <input type="text" name="remarks[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="Remarks" disabled>
                    </div>
                </div>

                <div class="w-1/6 mt-4">
                    <a href="#" id="addButton" class="inline px-6 py-2 mt-3 border text-dark border-solid rounded-2xl bg-[#e5e7eb] text-xs  ml-2  dark:text-gray-200 hover:text-[#0F628B] font-bold hover:no-underline" onclick="return addNewSection('neftDiv', 'neftDivContainer');">
                        Add <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <div id="neftDivContainer">



            </div>
            <hr class="my-3 border-t-1 border-[#9ca3af]" id="neftHr" style="display: none;">



            <div class="md:flex md:flex-row justify-start md:items-start p-3 mt-[-20px]" id="chequeDiv" hidden>

                <input type="text" value="cheque" name="transaction_mode[]" hidden disabled>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label for="chequeNumber" class="text-[#0F628B] ml-3 text-sm">Cheque Number</label>
                    </div>
                    <div>
                        <input type="text" name="transaction_number[]" id="chequeNumber" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="Enter Cheque Number " disabled>
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Payment Date</label>
                    </div>
                    <div>
                        <input type="date" name="transaction_date[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="numeric" disabled>
                    </div>
                </div>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Amount </label>
                    </div>
                    <div>
                        <input type="number" name="transaction_amount[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal" disabled>
                    </div>
                </div>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Remarks </label>
                    </div>
                    <div>
                        <input type="text" name="remarks[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="Remarks" disabled>
                    </div>
                </div>

                <div class="w-1/6 mt-4">
                    <a href="#" id="addButton" class="inline px-6 py-2 mt-3 border text-dark border-solid rounded-2xl bg-[#e5e7eb] text-xs  ml-2  dark:text-gray-200 hover:text-[#0F628B] font-bold hover:no-underline" onclick="return addNewSection('chequeDiv', 'chequeDivContainer');">
                        Add <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <div id="chequeDivContainer">

            </div>

            <hr class="my-3 border-t-1 border-[#9ca3af]">

            <div class="md:flex md:flex-row justify-start md:items-start p-3 mt-[-20px]" id="otherPaymentDiv" hidden>
                <input type="text" value="other" name="transaction_mode[]" hidden disabled>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label for="chequeNumber" class="text-[#0F628B] ml-3 text-sm">NEFT Number</label>
                    </div>
                    <div>
                        <input type="text" name="transaction_number[]" id="neft" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="Enter NEFT Number " disabled>
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Payment Date</label>
                    </div>
                    <div>
                        <input type="date" name="transaction_date[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="numeric" disabled>
                    </div>
                </div>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Amount </label>
                    </div>
                    <div>
                        <input type="number" name="transaction_amount[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal" disabled>
                    </div>
                </div>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Remarks </label>
                    </div>
                    <div>
                        <input type="text" name="remarks[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="Remarks" disabled inputmode="text">
                    </div>
                </div>

                <div class="w-1/6 mt-4">
                    <a href="#" id="addButton" class="inline px-6 py-2 mt-3 border text-dark border-solid rounded-2xl bg-[#e5e7eb] text-xs  ml-2  dark:text-gray-200 hover:text-[#0F628B] font-bold hover:no-underline" onclick="return addNewSection('otherPaymentDiv', 'otherPaymentDivContainer');">
                        Add <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <div id="otherPaymentDivContainer">

            </div>

            <div id="documents">
                <label for="document_type[]" class="w-1/5 text-[#0F628B] mx-3 text-sm">Select Document Type:</label>
                <label for="file[]" class="text-[#0F628B] ml-3 text-sm">Upload Document:</label>
                <button type="button" id="addDocument" class="inline px-6 py-2 mt-3 border text-dark border-solid rounded-2xl bg-[#e5e7eb] text-xs  ml-2  dark:text-gray-200 hover:text-[#0F628B] font-bold hover:no-underline focus:outline-0">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                <div class="document">
                    <select name="document_type[]" id="document_type[]" class="h-8 p-1 ml-3 w-1/5 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs">
                        <option value="" selected disabled>Select Docs</option>
                        <option value="pan">PAN</option>
                        <option value="gstin">GSTIN</option>
                        <option value="gstin">Cheque</option>
                        <option value="gstin">Quote</option>
                        <option value="others">others</option>
                    </select>
                    <input type="file" name="file[]" id="file[]" class="h-8 p-1 ml-4 w-1/4 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark:bg-gray-800 focus:outline-0 overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs">
                </div>
            </div>

            <div class="flex justify-center ml-5 flex-row mb-6">
                <button id="submit" class="inline px-6 py-2 mt-3 border text-dark border-solid rounded-2xl bg-[#e5e7eb] text-xs  ml-2 font-bold focus:outline-0">
                    Save
                </button>

                <a href="{{ route('email', ['id' => $quoteId]) }}" class="inline px-6 py-2 mt-3 border text-dark border-solid rounded-2xl bg-[#e5e7eb] text-xs  ml-2 font-bold focus:outline-0 hover:no-underline">
                    Add Template
                </a>
            </div>
        </form>
    </div>
</div>


<script>
    let dynamicFieldIndex = 1; 

    function addDynamicFields() {
        
        var currentShareValue = 0;

        
        var dynamicFields = document.querySelectorAll('[id^="premiumInput"]');
        for (var i = 0; i < dynamicFields.length; i++) {
            var fieldValue = parseFloat(dynamicFields[i].value);
            if (isNaN(fieldValue) || fieldValue === 0) {
                
                return;
            }
            currentShareValue += fieldValue;
        }

        
        var maxShare = 100 - currentShareValue;

        if (maxShare > 0) {
            var dynamicField = `
            <hr class="my-3 border-t-1 border-[#9ca3af]">

            <div class="md:flex md:flex-row md:items-start p-3">
                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label  class="text-[#0F628B] ml-3 text-sm">Insurer</label>
                    </div>
                    <div>
                        <select class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark.bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" name="insurer_id[]" required>
                            <option class="w-11/12" readonly>Select an insurance company...</option>
                            @foreach ($insurers as $insurer)
                            <option class="w-11/12" value="{{ $insurer->id }}">{{ $insurer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="w-1/4">
                    <div class="flex-row align-items-center">
                        <label  class="text-[#0F628B] ml-3 text-sm">Share in %</label>
                    </div>
                    <div>
                        <input type="number" name=share_in_percentage[] id="premiumInput${dynamicFieldIndex}" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 dark.bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00" min="0" max="${maxShare}" oninput="validity.valid||(value='');" inputmode="decimal">
                    </div>
                </div>

                <div>
                    <button class="deleteButton w-1/12 inline mt-1 text-red-500 bg-white text-xxs hover:bg-gray-100 mt-4 dark.hover:bg-gray-600 dark:text-gray-200 dark.hover:text-white font-bold focus:outline-0"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
            </div>

            <div class="md:flex md:flex-row md:items-start p-3 ">
                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class=" text-[#0F628B] ml-3 text-sm">Net OD Premium</label>
                    </div>
                    <div>
                        <input type="number" id="net_od_premium" name="net_od_premium[]" class="net-od-premium h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00" inputmode="decimal">
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class=" text-[#0F628B] ml-3 text-sm">Net Terrorism Premium</label>
                    </div>
                    <div>
                        <input type="number" id="net_terrorism_premium" name="net_terrorism_premium[]" class="net-terrorism-premium h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal">
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class=" text-[#0F628B] ml-3 text-sm">GST %</label>
                    </div>
                    <div>
                        <input type="number" id="gst" name="gst[]" class="gst h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " placeholder="0.00" min="0" max="18" oninput="validity.valid||(value='');" inputmode="decimal">
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Gross Premium</label>
                    </div>
                    <div>
                        <input type="number" id="gross_premium" name="gross_premium[]" class="total-premium h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal">
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Brokerage Amount</label>
                    </div>
                    <div>
                        <input type="number" name="brokerage_amount[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal">
                    </div>
                </div>

                <div class="w-1/6">
                    <div class="flex-row align-items-center">
                        <label class="text-[#0F628B] ml-3 text-sm">Reward Brokerage </label>
                    </div>
                    <div>
                        <input type="number" name="brokerage_rewards[]" class="h-8 p-1 ml-3 w-11/12 border-[#CCCCCC] border-1  dark:bg-gray-800  overflow-hidden rounded-lg sm:rounded-sm text-gray-500 text-xs" placeholder="0.00 " inputmode="decimal">
                    </div>
                </div>
            </div>
        `;



            var dynamicFieldsContainer = document.getElementById('dynamicFieldsContainer');
            var newDynamicFields = document.createElement('div');
            newDynamicFields.innerHTML = dynamicField;

            // Attach a click event handler to the delete button within the new field group
            newDynamicFields.querySelector('.deleteButton').addEventListener('click', function() {
                dynamicFieldsContainer.removeChild(newDynamicFields);
                dynamicBrokerageContainer.removeChild(newDynamicBrokerageFields);
            });

            dynamicFieldsContainer.appendChild(newDynamicFields);
            dynamicFieldIndex++; 

            var dynamicBrokerageContainer = document.getElementById('dynamicBrokerageContainer');
            var newDynamicBrokerageFields = document.createElement('div');
            newDynamicBrokerageFields.innerHTML = dynamicBrokerageField;
            dynamicBrokerageContainer.appendChild(newDynamicBrokerageFields);
        }
    }


    $(document).ready(function() {
        function handleCheckboxChange(checkbox, sectionId, containerId) {
            if (checkbox.is(":checked")) {
                $("#" + sectionId).removeAttr("hidden");
                $("#" + sectionId).find('input[type="text"], input[type="date"], input[type="number"]').prop("disabled", false);
            } else {
                $("#" + sectionId).attr("hidden", true);
                $("#" + sectionId).find('input[type="text"], input[type="date"], input[type="number"]').prop("disabled", true);
                $("#" + containerId).empty();
            }
        }

        $("#paymentNeftCheckbox").change(function() {
            handleCheckboxChange($(this), "neftDiv", "neftDivContainer");
        });

        $("#paymentChequeCheckbox").change(function() {
            handleCheckboxChange($(this), "chequeDiv", "chequeDivContainer");
        });

        $("#paymentOtherCheckbox").change(function() {
            handleCheckboxChange($(this), "otherPaymentDiv", "otherPaymentDivContainer");
        });


        $('#addDocument').click(function() {
            var newDocumentField = $('.document:first').clone();
            newDocumentField.find('input[type="file"]').val(''); 
            var removeButton = $('<button type="button" class="removeDocument text-[#0F628B] text-sm focus:outline-0"><i class="fa fa-trash text-red-500" aria-hidden="true"></i></button>'); // Create the remove button for the cloned document
            newDocumentField.append(removeButton); 
            $('#documents').append(newDocumentField);
        });

        
        $('#documents').on('click', '.removeDocument', function() {
            $(this).closest('.document').remove(); 
        });
    });

    // function addNewSection(templateId, targetId) {
    //     var newSection = $("#" + templateId).clone().removeAttr("hidden");
    //     $("#" + targetId).append(newSection);
    //     var sectionsExist = $("#" + targetId).children().length > 0;
    //     $("#neftHr").toggle(sectionsExist);

    // }

    function addNewSection(templateId, targetId) {
        var newSection = $("#" + templateId).clone().removeAttr("hidden");

        
        var removeButton = $('<button class="deleteButton w-1/12 inline text-red-500 bg-white text-xxs hover:bg-gray-100 mt-2 ml-5 dark.hover:bg-gray-600 dark:text-gray-200 dark.hover:text-white font-bold focus:outline-0"><i class="fa fa-trash" aria-hidden="true"></i></button>');

        
        removeButton.click(function() {
            newSection.remove(); 
            var sectionsExist = $("#" + targetId).children().length > 0;
            $("#neftHr").toggle(sectionsExist);
        });

        
        newSection.find("#addButton").replaceWith(removeButton);

        $("#" + targetId).append(newSection);
        var sectionsExist = $("#" + targetId).children().length > 0;
        $("#neftHr").toggle(sectionsExist);
    }


    // Function to calculate the Total Premium based on GST and Net Premium
    function calculateTotalPremium(netOdPremiumInput, netTerrorismPremiumInput, gstInput, totalPremiumInput) {
        const netOdPremiumValue = parseFloat(netOdPremiumInput.value) || 0;
        const netTerrorismPremiumValue = parseFloat(netTerrorismPremiumInput.value) || 0;
        const gstValue = parseFloat(gstInput.value) || 0;
        const totalPremiumValue = (netOdPremiumValue + netTerrorismPremiumValue) + ((netOdPremiumValue + netTerrorismPremiumValue) * (gstValue / 100));
        totalPremiumInput.value = totalPremiumValue.toFixed(2);
    }

    // Attach event listeners to input fields for dynamic calculation
    const netOdPremiumInputs = document.querySelectorAll('.net-od-premium');
    const netTerrorismPremiumInputs = document.querySelectorAll('.net-terrorism-premium');
    const gstInputs = document.querySelectorAll('.gst');
    const totalPremiumInputs = document.querySelectorAll('.total-premium');

    netOdPremiumInputs.forEach((netOdPremiumInput, index) => {
        netOdPremiumInput.addEventListener('input', () => {
            calculateTotalPremium(netOdPremiumInput, netTerrorismPremiumInputs[index], gstInputs[index], totalPremiumInputs[index]);
        });

        netTerrorismPremiumInputs[index].addEventListener('input', () => {
            calculateTotalPremium(netOdPremiumInput, netTerrorismPremiumInputs[index], gstInputs[index], totalPremiumInputs[index]);
        });

        gstInputs[index].addEventListener('input', () => {
            calculateTotalPremium(netOdPremiumInput, netTerrorismPremiumInputs[index], gstInputs[index], totalPremiumInputs[index]);
        });
    });


    $('#dynamicFieldsContainer').on('input', '.net-od-premium', function() {
        const index = $('.net-od-premium').index(this);
        calculateTotalPremium(this, $('.net-terrorism-premium').eq(index)[0], $('.gst').eq(index)[0], $('.total-premium').eq(index)[0]);

    });

    $('#dynamicFieldsContainer').on('input', '.net-terrorism-premium', function() {
        const index = $('.net-terrorism-premium').index(this);
        calculateTotalPremium($('.net-od-premium').eq(index)[0], this, $('.gst').eq(index)[0], $('.total-premium').eq(index)[0]);
    });

    $('#dynamicFieldsContainer').on('input', '.gst', function() {
        const index = $('.gst').index(this);
        calculateTotalPremium($('.net-od-premium').eq(index)[0], $('.net-terrorism-premium').eq(index)[0], this, $('.total-premium').eq(index)[0]);
    });
    // ===========================================================================================================

</script>
@endsection

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>