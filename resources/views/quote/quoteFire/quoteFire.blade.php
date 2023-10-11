@extends('layouts.master')

@section('content')
    @include('common.partials._messages')

    <div class="overflow-x-auto mb-5 w-11/12 border border-slate-400 border-solid shadow  rounded mx-auto"
        style="border-color: #CCCCCC !important;">
        <div class="flex flex-wrap justify-center bg-transparent py-3 px-3">
            <form action="{{ route('quote.generate') }}"
                method="POST"
                class="w-full">
                @csrf
                {{-- hidden fields --}}
                <input type="hidden"
                    name="product_id"
                    id="product_id"
                    value="{{ old('product_id', $productId ?? $quoteData->product->uuid) }}"
                    readonly>
                <input type="hidden"
                    name="customer_id"
                    id="customer_id"
                    value="{{ old('customer_id', $quoteData->customer->uuid ?? '') }}">
                <input type="hidden"
                    name="quote_id"
                    id="quote_id"
                    value="{{ old('quote_id', $quoteData->id ?? '') }}">
                {{-- ---------------------------------------------------------------------- --}}

                <div class="md:flex md:flex-row md:items-start align-top mb-6">
                    <div class="w-1/2">
                        <div>
                            <label for="customerName"
                                class=" text-[#0F628B] text-sm">Customer Name <span
                                    class="text-red-600"><strong>*</strong></span> </label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] rounded-sm border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="Search here"
                                value="{{ old('name', optional($quoteData->customer)->name ?? '') }}">
                            <div id="nameSuggestions"
                                class="suggestions"></div>

                        </div>
                    </div>
                    <div class="w-1/2">
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Customer Mailing Address <span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <textarea
                                class="h-10 p-2 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 custom-textarea bg-white overflow-hidden  text-gray-500 text-xs @error('address') border-red-500 @enderror resize-none"
                                name="address"
                                id="customerAddress">{{ old('address', optional($quoteData->customer)->address ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px]">
                    <div class="w-1/2">
                        <div>
                            <label class=" text-[#0F628B] text-sm">Risk Location Address <span
                                    class="text-red-600"><strong>*</strong></span> </label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                id="riskLocation"
                                name="risk_location"
                                value="{{ old('risk_location') ?? ($quoteData->risk_location ?? '') }}">
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div>
                            <label class="text-[#0F628B] text-sm">Risk Occupancy
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <select type="text"
                                class="js-select2 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1"
                                name="risk_occupancy_id"
                                id="occupancySelect">
                                <option value=""
                                    disabled
                                    selected
                                    class="text-gray-500 text-xs">Select Risk Occupancy</option>
                                @foreach ($occupancies as $occupancy)
                                    <option value="{{ $occupancy->uuid }}"
                                        data-risk-code="{{ $occupancy->risk_code }}"
                                        data-iib-code="{{ $occupancy->iib_code }}"
                                        {{ old('risk_occupancy_id') == $occupancy->uuid ? 'selected' : '' }}>
                                        {{ $occupancy->risk_occupancy }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="selectedCodes"
                                style="display: none;">
                                <p>
                                    <strong>Risk Code:</strong> <span id="riskCode"></span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong>IIB Code:</strong> <span id="iibCode"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:flex md:flex-row md:items-start mt-1">

                    <div class="w-1/5">
                        <div>
                            <label class="text-[#0F628B] text-sm">Select RM
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <select type="text"
                                class=" h-8 p-2 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                id="rmSelect"
                                name="rm_id">
                                <option value=""
                                    disabled
                                    selected>Select RM</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->uuid }}"
                                        {{ old('rm_id', optional($quoteData)->rm_id) == $employee->uuid ? 'selected' : '' }}>
                                        {{ $employee->name }} -
                                        [{{ $employee->phone }}]
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="md:flex md:flex-row md:items-start mt-5 mb-6">
                    <div class="w-1/5">
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Policy type
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <select type="text"
                                class=" h-8 p-2 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                id="select-policy-type"
                                name="policy_type">
                                <option value=""
                                    disabled
                                    selected>Select Policy Type</option>
                                <option value="Fresh"
                                    {{ old('policy_type', $quoteData->policy_type) === 'Fresh' ? 'selected' : '' }}>Fresh
                                </option>
                                <option value="Rollover"
                                    {{ old('policy_type', $quoteData->policy_type) === 'Rollover' ? 'selected' : '' }}>
                                    Rollover</option>
                                <option value="Renew"
                                    {{ old('policy_type', $quoteData->policy_type) === 'Renew' ? 'selected' : '' }}>Renew
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="w-1/5 rollover-policy"
                        hidden>
                        <div>
                            <label class="text-[#0F628B] text-sm">Expiry Insurer
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid bg-white dark:bg-gray-800 focus:ring-0 focus:border-[#FFC451] focus:border-1 overflow-hidden text-gray-500 text-xs"
                                name="expiryInsurer">
                        </div>
                    </div>

                    <div class="w-1/5 rollover-policy"
                        hidden>
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Policy No
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="policyNo">
                        </div>
                    </div>

                    <div class="w-1/5 rollover-policy"
                        hidden>
                        <div>
                            <label class="text-[#0F628B] text-sm">Policy Start Date
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="date"
                                class="h-8 text-center w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 border-solid bg-white overflow-hidden  text-gray-500 text-xs"
                                name="policyStartDate">
                        </div>
                    </div>

                    <div class="w-1/5 rollover-policy"
                        hidden>
                        <div>
                            <label class="text-[#0F628B] text-sm">Policy End Date
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="date"
                                class="h-8 text-center w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="policyEndDate">
                        </div>
                    </div>

                    <div class="w-1/5 renew-policy"
                        hidden>
                        <div>
                            <label class="text-[#0F628B] text-sm">Policy No
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="renewPolicyNo"
                                id="renewPolicyNo">

                            <div id="policySuggestions"
                                class="policyRenewSuggestions"></div>
                        </div>
                    </div>
                </div>


                <div class="md:flex md:flex-row md:items-start mt-[-20px] mb-6">
                    <div class="w-1/4">
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Claim Since last 36 months
                                <span class="text-red-600"><strong>*</strong></span>
                            </label>
                            <input type="hidden"
                                name="claim_status"
                                value=0>
                        </div>
                        <div class="flex mt-[10px] mr-[20px] w-10/12 justify-end">

                            <label class="button-claim-check">
                                <input type="checkbox"
                                    id="toggle-claim-check"
                                    class="claim-check"
                                    data-target="claimStatus"
                                    name="claim_status"
                                    value=1>
                                <span class="slider-claim-check"></span>
                            </label>
                        </div>

                    </div>

                    <div class="w-1/4 claim-year"
                        hidden
                        data-target="claimStatus">
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Claim Year<span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <select type="text"
                                class="year-select-field h-8 p-2 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="year_of_claim">
                                <option value=""
                                    disabled
                                    selected>Select Year</option>
                                @php
                                    $currentYear = date('Y');
                                    $lastThreeYears = range($currentYear, $currentYear - 3);
                                @endphp
                                @foreach ($lastThreeYears as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="w-1/4 cause-of-loss"
                        hidden
                        data-target="claimStatus">
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Cause Of Loss
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="cause_of_loss">
                        </div>

                    </div>

                    <div class="w-1/4 claim-amount"
                        hidden
                        data-target="claimStatus">
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Claim Amount <span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="number"
                                step="any"
                                class="claim-input-field h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                pattern="^\d+(\.\d+)?$"
                                name="claim_amount">
                        </div>

                    </div>
                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px] mb-6">
                    <div class="w-2/6">
                        <div class="overflow-x-auto">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="buildingsSTRW"
                                {{ old('buildings_and_other_structural_work', $quoteData->buildings_and_other_structural_work) != 0 ? 'checked' : '' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Buildings & other structural works</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="buildingsSTRW">
                            <input type="number"
                                class="sum-field h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                inputmode="decimal"
                                name="buildings_and_other_structural_work"
                                value="{{ old('buildings_and_other_structural_work', $quoteData->buildings_and_other_structural_work) }}"
                                {{ $quoteData->buildings_and_other_structural_work != 0 ? '' : 'disabled' }}>
                        </div>

                    </div>
                    <div class="w-2/6">
                        <div>
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="plant&machines"
                                {{ old('plants_and_machines', $quoteData->plants_and_machines) != 0 ? 'checked' : '' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Plant & Machines</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="plant&machines">
                            <input type="text"
                                class="sum-field h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                name="plants_and_machines"
                                value="{{ old('plants_and_machines', $quoteData->plants_and_machines) }}"
                                {{ old('plants_and_machines', $quoteData->plants_and_machines) != 0 ? '' : 'disabled' }}>
                        </div>
                        <div class="flex-row mt-1 second-input-suminsured"
                            data-target="plant&machines"
                            {{ old('plants_and_machines', $quoteData->plants_and_machines) != 0 ? '' : 'hidden' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">MBD</label>
                            <input type="text"
                                class="h-8 p-1 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1  border-solid bg-white overflow-hidden text-gray-500 text-xs"
                                name="mbd"
                                placeholder="0.00"
                                value="{{ old('mbd', $quoteData->mbd) }}">
                        </div>

                    </div>

                    <div class="w-2/6">
                        <div>
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="electricalFittings"
                                {{ old('electrical_fittings', $quoteData->electrical_fittings) != 0 ? 'checked' : '' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Electrical Fittings</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="electricalFittings">
                            <input type="text"
                                class="sum-field h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                name="electrical_fittings"
                                value="{{ old('electrical_fittings', $quoteData->electrical_fittings) }}"
                                {{ old('electrical_fittings', $quoteData->electrical_fittings) != 0 ? '' : 'disabled' }}>
                        </div>
                        <div class="second-input-suminsured flex-row mt-1"
                            data-target="electricalFittings"
                            {{ old('electrical_fittings', $quoteData->electrical_fittings) != 0 ? '' : 'hidden' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">EEI</label>
                            <input type="text"
                                class="h-8 p-1 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                name="eei"
                                value="{{ old('eei', $quoteData->eei) }}">
                        </div>
                    </div>

                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px] mb-6">
                    <div class="w-2/6">
                        <div class="flex-row align-items-center">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="computer&Movables"
                                {{ old('computer_and_all_movables', $quoteData->computer_and_all_movables) != 0 ? 'checked' : '' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Computer & All Movables</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="computer&Movables">
                            <input type="text"
                                class="sum-field h-8 p-1 w-11/12 border-[#CCCCCC] border-1 border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                name="computer_and_all_movables"
                                value="{{ old('computer_and_all_movables', $quoteData->computer_and_all_movables) }}"
                                {{ $quoteData->computer_and_all_movables != 0 ? '' : 'disabled' }}>
                        </div>
                    </div>
                    <div class="w-2/6">
                        <div class="overflow-x-auto">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="furnitureFittings"
                                {{ old('furniture_and_fittings', $quoteData->furniture_and_fittings) != 0 ? 'checked' : '' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Furniture Fixtures & Fittings</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="furnitureFittings">
                            <input type="text"
                                class="sum-field h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                name="furniture_and_fittings"
                                value="{{ old('furniture_and_fittings', $quoteData->furniture_and_fittings) }}"
                                {{ $quoteData->furniture_and_fittings != 0 ? '' : 'disabled' }}>
                        </div>

                    </div>
                    <div class="w-2/6">
                        <div>
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="stockInProcess"
                                {{ old('stock_in_process', $quoteData->stock_in_process) != 0 ? 'checked' : '' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Stock In Process</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="stockInProcess">
                            <input type="text"
                                class="sum-field h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                name="stock_in_process"
                                value="{{ old('stock_in_process', $quoteData->stock_in_process) }}"
                                {{ $quoteData->stock_in_process != 0 ? '' : 'disabled' }}>
                        </div>

                    </div>

                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px] mb-6">
                    <div class="w-2/6">
                        <div>
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="finishedGoods"
                                {{ old('finished_good', $quoteData->finished_good) != 0 ? 'checked' : '' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Finished Goods</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="finishedGoods">
                            <input type="text"
                                class="sum-field h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                name="finished_good"
                                value="{{ old('finished_good', $quoteData->finished_good) }}"
                                {{ $quoteData->finished_good != 0 ? '' : 'disabled' }}>
                        </div>
                    </div>

                    <div class="w-2/6">
                        <div class="flex-row align-items-center">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="fassadeGlasses"
                                {{ old('fassade_glasses', $quoteData->fassade_glasses) != 0 ? 'checked' : '' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Fassade Glasses</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="fassadeGlasses">
                            <input type="text"
                                class="sum-field h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                name="fassade_glasses"
                                value="{{ old('fassade_glasses', $quoteData->fassade_glasses) }}"
                                {{ old('fassade_glasses', $quoteData->fassade_glasses) != 0 ? '' : 'disabled' }}>
                        </div>
                        <div class="flex-row mt-1 second-input-suminsured"
                            {{ old('fassade_glasses', $quoteData->fassade_glasses) != 0 ? '' : 'hidden' }}
                            data-target="fassadeGlasses">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">PGI</label>
                            <input type="text"
                                class="h-8 p-1 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                name="pgi"
                                value="{{ old('pgi', $quoteData->pgi) }}">
                        </div>
                    </div>
                    <div class="w-2/6">
                        <div class="overflow-x-auto">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="lossOfRent"
                                {{ old('loss_of_rent', $quoteData->loss_of_rent) != 0 ? 'checked' : '' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Loss Of Rent</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="lossOfRent">
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                name="loss_of_rent"
                                value="{{ old('loss_of_rent', $quoteData->loss_of_rent) }}"
                                {{ old('loss_of_rent', $quoteData->loss_of_rent) != 0 ? '' : 'disabled' }}>
                        </div>

                        <div class="flex-row mt-1 second-input-suminsured"
                            {{ old('loss_of_rent', $quoteData->loss_of_rent) != 0 ? '' : 'hidden' }}
                            data-target="lossOfRent">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">No of months</label>
                            <input type="number"
                                class="h-8 p-1 w-25 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                min="0"
                                max="12"
                                oninput="validity.valid||(value='');"
                                inputmode="numeric"
                                name="no_of_months_loss"
                                value="{{ old('no_of_months_loss', $quoteData->no_of_months_loss) }}">
                        </div>

                    </div>

                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px] mb-6">

                    <div class="w-2/6">
                        <div class="overflow-x-auto">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="businessInteruption"
                                {{ old('business_interuption', $quoteData->business_interuption) != 0 ? 'checked' : '' }}>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Business Interuption</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="businessInteruption">
                            <input type="number"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                disabled
                                inputmode="numeric"
                                name="business_interuption"
                                value="{{ old('business_interuption', $quoteData->business_interuption) }}"
                                {{ old('business_interuption', $quoteData->business_interuption) != 0 ? '' : 'disabled' }}>
                        </div>

                        <div class="flex-row mt-1 second-input-suminsured"
                            {{ old('business_interuption', $quoteData->business_interuption) != 0 ? '' : 'hidden' }}
                            data-target="businessInteruption">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">No of months</label>
                            <input type="number"
                                class="h-8 p-1 w-25 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 border-solid bg-white overflow-hidden text-gray-500 text-xs"
                                placeholder="0.00"
                                min="0"
                                max="12"
                                oninput="validity.valid||(value='');"
                                inputmode="numeric"
                                name="bi_no_of_months"
                                value="{{ old('bi_no_of_months', $quoteData->bi_no_of_months) }}">
                        </div>

                    </div>

                    <div class="w-2/6">
                        <div class="flex inline mt-2 gap-2">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Basement Risk<span class="text-red-600"></label>
                            <input type="hidden"
                                name="basement_risk"
                                value=0>

                            <label for="toggle"
                                class="button">
                                <input type="checkbox"
                                    id="toggle"
                                    name="basement_risk"
                                    class="basement-no"
                                    value=1
                                    checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="w-2/6">
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Total Sum Insured : </label>
                        </div>
                        <div>
                            <strong>Total Sum Insured:</strong> <span
                                id="totalSum">{{ old('total_sum_insured') ?: (optional($quoteData)->total_sum_insured ? $quoteData->total_sum_insured : 0) }}</span>
                            <input type="hidden"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid bg-white dark:bg-gray-800 outline-0 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs"
                                name="total_sum_insured"
                                id="hiddenTotalSum"
                                placeholder="0.00"
                                value="{{ old('total_sum_insured') ?: (optional($quoteData)->total_sum_insured ? $quoteData->total_sum_insured : '') }}">
                        </div>

                    </div>
                </div>


                <div class="flex justify-start flex-row">

                    <div class="overflow-x-auto mx-2">
                        <input type="checkbox"
                            class="form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                            id="moneyCheckbox">
                        <label class="text-[#0F628B] text-sm">Money</label>
                    </div>
                </div>

                <div class="md:flex md:flex-row md:items-start mt-1 ml-1 mb-6"
                    id="hiddenDivMoney"
                    style="display: none;">
                    <div class="w-1/4">
                        <div>
                            <label class="text-[#0F628B] text-sm">In Safe
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="cash_in_safe">
                        </div>

                    </div>

                    <div class="w-1/4">
                        <div>
                            <label class="text-[#0F628B] text-sm">In Counter
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="cash_in_counter">
                        </div>
                    </div>
                    <div class="w-1/4">
                        <div>
                            <label class="text-[#0F628B] text-sm">In Transit
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="cash_in_transit">
                        </div>

                    </div>

                    <div class="w-1/4">
                        <div>
                            <label class="text-[#0F628B] text-sm">PSL
                                <span class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="psl">
                        </div>

                    </div>

                </div>

                <div class="flex justify-start flex-row">

                    <div class="overflow-x-auto mx-2">
                        <input type="checkbox"
                            class="form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                            checked
                            disabled>
                        <label class="text-[#0F628B] text-sm">STFI</label>
                    </div>

                    <div class="overflow-x-auto mx-2">
                        <input type="checkbox"
                            class="form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                            checked
                            disabled>
                        <label class="text-[#0F628B] text-sm">EQ</label>
                    </div>

                    <div class="overflow-x-auto mx-2">
                        <input type="hidden"
                            name="terrorism"
                            value="0">
                        <input type="checkbox"
                            class="form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                            name="terrorism"
                            value="1">
                        <label class="text-[#0F628B] text-sm">Terrorism</label>
                    </div>

                    <div class="overflow-x-auto mx-2">
                        <input type="hidden"
                            name="burglary"
                            value="0">
                        <input type="checkbox"
                            class="form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                            name="burglary"
                            value="1">
                        <label class="text-[#0F628B] text-sm">Burglary</label>
                    </div>
                </div>

                <div class="flex justify-center flex-row">
                    <button type="submit"
                        class="logout_button block px-6  py-2 mt-3 border border-solid border-dark rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                        Save
                    </button>
                    <a href="#"
                        class="inline px-6 py-2 mt-3 border text-green-500 border-solid border-dark rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                        <i class="fa fa-file-excel mr-2"></i>Export to Excel
                    </a>
                    <a href="#"
                        class="inline px-6 py-2 mt-3 border border-solid rounded-2xl border-dark bg-gradient-to-r from-[#ef4444] to-[#15803d] bg-clip-text text-transparent text-xs   ml-2 font-bold">
                        <i class="fas fa-envelope mr-2"></i>Send Mail
                    </a>
                </div>
            </form>
        </div>

    </div>


    <!-- name Address Auto populate -->
    <script>
        $(document).ready(function() {

            $('#customerName').on('input', function() {
                var inputText = $(this).val();

                $('#customerAddress').val('').prop('readonly', false);

                if (inputText === '') {
                    $('#nameSuggestions').hide();
                    return;
                }

                $.ajax({
                    url: '/search-customers',
                    method: 'GET',
                    data: {
                        q: inputText
                    },
                    success: function(response) {
                        var suggestions = response.data;

                        var suggestionsHtml = '';
                        for (var i = 0; i < suggestions.length; i++) {
                            suggestionsHtml += '<div class="suggestion">' + suggestions[i]
                                .name + '</div>';
                        }
                        $('#nameSuggestions').html(suggestionsHtml);
                        $('#nameSuggestions').show();

                        $('.suggestion').on('mouseenter', function() {
                            var selectedName = $(this).text();
                            $('#customerName').val(selectedName);

                            var selectedCustomer = suggestions.find(function(customer) {
                                return customer.name === selectedName;
                            });
                            $('#customerAddress').val(selectedCustomer.address);
                            $('#customer_id').val(selectedCustomer.uuid);
                            $('#customerAddress').prop('readonly', true);
                            // $('#nameSuggestions').hide();
                        });
                    }
                });
            });

            $('#customerName').on('focusout', function() {
                suggestionsTimeout = setTimeout(function() {
                    $('#nameSuggestions').hide();
                }, 200);
            });

            $('#nameSuggestions').on('mouseenter', function() {
                clearTimeout(suggestionsTimeout);
            });

        });
    </script>


    {{-- Renewal   Auot Popolate --}}
    <script>
        $(document).ready(function() {

            $('#renewPolicyNo').on('input', function() {
                var inputText = $(this).val();
                // $('#customerAddress').val('').prop('readonly', false);

                // if (inputText === '') {
                //     $('#nameSuggestions').hide();
                //     return;
                // }

                $.ajax({
                    url: '/search-quote',
                    method: 'GET',
                    data: {
                        q: inputText
                    },
                    success: function(response) {
                        var suggestions = response.data;

                        var suggestionsHtml = '';
                        for (var i = 0; i < suggestions.length; i++) {
                            suggestionsHtml += '<div class="suggestionRenew">' + suggestions[i]
                                .policy_number + '</div>';
                        }
                        $('#policySuggestions').html(suggestionsHtml);
                        $('#policySuggestions').show();

                        $('.suggestionRenew').on('mouseenter', function() {
                            var selectedPolicyNumber = $(this).text();
                            $('#renewPolicyNo').val(selectedPolicyNumber);

                            var selectedPolicy = suggestions.find(function(policy) {
                                return policy.policy_number ===
                                    selectedPolicyNumber;
                            });
                            $('#riskLocation').val(selectedPolicy.risk_location);
                            $('#customerName').val(selectedPolicy.name);
                            $('#customerAddress').val(selectedPolicy.address);

                            if (selectedPolicy.buildings_and_other_structural_work !==
                                0) {
                                $('#checkbox1').prop('checked', true);
                                $('#buildings_and_other_structural_work')
                                    .prop('disabled', false)
                                    .val(selectedPolicy
                                        .buildings_and_other_structural_work);
                            } else {
                                $('#checkbox1').prop('checked', false);
                            }


                            if (selectedPolicy.plants_and_machines !==
                                0) {
                                $('#checkbox2').prop('checked', true);
                                $('#plants_and_machines')
                                    .prop(
                                        'disabled', false)
                                    .val(
                                        selectedPolicy
                                        .plants_and_machines);

                                if (selectedPolicy.mbd !==
                                    0) {
                                    $('#mbd')
                                        .closest('.additional-sub-field')
                                        .show()
                                        .end()
                                        .prop('disabled', false)
                                        .val(selectedPolicy.mbd);
                                }
                            } else {
                                $('#checkbox2').prop('checked', false);

                                $('#plants_and_machines')
                                    .prop('disabled', true)
                                    .val('');

                                $('#mbd')
                                    .closest('.additional-sub-field')
                                    .hide()
                                    .end()
                                    .prop('disabled', true)
                                    .val('');
                            }

                            if (selectedPolicy.electrical_fittings !==
                                0) {
                                $('#checkbox3').prop('checked', true);
                                $('#electrical_fittings')
                                    .prop(
                                        'disabled', false)
                                    .val(
                                        selectedPolicy
                                        .electrical_fittings);

                                if (selectedPolicy.eei !==
                                    0) {
                                    $('#eei')
                                        .closest('.additional-sub-field')
                                        .show()
                                        .end()
                                        .prop('disabled', false)
                                        .val(selectedPolicy.mbd);
                                }
                            } else {
                                $('#checkbox3').prop('checked', false);

                                $('#electrical_fittings')
                                    .prop('disabled', true)
                                    .val('');

                                $('#eei')
                                    .closest('.additional-sub-field')
                                    .hide()
                                    .end()
                                    .prop('disabled', true)
                                    .val('');
                            }

                            if (selectedPolicy.computer_and_all_movables !==
                                0) {
                                $('#checkbox4').prop('checked', true);
                                $('#computer_and_all_movables')
                                    .prop('disabled', false)
                                    .val(selectedPolicy
                                        .computer_and_all_movables);
                            } else {
                                $('#checkbox4').prop('checked', false);
                                $('#computer_and_all_movables')
                                    .prop('disabled', true)
                                    .val('');
                            }

                            if (selectedPolicy.furniture_and_fittings !==
                                0) {
                                $('#checkbox5').prop('checked', true);
                                $('#furniture_and_fittings')
                                    .prop('disabled', false)
                                    .val(selectedPolicy
                                        .furniture_and_fittings);
                            } else {
                                $('#checkbox5').prop('checked', false);
                                $('#furniture_and_fittings')
                                    .prop('disabled', true)
                                    .val('');
                            }


                            if (selectedPolicy.stock_in_process !==
                                0) {
                                $('#checkbox6').prop('checked', true);
                                $('#stock_in_process')
                                    .prop('disabled', false)
                                    .val(selectedPolicy
                                        .stock_in_process);
                            } else {
                                $('#checkbox6').prop('checked', false);
                                $('#stock_in_process')
                                    .prop('disabled', true)
                                    .val('');
                            }

                            if (selectedPolicy.finished_good !==
                                0) {
                                $('#checkbox7').prop('checked', true);
                                $('#finished_good')
                                    .prop('disabled', false)
                                    .val(selectedPolicy
                                        .finished_good);
                            } else {
                                $('#checkbox7').prop('checked', false);
                                $('#finished_good')
                                    .prop('disabled', true)
                                    .val('');
                            }


                            if (selectedPolicy.fassade_glasses !==
                                0) {
                                $('#checkbox8').prop('checked', true);
                                $('#fassade_glasses')
                                    .prop(
                                        'disabled', false)
                                    .val(
                                        selectedPolicy
                                        .fassade_glasses);

                                if (selectedPolicy.eei !==
                                    0) {
                                    $('#pgi')
                                        .closest('.additional-sub-field')
                                        .show()
                                        .end()
                                        .prop('disabled', false)
                                        .val(selectedPolicy.pgi);
                                }
                            } else {
                                $('#checkbox8').prop('checked', false);

                                $('#fassade_glasses')
                                    .prop('disabled', true)
                                    .val('');

                                $('#pgi')
                                    .closest('.additional-sub-field')
                                    .hide()
                                    .end()
                                    .prop('disabled', true)
                                    .val('');
                            }


                            if (selectedPolicy.loss_of_rent !==
                                0) {
                                $('#checkbox9').prop('checked', true);
                                $('#loss_of_rent')
                                    .prop(
                                        'disabled', false)
                                    .val(
                                        selectedPolicy
                                        .loss_of_rent);

                                if (selectedPolicy.no_of_months_loss !==
                                    0) {
                                    $('#no_of_months_loss')
                                        .closest('.additional-sub-field')
                                        .show()
                                        .end()
                                        .prop('disabled', false)
                                        .val(selectedPolicy.no_of_months_loss);
                                }
                            } else {
                                $('#checkbox9').prop('checked', false);

                                $('#loss_of_rent')
                                    .prop('disabled', true)
                                    .val('');

                                $('#no_of_months_loss')
                                    .closest('.additional-sub-field')
                                    .hide()
                                    .end()
                                    .prop('disabled', true)
                                    .val('');
                            }



                            if (selectedPolicy.business_interuption !==
                                0) {
                                $('#checkbox10').prop('checked', true);
                                $('#business_interuption')
                                    .prop(
                                        'disabled', false)
                                    .val(
                                        selectedPolicy
                                        .loss_of_rent);

                                if (selectedPolicy.bi_no_of_months !==
                                    0) {
                                    $('#bi_no_of_months')
                                        .closest('.additional-sub-field')
                                        .show()
                                        .end()
                                        .prop('disabled', false)
                                        .val(selectedPolicy.bi_no_of_months);
                                }
                            } else {
                                $('#checkbox10').prop('checked', false);

                                $('#business_interuption')
                                    .prop('disabled', true)
                                    .val('');

                                $('#bi_no_of_months')
                                    .closest('.additional-sub-field')
                                    .hide()
                                    .end()
                                    .prop('disabled', true)
                                    .val('');
                            }



                        });
                    }
                });
            });

            $('#renewPolicyNo').on('focusout', function() {
                suggestionsTimeout = setTimeout(function() {
                    $('#policySuggestions').hide();
                }, 200);
            });

            $('#policySuggestions').on('mouseenter', function() {
                clearTimeout(suggestionsTimeout);
            });

        });
    </script>





    <!-- Risk Occupancy -->

    <script>
        $(document).ready(function() {
            $('#occupancySelect').select2();

            $('#occupancySelect').on('select2:select', function(e) {
                var selectedOption = $(this).find(':selected');
                var riskCode = selectedOption.data('risk-code');
                var iibCode = selectedOption.data('iib-code');

                $('#riskCode').text(riskCode);
                $('#iibCode').text(iibCode);
                $('#selectedCodes').show();
            });

            $('#occupancySelect').on('select2:unselect', function(e) {
                $('#selectedCodes').hide();
            });

            // Check if there's an old value for risk_occupancy_id
            var oldRiskOccupancyId = "{{ old('risk_occupancy_id') }}";
            if (oldRiskOccupancyId) {
                var selectedOption = $('#occupancySelect').find('option[value="' + oldRiskOccupancyId + '"]');
                var riskCode = selectedOption.data('risk-code');
                var iibCode = selectedOption.data('iib-code');

                $('#riskCode').text(riskCode);
                $('#iibCode').text(iibCode);
                $('#selectedCodes').show();
            }

        });
    </script>


    <!-- RM Selection -->

    <script>
        $(document).ready(function() {
            $('#rmSelect').select2();
        });
    </script>


    <!-- Policy Type -->
    <script>
        $(document).ready(function() {
            function updatePolicyTypeVisibility(selectedOption) {
                if (selectedOption === 'Fresh') {
                    $('.rollover-policy').prop('hidden', true);
                    $('.renew-policy').prop('hidden', true);
                } else if (selectedOption === 'Rollover') {
                    $('.renew-policy').prop('hidden', true);
                    $('.rollover-policy').prop('hidden', false);
                } else if (selectedOption === 'Renew') {
                    $('.rollover-policy').prop('hidden', true);
                    $('.renew-policy').prop('hidden', false);
                }
            }

            $('#select-policy-type').on('change', function() {
                var selectedOption = $(this).val();
                updatePolicyTypeVisibility(selectedOption);
            });

            // Initialize visibility and behavior based on the currently selected option
            var initialSelectedOption = $('#select-policy-type').val();
            updatePolicyTypeVisibility(initialSelectedOption);
        });
    </script>

    <!-- Claim Since last 36 months -->
    <script>
        $(document).ready(function() {
            $('.claim-check').click(function() {
                const claimYearDiv = $('.claim-year');
                const causeOfLossDiv = $('.cause-of-loss');
                const claimAmountDiv = $('.claim-amount');
                if (!this.checked) {
                    claimYearDiv.find('.year-select-field').prop('selectedIndex', 0);
                    claimYearDiv.prop('hidden', true);
                    causeOfLossDiv.find('.cause-select-field').prop('selectedIndex', 0);
                    causeOfLossDiv.prop('hidden', true);
                    claimAmountDiv.find('.claim-input-field').val('');
                    claimAmountDiv.prop('hidden', true);
                } else {
                    claimYearDiv.prop('hidden', false);
                    causeOfLossDiv.prop('hidden', false);
                    claimAmountDiv.prop('hidden', false);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".js-select2").select2({
                closeOnSelect: false
            });

            $('.basement-no').click(function(event) {
                if (!this.checked) {
                    const confirmation = confirm("Are you excluding basement risk ?");
                    if (!confirmation) {
                        event.preventDefault();
                    }
                }
            });

            // check box functionality for SumInsured fields hide & disable 
            $('.sumInsuredCheckBoxes').change(function() {
                const target = $(this).data('target');
                const sumInsuredFirstInputDiv = $(`.first-input-suminsured[data-target="${target}"]`);
                const sumInsuredSecondInputDiv = $(`.second-input-suminsured[data-target="${target}"]`);
                if (this.checked) {
                    sumInsuredFirstInputDiv.find('input').prop('disabled', false);
                    sumInsuredSecondInputDiv.prop('hidden', false);
                } else {
                    sumInsuredFirstInputDiv.find('input').val('');
                    sumInsuredSecondInputDiv.find('input').val('');
                    sumInsuredFirstInputDiv.find('input').prop('disabled', true);
                    sumInsuredSecondInputDiv.prop('hidden', true);

                }

            });

            // For reflect the first input content to the second input content for the sumInsured first and second fields

            // $('.first-input-suminsured input').on('input', function() {
            //     const target = $(this).closest('.first-input-suminsured').data('target');
            //     const secondInput = $(`.second-input-suminsured[data-target="${target}"] input`);
            //     secondInput.val($(this).val());
            // });

            $('.first-input-suminsured input').on('input', function() {
                const target = $(this).closest('.first-input-suminsured').data('target');
                if (target !== 'businessInteruption' && target !== 'lossOfRent') {
                    const secondInput = $(`.second-input-suminsured[data-target="${target}"] input`);
                    secondInput.val($(this).val());
                }
            });
        });
    </script>


    <script>
        // Function to calculate the sum of input fields
        function calculateSum() {
            let sum = 0;
            const sumFields = document.querySelectorAll('.sum-field');

            sumFields.forEach(field => {
                const value = parseFloat(field.value) || 0; // Convert value to float or set to 0 if invalid
                sum += value;
            });

            return sum;
        }

        // Function to update the total sum on the page
        function updateTotalSum() {
            const totalSumField = document.getElementById('totalSum');
            const hiddenTotalSumField = document.getElementById('hiddenTotalSum');


            const sum = calculateSum();
            totalSumField.textContent = sum;
            hiddenTotalSumField.value = sum;
        }

        // Attach event listeners to input fields for dynamic calculation
        const sumFields = document.querySelectorAll('.sum-field');
        sumFields.forEach(field => {
            field.addEventListener('input', updateTotalSum);
        });
    </script>


    {{-- Money --}}
    <script>
        $('#moneyCheckbox').change(function() {
            if ($(this).is(':checked')) {
                $('#hiddenDivMoney').show();
            } else {
                $('#hiddenDivMoney').hide();
            }
        });
    </script>
@endsection

<style>
    .select2.select2-container {
        width: 91.66% !important;
    }

    .select2.select2-container .select2-selection {
        border: 1px solid #ccc;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        height: 34px;
        margin-bottom: 15px;
        outline: none !important;
        transition: all .15s ease-in-out;
        font-size: small;
        color: #9CACCB;
    }

    .select2.select2-container .select2-selection .select2-selection__rendered {
        color: #6B7280;
        line-height: 32px;
        padding-right: 33px;
    }

    .select2.select2-container .select2-selection .select2-selection__arrow {
        background: #f8f8f8;
        border-left: 1px solid #ccc;
        -webkit-border-radius: 0 3px 3px 0;
        -moz-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;
        height: 32px;
        width: 33px;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
        background: #f8f8f8;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
        -webkit-border-radius: 0 3px 0 0;
        -moz-border-radius: 0 3px 0 0;
        border-radius: 0 3px 0 0;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
        border: 1px solid #34495e;
    }

    .select2.select2-container .select2-selection--multiple {
        height: auto;
        min-height: 34px;
    }

    .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
        margin-top: 0;
        height: 32px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
        display: block;
        padding: 0 4px;
        line-height: 29px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice {
        background-color: #f8f8f8;
        border: 1px solid #ccc;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        margin: 4px 4px 0 0;
        padding: 0 6px 0 22px;
        height: 24px;
        line-height: 24px;
        font-size: small;
        position: relative;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
        position: absolute;
        top: 0;
        left: 0;
        height: 22px;
        width: 22px;
        margin: 0;
        text-align: center;
        color: #e74c3c;
        /* font-weight: bold; */
        font-size: small;
    }

    .select2-container .select2-dropdown {
        background: transparent;
        border: none;
        margin-top: -5px;
    }

    .select2-container .select2-dropdown .select2-search {
        padding: 0;
    }

    .select2-container .select2-dropdown .select2-search input {
        outline: none !important;
        border: 1px solid #34495e !important;
        border-bottom: none !important;
        padding: 4px 6px !important;
    }

    .select2-container .select2-dropdown .select2-results {
        padding: 0;
    }

    .select2-container .select2-dropdown .select2-results ul {
        background: #fff;
        border: 1px solid #34495e;
        font-size: small !important;
    }

    .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
        background-color: #3498db;
        font-size: small !important;
    }
</style>


<style>
    /* Hide the spin buttons for number inputs */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* claim check start */
    /* ====================================== */
    .button-claim-check {
        display: inline-block;
        width: 50px;
        height: 20px;
        background-color: #fff;
        border-radius: 30px;
        cursor: pointer;
        padding: 0;
        color: white;
    }

    #toggle-claim-check {
        display: none;
    }

    .slider-claim-check {
        display: block;
        font-size: 10px;
        position: relative;
    }

    .slider-claim-check::after {
        content: 'NO';
        width: 25px;
        height: 25px;
        /* background-color: #e03c3c; */
        background-color: green;
        border: 2px solid #fff;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0, 0, 0, .25);
        position: absolute;
        top: -5px;
        left: 0;
        display: grid;
        place-content: center;
        line-height: 0;
        transition: background-color .25s, transform .25s ease-in;
        left: 0;
        /* rotation off */
    }

    #toggle-claim-check:checked+.slider-claim-check::after {
        content: 'YES';
        /* background-color: #05ae3e; */
        background-color: red;
        /* transform: translateX(25px) rotate(360deg); */
        left: 25px;
        /* Change this line */

    }


    /* LAST SWITCH START */
    /* ========================================== */

    .button {
        display: inline-block;
        width: 50px;
        height: 20px;
        background-color: #fff;
        border-radius: 30px;
        cursor: pointer;
        padding: 0;
        color: white;
    }

    #toggle {
        display: none;
    }

    .slider {
        display: block;
        font-size: 10px;
        position: relative;
    }

    .slider::after {
        content: 'NO';
        width: 25px;
        height: 25px;
        background-color: #e03c3c;
        border: 2px solid #fff;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0, 0, 0, .25);
        position: absolute;
        top: -5px;
        left: 0;
        display: grid;
        place-content: center;
        line-height: 0;
        transition: background-color .25s, transform .25s ease-in;
    }

    #toggle:checked+.slider::after {
        content: 'YES';
        background-color: #05ae3e;
        transform: translateX(25px) rotate(360deg);
    }
</style>
