@extends('layouts.master')

@section('content')
    @include('common.partials._messages')

    <div class="overflow-x-auto mb-5 w-11/12 border border-slate-400 border-solid shadow  rounded mx-auto"
        style="border-color: #CCCCCC !important;">
        <div class="flex flex-wrap justify-center bg-transparent py-3 px-3">
            <h1>Quote For CAR </h1>

            <form action="{{ route('car.quoteStore') }}"
                method="POST"
                class="w-full">
                @csrf

                <div class="md:flex md:flex-row md:items-start align-top mb-6">
                    <div class="w-1/2">
                        <x-forms.input-field type="text"
                            name="name"
                            label="Customer Name"
                            placeholder="Search Here..."
                            required />
                    </div>

                    <div class="w-1/2">
                        <x-forms.input-field type="textarea"
                            name="address"
                            label="Customer Mailing Address"
                            class="h-8 resize-none"
                            required />
                    </div>

                </div>

                <div class="md:flex md:flex-row md:items-start mt-[-20px]">
                    <div class="w-1/2">
                        <x-forms.input-field type="text"
                            name="risk_location"
                            label="Risk Location Address"
                            required />
                    </div>

                    <div class="w-1/2">
                        <x-forms.dropdown-risk-occupancy name="risk_occupancy_id"
                            label="Risk Occupancy"
                            class="js-select2"
                            id="e2"
                            :options="$occupancies"
                            :selected="old('risk_occupancy_id')"
                            required />
                    </div>

                </div>

                <div class="flex flex-row items-center mt-2">
                    <x-forms.checkbox id="selectAll"
                        name="select-all" />

                    <x-forms.label text="Select All"
                        class="mt-2 ml-2" />

                </div>

                <div class="grid grid-cols-2 checkbox-group">

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="car" />

                            <x-forms.label text="CAR"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="earthquake" />

                            <x-forms.label text="Earthquake"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="stfi" />

                            <x-forms.label text="STFI"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Third Party Liability with Cross Liability : AOA Limit up to"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="TPL cover during Maintenance"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Owners Surrounding Property (up to 10% of SI), with FLEXA risks"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Escalation"
                                class="mt-2 ml-2" />
                        </div>
                        <div class="w-1/2 flex items-center">

                            <x-forms.dropdown-common name="escalation"
                                :options="[
                                    'option1' => 'Up to 5% of SI',
                                    'option2' => 'Up to 10% of SI',
                                    'option3' => 'Up to 15% of SI',
                                    'option4' => 'Up to 20% of SI',
                                    'option5' => 'Up to 25% of SI',
                                    'option6' => 'Up to 30% of SI',
                                ]" />
                        </div>
                    </div>

                    <div class="flex items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Extended Maintenance Period - 12 Months"
                                class="mt-2 ml-2" />
                        </div>

                        <div class="w-1/2 flex items-center">
                            <x-forms.input-field type="text"
                                name=""
                                inputmode="numeric" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="DEBRIS REMOVAL PER OCCURRANCE INCLUDING EXTERNAL DEBRIS"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Cover for offsite storage / fabrication"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Waiver of Subrogation"
                                class="mt-2 ml-2" />
                        </div>
                    </div>


                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Design Defect (DE 3 as per Munich Re wordings)"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Breakage of Glass"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Put to Use for 30 days"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="CPM Equipments"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="50/50 clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Loss Payee Clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Non Vitiation Clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="72 hours clause for AOG Perils & RSMD"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Free Automatic Reinstament Clause Upto 10% of SI"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Additional Customs Duty"
                                class="mt-2 ml-2" />
                        </div>
                    </div>





                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label
                                text="EXPEDITING COSTS - COVER OF EXTRA CHARGES FOR OVERTIME, NIGHTWORK, WORK ON PUBLIC HOILDAYS, EXPRESS FREIGHT INCLUDING AIR FREIGHT."
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Loss minimisation expenses"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Professional fees"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Waiver of Contribution clause between principle & Contractor"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Waiver of sectional warranty regarding internal road/approach road"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Amendment in Fire fighting endt wording"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Underground Cables & Pipes Warranty"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label
                                text="Special Conditions concerning safety measures wrt precipitation, flood and inundation"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="1 MONTH RISK OF ELECTRICAL CONTRACT FOR TESTING"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Temporary Structures"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Valuable Documents"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Pro-rata extension clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="On account payment clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="SRCC Clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Local Authority Clause / Public Authority Clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Premium Instalment Clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Amendment in firefighting endorsement"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Additional Insured Clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Free Issue material Clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>


                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Claim Preparation Clause"
                                class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="flex flex-row items-center mt-2">
                        <div class="w-1/2 flex items-center">
                            <x-forms.checkbox id=""
                                name="custom" />

                            <x-forms.label text="Cessassion of work for 60 Days"
                                class="mt-2 ml-2" />
                        </div>
                    </div>


                </div>


                <div class="grid justify-center">
                    <x-common.flexible-button type="submit"
                        text="Save"
                        class="text-dark" />
                    {{-- <x-flexible-button href="#your-link"
                    text="Anchor Button"
                    target="_blank"
                    class="your-custom-classes" /> --}}
                </div>




            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".js-select2").select2({
                closeOnSelect: true,
                theme: "classic",

            });
        });
    </script>

    {{-- Select All Check box --}}
    <script>
        $("#selectAll").click(function() {
            const isChecked = $(this).prop("checked");
            $(".checkbox-group input[type=checkbox]").prop("checked", isChecked);
        });

        $(".checkbox-group").on("change", "input[type=checkbox]", function() {
            const allCheckboxes = $(".checkbox-group input[type=checkbox]");
            const checkedCheckboxes = allCheckboxes.filter(":checked");
            $("#selectAll").prop("checked", allCheckboxes.length === checkedCheckboxes.length);
        });
    </script>
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
@endsection
