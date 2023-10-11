<!DOCTYPE html>
<html>

    <head>
        <title>Customer Add</title>
        <link rel="icon"
            type="image/x-icon"
            href="/images/favicon.png">

        <link rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css"
            rel="stylesheet" />
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            .navbar {
                background-color: #333;
            }

            .navbar-dark .navbar-nav .nav-link {
                color: white;
            }

            .navbar-brand img {
                max-height: 50px;
                margin-left: 30px;
            }

            .card {
                margin-top: 30px;
                margin-bottom: 100px;
                width: 90%;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .section {
                margin-bottom: 20px;
            }

            .section h2 {
                font-size: 15px;
                margin-bottom: 5px;
            }

            select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 14px;
            }

            label {
                display: block;
                margin-bottom: 5px;
            }

            input[type="text"],
            textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 14px;
            }

            button {
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                cursor: pointer;
            }

            .btn {
                max-width: fit-content;
                /* margin: 0 auto; */
                align-self: flex-end;
            }

            .required-field {
                color: red;
                margin-left: 2px;
            }

            .dynamic-fields {
                display: none;
            }

            .basement-risk {
                display: flex;
                align-items: center;

            }

            .toggle-button {
                display: flex;
                align-items: center;
                margin-left: 10px;
            }

            .toggle-button button {
                margin-right: 10px;
            }

            .btn-modal {
                align-self: center;
            }


            .toggle-container {
                display: flex;
                align-items: center;
            }

            .toggle-button {
                border: 1px solid #ccc;
                background-color: #fff;
                padding: 5px 10px;
                cursor: pointer;
            }

            .selected {
                background-color: red;
                color: #fff;
            }

            .nselected {
                background-color: green;
                color: #fff;
            }

            .hidden {
                display: none;
            }

            .additional-field {
                display: flex;
                align-items: center;
            }

            /* display all three in same line */

            .checkbox-label {
                display: inline-flex;
                align-items: center;
                margin-right: 10px;
            }

            .inline-input {
                display: inline-block;
                width: auto;
            }

            /* additional field inline MBD */
            .form-group.col-md-4 .additional-sub-field {
                margin-top: 5px;
                display: inline-flex;
                align-items: center;
                /* vertical-align: middle; */
                margin-left: 10px;
            }

            /* +/_ section */

            /* .section-toggle {
            cursor: pointer;
        }

        .section-content {
            display: none;
        }

        .section-content.show {
            display: block;
        } */

            .line {
                width: 100%;
                height: 1px;
                background-color: #ccc;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            /* warranty & safty  */
            .collapsable {
                margin-bottom: 10px;
                border: 1px solid #ccc;
                padding: 10px;

                /* display: inline-flex; */
                /* width: 48%; */
                /* Adjust the width as needed */
                margin-right: 2%;
                vertical-align: top;
            }

            .section h2 {
                cursor: pointer;
                margin: 0;
                padding: 5px;
                background-color: #f0f0f0;
            }

            .section-content1 {
                display: none;
                padding: 10px;
                /* columns: 2; */
            }

            /* name suggation box */

            .suggestions {
                border: 1px solid #ccc;
                border-top: none;
                border-radius: 1px;
                background-color: white;
                line-height: 10px;
                position: absolute;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                font-size: smaller;
                width: 50%;
                z-index: 1000;
                max-height: 200px;
                overflow-y: auto;
                margin-top: -1px;
            }

            .suggestion {
                padding: 5px;
                cursor: pointer;
            }

            .suggestion:hover {
                background-color: #f0f0f0;
            }

            /* autofield */
            .auto-filled[readonly] {
                color: red;
            }
        </style>
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark">

            <a class="navbar-brand"
                href=" ">
                <img src="/images/logo_mg1.png"
                    alt="Brand Logo">
            </a>
            <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse"
                id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

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
            <div class="text-green-500 text-xs mt-2">
                {{ Session::get('error') }}
            </div>
        @endif


        <div class="card mt-5 mb-5 mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <form action="{{ url('/quote') }}"
                method="POST">
                @csrf
                <div class="section">
                    <h2>
                        <span class="section-toggle">#</span> Customer Details
                    </h2>

                    <div class="section-content">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="customerName"
                                    class="text-secondary">Customer Name <span class="required-field">*</span></label>
                                <input type="text"
                                    class="form-control typeahead underline-input"
                                    name="customerName"
                                    id="customerName"
                                    value="{{ old('customerName') ?: (optional($quoteData)->customer ? $quoteData->customer->name : '') }}">
                                <div id="nameSuggestions"
                                    class="suggestions"></div>
                            </div>
                            <input type="hidden"
                                name="product_id"
                                id="product_id"
                                value="{{ old('name', $productId ?? $quoteData->product->uuid) }}"
                                readonly>
                            <input type="hidden"
                                name="customer_id"
                                id="customer_id"
                                value="{{ old('name', $quoteData->customer->uuid ?? '') }}">
                            <input type="hidden"
                                name="quote_id"
                                id="quote_id"
                                value="{{ old('name', $quoteData->id ?? '') }}">
                            <div class="form-group col-md-6">
                                <label for="customerAddress"
                                    class="text-secondary">Customer Mailing Address <span
                                        class="required-field">*</span></label>
                                <input type="text"
                                    class="form-control underline-input"
                                    id="customerAddress"
                                    name="customerAddress"
                                    value="{{ old('name', $quoteData->customer->address ?? '') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="customerName"
                                    class="text-secondary">Risk location Address <span class="required-field">*</span>
                                </label>
                                <input type="text"
                                    class="form-control underline-input"
                                    id="riskLocation"
                                    name="risk_location"
                                    value="{{ old('name', $quoteData->risk_location ?? '') }}">
                            </div>
                            <!-- <div class="form-group col-md-6">
                        <label for="customerAddress" class="text-secondary">Risk occupancy <span class="required-field">*</span></label>
                        <input type="text" class="form-control underline-input" id="customerAddress">
                        </div> -->
                            <div class="form-group col-md-6">

                                <label for="customerName"
                                    class="text-secondary">Risk occupancy <span class="required-field">*</span> </label>
                                <select id="occupancySelect"
                                    class="form-control"
                                    name="risk_occupancy_id">
                                    <option value=""
                                        selected
                                        disabled>Select an option...</option>

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
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">

                        <label for="customerName"
                            class="text-secondary">RM <span class="required-field">*</span>
                        </label>
                        <select id="rmSelect"
                            class="form-control"
                            name="rm_id">
                            <option value=""
                                selected
                                disabled>Select ...</option>

                            @foreach ($employees as $employee)
                                <option value="{{ $employee->uuid }}">{{ $employee->name }} -
                                    [{{ $employee->phone }}]
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <hr class="line" />



                <div class="section">
                    <h2>
                        <span class="section-toggle">#</span> Policy Details
                    </h2>
                    <div class="form-group col-md-6">
                        <label for="selectField">Policy Type <span class="required-field">*</span> </label>
                        <select id="selectField"
                            name="policy_type">
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


                <div class="section dynamic-fields rollover-fields">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customerName"
                                class="text-secondary">Expiry Insurer <span class="required-field">*</span> </label>
                            <input type="text"
                                class="form-control underline-input"
                                id="expiryInsurer"
                                name="expiryInsurer">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="customerAddress"
                                class="text-secondary">Policy No. <span class="required-field">*</span></label>
                            <input type="text"
                                class="form-control underline-input"
                                name="policyNo">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customerName"
                                class="text-secondary">Policy Start Date <span class="required-field">*</span>
                            </label>
                            <input type="date"
                                class="form-control underline-input"
                                id="policyStartDate"
                                name="policyStartDate">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="customerAddress"
                                class="text-secondary">Policy End Date <span class="required-field">*</span></label>
                            <input type="date"
                                class="form-control underline-input"
                                id="policyEndDate"
                                name="policyEndDate">
                        </div>
                    </div>
                </div>

                <div class="section dynamic-fields renew-fields">
                    <div class="form-group dynamic-fields renew-fields col-md-6">
                        <label for="customerAddress"
                            class="text-secondary">Policy No. <span class="required-field">*</span></label>
                        <input type="text"
                            class="form-control underline-input"
                            id="renewPolicyNo"
                            name="renewPolicyNo">

                        <div id="policySuggestions"
                            class="policyRenewSuggestions"></div>
                    </div>

                </div>

                <hr class="line" />

                <span class="additional-field">
                    <label class="toggle-label">Claim since last 36 months</label>
                    <div class="toggle-container">
                        <div class="toggle-button btn-sm"
                            id="yesButton"
                            data-value=1>Yes</div>
                        <div class="toggle-button btn-sm"
                            id="noButton"
                            data-value=0>No</div>
                    </div>
                    <input type="text"
                        name="claim_status"
                        value="{{ old('claim_status', $quoteData->claim_status) }}"
                        hidden>
                </span>

                <div class="row {{ $quoteData->claim_status == 1 ? '' : 'hidden' }}"
                    id="additionalFields">
                    <div class="form-group col-md-4">
                        <label>Year</label>
                        <select class="form-control"
                            name="year_of_claim">
                            <option value=""
                                selected
                                disabled>Select an Year...</option>
                            <option value="2023"
                                {{ $quoteData->year_of_claim == 2023 ? 'selected' : '' }}>2023
                            </option>
                            <option value="2022"
                                {{ $quoteData->year_of_claim == 2022 ? 'selected' : '' }}>2022
                            </option>
                            <option value="2021"
                                {{ $quoteData->year_of_claim == 2021 ? 'selected' : '' }}>2021
                            </option>
                            <option value="2020"
                                {{ $quoteData->year_of_claim == 2020 ? 'selected' : '' }}>2020
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>
                            Cause of loss
                        </label>
                        <input type="text"
                            id="textField2"
                            class="form-control"
                            name="cause_of_loss"
                            value="{{ old('cause_of_loss', $quoteData->cause_of_loss) }}"
                            {{ $quoteData->claim_status == 1 ? '' : 'disabled' }}>
                    </div>
                    <div class="form-group col-md-4">
                        <label>
                            Claim Amount
                        </label>
                        <input type="year"
                            id="textField3"
                            class="form-control"
                            name="claim_amount"
                            value="{{ old('claim_amount', $quoteData->claim_amount) }}"
                            {{ $quoteData->claim_status == 1 ? '' : 'disabled' }}>
                    </div>
                </div>
                <hr class="line" />



                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="checkbox1"
                            class="checkbox-label">
                            <!-- <input type="checkbox" id="checkbox1" class="checkbox" {{ $quoteData->buildings_and_other_structural_work != 0 ? 'checked' : '' }}> -->
                            <input type="checkbox"
                                id="checkbox1"
                                class="checkbox"
                                {{ old('buildings_and_other_structural_work', $quoteData->buildings_and_other_structural_work) != 0 ? 'checked' : '' }}>

                            Building & other structural works
                        </label>
                        <input type="text"
                            class="form-control inline-input sum-field"
                            value="{{ old('buildings_and_other_structural_work', $quoteData->buildings_and_other_structural_work) }}"
                            id="buildings_and_other_structural_work"
                            name="buildings_and_other_structural_work"
                            {{ $quoteData->buildings_and_other_structural_work != 0 ? '' : 'disabled' }}>

                    </div>

                    <div class="form-group col-md-4">
                        <input type="checkbox"
                            id="checkbox2"
                            class="checkbox"
                            {{ old('plants_and_machines', $quoteData->plants_and_machines) != 0 ? 'checked' : '' }}>
                        Plant & machines
                        <input type="text"
                            class="form-control sum-field"
                            id="plants_and_machines"
                            name="plants_and_machines"
                            value="{{ old('plants_and_machines', $quoteData->plants_and_machines) }}"
                            {{ old('plants_and_machines', $quoteData->plants_and_machines) != 0 ? '' : 'disabled' }}>
                            
                        <div class="additional-sub-field"
                            style="{{ old('plants_and_machines', $quoteData->plants_and_machines) != 0 ? '' : 'display: none;' }}">
                            <label>MBD</label>
                            <input type="text"
                                id="mbd"
                                name="mbd"
                                value="{{ old('mbd', $quoteData->mbd) }}"
                                class="form-control ml-2"
                                {{ old('mbd', $quoteData->mbd) != 0 ? '' : 'disabled' }}>
                        </div>
                    </div>


                    <div class="form-group col-md-4">
                        <input type="checkbox"
                            id="checkbox3"
                            class="checkbox"
                            {{ old('electrical_fittings', $quoteData->electrical_fittings) != 0 ? 'checked' : '' }}>
                        Electrical Fittings
                        <input type="text"
                            class="form-control sum-field"
                            id="electrical_fittings"
                            name="electrical_fittings"
                            value="{{ old('electrical_fittings', $quoteData->electrical_fittings) }}"
                            {{ old('electrical_fittings', $quoteData->electrical_fittings) != 0 ? '' : 'disabled' }}>
                        <div class="additional-sub-field"
                            style="{{ old('electrical_fittings', $quoteData->electrical_fittings) != 0 ? '' : 'display: none;' }}">
                            <label for="additionalInput">EEI</label>
                            <input type="text"
                                class="form-control ml-2"
                                id="eei"
                                name="eei"
                                value="{{ old('eei', $quoteData->eei) }}"
                                {{ old('eei', $quoteData->eei) != 0 ? '' : 'disabled' }}>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="checkbox"
                            id="checkbox4"
                            class="checkbox"
                            {{ old('computer_and_all_movables', $quoteData->computer_and_all_movables) != 0 ? 'checked' : '' }}>
                        Computer & all movables
                        <input type="text"
                            class="form-control sum-field"
                            id="computer_and_all_movables"
                            name="computer_and_all_movables"
                            value="{{ old('computer_and_all_movables', $quoteData->computer_and_all_movables) }}"
                            {{ $quoteData->computer_and_all_movables != 0 ? '' : 'disabled' }}>
                    </div>

                    <div class="form-group col-md-4">
                        <input type="checkbox"
                            id="checkbox5"
                            class="checkbox"
                            {{ old('furniture_and_fittings', $quoteData->furniture_and_fittings) != 0 ? 'checked' : '' }}>
                        furniture fixtures & Fittings
                        <input type="text"
                            class="form-control sum-field"
                            id="furniture_and_fittings"
                            name="furniture_and_fittings"
                            value="{{ old('furniture_and_fittings', $quoteData->furniture_and_fittings) }}"
                            {{ $quoteData->furniture_and_fittings != 0 ? '' : 'disabled' }}>
                    </div>

                    <div class="form-group col-md-4">
                        <input type="checkbox"
                            id="checkbox6"
                            class="checkbox"
                            class="checkbox"
                            {{ old('stock_in_process', $quoteData->stock_in_process) != 0 ? 'checked' : '' }}>
                        stocks in process
                        <input type="text"
                            class="form-control sum-field"
                            id="stock_in_process"
                            name="stock_in_process"
                            value="{{ old('stock_in_process', $quoteData->stock_in_process) }}"
                            {{ $quoteData->stock_in_process != 0 ? '' : 'disabled' }}>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="checkbox"
                            id="checkbox7"
                            class="checkbox"
                            {{ old('finished_good', $quoteData->finished_good) != 0 ? 'checked' : '' }}>
                        finished good
                        <input type="text"
                            class="form-control sum-field"
                            id="finished_good"
                            name="finished_good"
                            value="{{ old('finished_good', $quoteData->finished_good) }}"
                            {{ $quoteData->finished_good != 0 ? '' : 'disabled' }}>
                    </div>

                    <div class="form-group col-md-4">
                        <input type="checkbox"
                            id="checkbox8"
                            class="checkbox"
                            {{ old('fassade_glasses', $quoteData->fassade_glasses) != 0 ? 'checked' : '' }}>
                        Fassade glaces
                        <input type="text"
                            class="form-control sum-field"
                            id="fassade_glasses"
                            name="fassade_glasses"
                            value="{{ old('fassade_glasses', $quoteData->fassade_glasses) }}"
                            {{ old('fassade_glasses', $quoteData->fassade_glasses) != 0 ? '' : 'disabled' }}>
                        <div class="additional-sub-field"
                            style="{{ old('fassade_glasses', $quoteData->fassade_glasses) != 0 ? '' : 'display: none;' }}">
                            <label for="additionalInput">PGI</label>
                            <input type="text"
                                class="form-control ml-2"
                                id="pgi"
                                name="pgi"
                                value="{{ old('pgi', $quoteData->pgi) }}"
                                {{ old('pgi', $quoteData->pgi) != 0 ? '' : 'disabled' }}>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <input type="checkbox"
                            id="checkbox9"
                            class="checkbox"
                            {{ old('loss_of_rent', $quoteData->loss_of_rent) != 0 ? 'checked' : '' }}>
                        Loss of Rent
                        <input type="text"
                            class="form-control"
                            id="loss_of_rent"
                            name="loss_of_rent"
                            value="{{ old('loss_of_rent', $quoteData->loss_of_rent) }}"
                            {{ old('loss_of_rent', $quoteData->loss_of_rent) != 0 ? '' : 'disabled' }}>
                        <div class="additional-sub-field"
                            style="{{ old('loss_of_rent', $quoteData->loss_of_rent) != 0 ? '' : 'display: none;' }}">
                            <label for="additionalInput">No of months</label>
                            <input type="text"
                                class="form-control ml-2"
                                id="no_of_months_loss"
                                name="no_of_months_loss"
                                value="{{ old('no_of_months_loss', $quoteData->no_of_months_loss) }}"
                                {{ old('no_of_months_loss', $quoteData->no_of_months_loss) != 0 ? '' : 'disabled' }}>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 ">
                        <input type="checkbox"
                            id="checkbox10"
                            class="checkbox"
                            {{ old('business_interuption', $quoteData->business_interuption) != 0 ? 'checked' : '' }}>
                        Business interuption
                        <input type="text"
                            class="form-control"
                            id="business_interuption"
                            name="business_interuption"
                            value="{{ old('business_interuption', $quoteData->business_interuption) }}"
                            {{ old('business_interuption', $quoteData->business_interuption) != 0 ? '' : 'disabled' }}>

                        <div class="additional-sub-field"
                            style="{{ old('business_interuption', $quoteData->business_interuption) != 0 ? '' : 'display: none;' }}">
                            <label for="additionalInput">No of months</label>
                            <input type="text"
                                class="form-control ml-2"
                                id="bi_no_of_months"
                                name="bi_no_of_months"
                                value="{{ old('bi_no_of_months', $quoteData->bi_no_of_months) }}"
                                {{ old('bi_no_of_months', $quoteData->bi_no_of_months) != 0 ? '' : 'disabled' }}>
                        </div>
                    </div>

                    <div class="form-group  col-md-4">
                        <span class="basement-risk">
                            Basement risk:

                            <div class="toggle-button"
                                id="toggleButton">
                                <button type="button"
                                    class="btn btn-sm btn-success"
                                    id="btnYes"
                                    onclick="toggleBasementRisk(true)">Yes</button>
                                <button type="button"
                                    class="btn btn-sm"
                                    id="btnNo"
                                    onclick="toggleBasementRisk(false)">No</button>
                            </div>
                        </span>
                        <input type="text"
                            id="basementRisk"
                            name="basement_risk"
                            value=1
                            hidden>
                        <input type="text"
                            id="textField"
                            class="form-control mt-2 text-white"
                            readonly
                            value="Yes"
                            style="background-color: green;">
                    </div>
                </div>

                <div class="modal fade"
                    id="confirmationModal"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="confirmationModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog"
                        role="document">
                        <div class="modal-content">
                            <div class="justify-content-end mr-3 p-2">
                                <button type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="text-center text-danger">
                                Are you excluding Basement Risk
                            </div>
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                            <button type="button"
                                class="btn btn-modal btn-sm btn-secondary mb-3 mt-3"
                                value="false"
                                onclick="toggleBasementRisk(false); $('#confirmationModal').modal('hide');">Confirm</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12 text-left">
                        <strong>Total Sum Insured:</strong> <span id="totalSum">0</span>
                        <input type="hidden"
                            name="total_sum_insured"
                            id="hiddenTotalSum"
                            value="{{ old('total_sum_insured') ?: (optional($quoteData)->total_sum_insured ? $quoteData->total_sum_insured : '') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2 text-left">
                        <div class="row">
                            <input type="checkbox"
                                class="col-md-1"
                                id="moneyCheckbox">
                            <label class="col-md-11">Money :</label>
                        </div>
                    </div>
                </div>
                <div class="row"
                    id="hiddenDiv"
                    style="display: none;">
                    <div class="form-group inline-block col-md-3 text-left">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-left">Safe</label>
                            <div class="col-md-8">
                                <input type="text"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group inline-block col-md-3 text-left">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-left">Transit</label>
                            <div class="col-md-8">
                                <input type="text"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group inline-block col-md-3 text-left">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-left">Counter</label>
                            <div class="col-md-8">
                                <input type="text"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group inline-block col-md-3 text-left">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-left">PSL</label>
                            <div class="col-md-8">
                                <input type="text"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="line" />

                <div
                    style="width: 100%; display: flex; align-items: center; margin-top: 0.75rem; margin-bottom: 1.5rem; padding-left: 1rem;">
                    <div style="font-weight: bold; color: #0F628B; font-size: 1rem;">Coverage:</div>
                    <div style="display: flex; align-items: center; margin-left: 0.5rem;">
                        <input type="checkbox"
                            style="margin-right: 0.5rem; pointer-events: none;"
                            checked>
                        <label for="stfi">STFI</label>
                    </div>
                    <div style="display: flex; align-items: center;  margin-left: 0.5rem;">
                        <input type="checkbox"
                            style="margin-right: 0.5rem; pointer-events: none;"
                            checked>
                        <label for="eq">EQ</label>
                    </div>
                    <div style="display: flex; align-items: center;  margin-left: 0.5rem;">
                        <input type="checkbox"
                            id="terrorism_checkbox"
                            style="margin-right: 0.5rem;">
                        <label for="terrorism">Terrorism</label>
                        <input type="hidden"
                            id="terrorism_hidden"
                            name="terrorism"
                            value="0">
                    </div>

                    <div style="display: flex; align-items: center;  margin-left: 0.5rem;">
                        <input type="checkbox"
                            id="burglary_checkbox"
                            style="margin-right: 0.5rem;">
                        <label for="burglary">Burglary</label>
                        <input type="hidden"
                            id="burglary_hidden"
                            name="burglary"
                            value="0">
                    </div>
                </div>

                <div class="btn"
                    style="display: inline-block;">
                    <button type="submit"
                        class="btn btn-sm btn-secondary">Save</button>
                </div>
            </form>

        </div>
    </body>

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

        });
    </script>

    <!-- RM Selection -->

    <script>
        $(document).ready(function() {
            $('#rmSelect').select2();
        });
    </script>

    <!-- Policy Type Selection -->

    <script>
        $(document).ready(function() {
            $('#selectField').on('change', function() {
                var selectedOption = $(this).val();
                $('.dynamic-fields').hide();

                if (selectedOption === 'Rollover') {
                    $('.rollover-fields').show();
                } else if (selectedOption === 'Renew') {
                    $('.renew-fields').show();
                }
            });
        });
    </script>

    <!-- Claim Since Last 36 Months -->
    <script>
        $(document).ready(function() {
            $('.checkbox').on('change', function() {
                var textField = $(this).closest('.form-group').find('input[type="text"]');
                var additionalField = $(this).closest('.form-group').find('.additional-sub-field');

                textField.prop('disabled', !this.checked);

                if (this.checked) {
                    additionalField.show();
                } else {
                    additionalField.hide();
                }
            });
        });



        const yesButton = document.getElementById('yesButton');
        const noButton = document.getElementById('noButton');
        const additionalFields = document.getElementById('additionalFields');
        const textField1 = document.getElementById('textField1');
        const textField2 = document.getElementById('textField2');
        const textField3 = document.getElementById('textField3');
        const claimStatusInput = document.querySelector(
            'input[name="claim_status"]'); // Assuming only one input with this name


        // Add event listeners to the buttons
        yesButton.addEventListener('click', function() {
            yesButton.classList.add('selected');
            noButton.classList.remove('nselected');
            additionalFields.classList.remove('hidden');
            claimStatusInput.value = 1;

            textField2.disabled = false;
            textField3.disabled = false;

        });

        noButton.addEventListener('click', function() {
            claimStatusInput.value = 0;

            noButton.classList.add('nselected');
            yesButton.classList.remove('selected');
            additionalFields.classList.add('hidden');
            textField1.value = '';
            textField2.value = '';
            textField3.value = '';
            // Perform functionality for "No" selection
        });

        // After the page loads, adjust the toggle button state
        window.addEventListener('DOMContentLoaded', function() {
            const claimStatus = claimStatusInput.value;
            if (claimStatus === '1') {
                yesButton.classList.add('selected');
                noButton.classList.remove('nselected');
                additionalFields.classList.remove('hidden');
            } else {
                yesButton.classList.remove('selected');
                noButton.classList.add('nselected');
                additionalFields.classList.add('hidden');
            }
        });
    </script>

    <!-- Basement Risk Toggle -->
    <script>
        $(document).ready(function() {
            $('#confirmationModal').on('hidden.bs.modal', function() {
                if (isNo) {
                    var textField = document.getElementById("textField");
                    var btnNo = document.getElementById("btnNo");
                    var basementRisk = document.getElementById("basementRisk");

                    basementRisk.value = 0;
                    textField.value = "No";
                    textField.style.backgroundColor = "red";
                    btnNo.classList.add("btn-danger");
                }
            });
        });

        function toggleBasementRisk(isYes) {
            var textField = document.getElementById("textField");
            var btnYes = document.getElementById("btnYes");
            var btnNo = document.getElementById("btnNo");
            var basementRisk = document.getElementById("basementRisk");


            if (isYes) {
                basementRisk.value = 1;
                textField.value = "Yes";
                textField.style.backgroundColor = "green";
                btnYes.classList.add("btn-success");
                btnNo.classList.remove("btn-danger");
            } else {
                // Show the confirmation modal before changing the value
                $('#confirmationModal').modal('show');

                // Set isNo to true for "No" selection
                isNo = true;
            }
        }
    </script>

    <script>
        // terorism
        const checkbox = document.getElementById('terrorism_checkbox');
        const hiddenInput = document.getElementById('terrorism_hidden');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                hiddenInput.value = '1';
            } else {
                hiddenInput.value = '0';
            }
        });

        // money option


        $('#moneyCheckbox').change(function() {
            if ($(this).is(':checked')) {
                $('#hiddenDiv').show();
            } else {
                $('#hiddenDiv').hide();
            }
        });

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

</html>
