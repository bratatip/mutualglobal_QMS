@extends('layouts.master')

@section('content')
    <div class="overflow-x-auto mb-5 w-11/12 border border-slate-400 border-solid shadow  rounded mx-auto"
        style="border-color: #CCCCCC !important;">
        <div class="flex flex-wrap justify-center bg-transparent py-3 px-3">
            <form action="#"
                method="POST"
                class="w-full">
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
                                placeholder="Search here">
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
                                id="customerAddress"></textarea>
                        </div>
                    </div>
                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px]">
                    <div class="w-1/2">
                        <div>
                            <label for="customerName"
                                class=" text-[#0F628B] text-sm">Risk Location Address <span
                                    class="text-red-600"><strong>*</strong></span> </label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName">
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div>
                            <label class="text-[#0F628B] text-sm">Risk Occupancy <span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <select type="text"
                                class="js-select2 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1"
                                name="risk_occupancy"
                                id="occupancySelect">
                                <option value=""
                                    disabled
                                    selected
                                    class="text-gray-500 text-xs">Select Risk Occupancy</option>
                                <option value="">Risk Occupancy 1</option>
                                <option value="">Risk Occupancy 2</option>
                                <option value="">Risk Occupancy 3</option>
                                <option value="">Risk Occupancy 4</option>
                                <option value="">Risk Occupancy 5</option>
                                <option value="">Risk Occupancy 6</option>
                                <option value="">Risk Occupancy 7</option>
                                <option value="">Risk Occupancy 8</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="md:flex md:flex-row md:items-start mt-5 mb-6">
                    <div class="w-1/5">
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Policy type <span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <select type="text"
                                class=" h-8 p-2 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="select-policy-type">
                                <option value=""
                                    disabled
                                    selected>Select Policy Type</option>
                                <option value="Fresh">Fresh</option>
                                <option value="Rollover">Rollover</option>
                                <option value="Renew">Renew</option>
                            </select>
                        </div>
                    </div>

                    <div class="w-1/5 rollover-policy"
                        hidden>
                        <div>
                            <label class="text-[#0F628B] text-sm">Expiry Insurer <span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid bg-white dark:bg-gray-800 focus:ring-0 focus:border-[#FFC451] focus:border-1 overflow-hidden text-gray-500 text-xs"
                                name="name">

                        </div>
                    </div>

                    <div class="w-1/5 rollover-policy"
                        hidden>
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Policy No <span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name">
                        </div>
                    </div>

                    <div class="w-1/5 rollover-policy"
                        hidden>
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Policy Start Date <span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="date"
                                class="h-8 text-center w-11/12 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 border-solid bg-white overflow-hidden  text-gray-500 text-xs"
                                name="name">
                        </div>
                    </div>

                    <div class="w-1/5 rollover-policy"
                        hidden>
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Policy End Date <span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="date"
                                class="h-8 text-center w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name">
                        </div>
                    </div>

                    <div class="w-1/5 renew-policy"
                        hidden>
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Policy No <span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name">
                        </div>
                    </div>
                </div>


                <div class="md:flex md:flex-row md:items-start mt-[-20px] mb-6">
                    <div class="w-1/4">
                        <div>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Claim Since last 36 months<span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div class="flex mt-[10px] mr-[20px] w-10/12 justify-end">

                            <label class="button-claim-check">
                                <input type="checkbox"
                                    id="toggle-claim-check"
                                    class="claim-check"
                                    data-target="claimStatus">
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
                                name="name"
                                id="customerName">
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
                                class="text-[#0F628B] text-sm">Cause Of Loss<span
                                    class="text-red-600"><strong>*</strong></span></label>
                        </div>
                        <div>
                            <select type="text"
                                class="cause-select-field h-8 p-2 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName">
                                <option value=""
                                    disabled
                                    selected>Select From Bellow</option>
                                <option value="">Cause Of Loss I</option>
                                <option value="">Cause Of Loss II</option>
                                <option value="">Cause Of Loss III</option>
                            </select>
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
                                name="name"
                                id="customerName"
                                pattern="^\d+(\.\d+)?$">
                        </div>

                    </div>
                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px] mb-6">
                    <div class="w-2/6">
                        <div class="overflow-x-auto">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="buildingsSTRW">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Buildings & other structural works</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="buildingsSTRW">
                            <input type="number"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                inputmode="decimal"
                                disabled>
                        </div>

                    </div>
                    <div class="w-2/6">
                        <div>
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="plant&machines">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Plant & Machines</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="plant&machines">
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                disabled>
                        </div>
                        <div class="flex-row mt-1 second-input-suminsured"
                            data-target="plant&machines"
                            hidden>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">MBD</label>
                            <input type="text"
                                class="h-8 p-1 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1  border-solid bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00">
                        </div>

                    </div>

                    <div class="w-2/6">
                        <div>
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="electricalFittings">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Electrical Fittings</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="electricalFittings">
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                disabled>
                        </div>
                        <div class="second-input-suminsured flex-row mt-1"
                            data-target="electricalFittings"
                            hidden>
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">EEI</label>
                            <input type="text"
                                class="h-8 p-1 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00">
                        </div>

                    </div>



                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px] mb-6">
                    <div class="w-2/6">
                        <div class="flex-row align-items-center">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="computer&Movables">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Computer & All Movables</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="computer&Movables">
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1 border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                disabled>
                        </div>
                    </div>
                    <div class="w-2/6">
                        <div class="overflow-x-auto">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="furnitureFittings">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Furniture Fixtures & Fittings</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="furnitureFittings">
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                disabled>
                        </div>

                    </div>
                    <div class="w-2/6">
                        <div>
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="stockInProcess">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Stock In Process</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="stockInProcess">
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                disabled>
                        </div>

                    </div>



                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px] mb-6">

                    <div class="w-2/6">
                        <div>
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="finishedGoods">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Finished Goods</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="finishedGoods">
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                disabled>
                        </div>

                    </div>

                    <div class="w-2/6">
                        <div class="flex-row align-items-center">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="fassadeGlasses">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Fassade Glasses</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="fassadeGlasses">
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                disabled>
                        </div>
                        <div class="flex-row mt-1 second-input-suminsured"
                            hidden
                            data-target="fassadeGlasses">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">PGI</label>
                            <input type="text"
                                class="h-8 p-1 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00">
                        </div>
                    </div>
                    <div class="w-2/6">
                        <div class="overflow-x-auto">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="lossOfRent">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Loss Of Rent</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="lossOfRent">
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                disabled>
                        </div>

                        <div class="flex-row mt-1 second-input-suminsured"
                            hidden
                            data-target="lossOfRent">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">No of months</label>
                            <input type="number"
                                class="h-8 p-1 w-25 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                min="0"
                                max="12"
                                oninput="validity.valid||(value='');"
                                inputmode="numeric">
                        </div>

                    </div>




                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px] mb-6">

                    <div class="w-2/6">
                        <div class="overflow-x-auto">
                            <input type="checkbox"
                                class="sumInsuredCheckBoxes form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent"
                                data-target="businessInteruption">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Business Interuption</label>
                        </div>
                        <div class="first-input-suminsured"
                            data-target="businessInteruption">
                            <input type="number"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                disabled
                                inputmode="numeric">
                        </div>

                        <div class="flex-row mt-1 second-input-suminsured"
                            hidden
                            data-target="businessInteruption">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">No of months</label>
                            <input type="number"
                                class="h-8 p-1 w-25 border-[#CCCCCC] border-1 focus:ring-0 focus:border-[#FFC451] focus:border-1 border-solid bg-white overflow-hidden text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                min="0"
                                max="12"
                                oninput="validity.valid||(value='');"
                                inputmode="numeric">
                        </div>

                    </div>

                    <div class="w-2/6">
                        <div class="flex inline mt-2 gap-2">
                            <label for="customerAddress"
                                class="text-[#0F628B] text-sm">Basement Risk<span class="text-red-600"></label>
                            <label for="toggle"
                                class="button">
                                <input type="checkbox"
                                    id="toggle"
                                    class="basement-no"
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
                            <input type="text"
                                class="h-8 p-1 w-11/12 border-[#CCCCCC] border-1  border-solid bg-white dark:bg-gray-800 outline-0 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs"
                                name="name"
                                id="customerName"
                                placeholder="0.00"
                                readonly>
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
                        <input type="checkbox"
                            class="form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent">
                        <label class="text-[#0F628B] text-sm">Terrorism</label>
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


    <!-- Policy Type -->
    <script>
        $(document).ready(function() {
            $('#select-policy-type').on('change', function() {
                var selectedOption = $(this).val();
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
            });
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
@endsection



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
