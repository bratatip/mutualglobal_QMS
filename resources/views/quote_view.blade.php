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

@if(session('error'))
<div class="text-red-500 text-xs mt-2">
    {{ session('error') }}
</div>
@endif
<div class="flex flex-wrap justify-center">
    <nav class="flex flex-wrap justify-center -mx-4  p-6 max-md:p-2">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="{{ route('notificationForm', ['id' => $quote->id]) }}" class="text-[#0F628B] hover:text-orange-500 text-xs font-bold">
                    Quote To Insurer
                </a>
                <svg class="h-4 w-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('finalize-quote', ['id' => $quote->id]) }}" class="text-[#0F628B] hover:text-orange-500 text-xs font-bold">
                    Quote To Customer
                </a>
                <svg class="h-4 w-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('convert-quote', ['id' => $quote->id]) }}" class="text-[#0F628B] hover:text-orange-500 text-xs font-bold">
                    Quote Convertion
                </a>
                <svg class="h-4 w-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </li>

            <li class="flex items-center">
                <a href="{{ route('closer-quote', ['id' => $quote->id]) }}" class="text-[#0F628B] hover:text-orange-500 text-xs font-bold">
                    Policy to Customer
                </a>
            </li>
        </ol>
    </nav>
</div>
<div class="flex p-5 pt-0 mt-[-50px] justify-center max-md:pt-[40px]">
    <div class="flex flex-wrap w-1/2 -mx-4 mb-6 p-6 max-md:p-2 bg-zinc-100 border border-solid shadow-2xl rounded-2xl">
        <div class="w-full flex justify-end px-4 mb-3 max-md:w-full">
            <a href="{{ route('quote.edit', ['id' => $quote->id]) }}" id="downloadPdfButton" class="logout_button block px-6 py-2 mt-3 border border-solid rounded-2xl text-orange-500 text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                Edit
            </a>
        </div>


        <div class="w-full items-start px-4 mt-3 mb-6">
            <div class="text-base font-bold text-[#0F628B] underline">
                Quote For <span class="italic text-orange-500">{{ $customer->name }}</span>
            </div>
        </div>


        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class=" font-bold text-[#0F628B] text-xs">Customer Name:</div>
            <div class="text-gray-500 text-xs">{{$customer -> name}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class=" font-bold  text-[#0F628B] text-xs">Customer Mailing Address:</div>
            <div class="text-gray-500 text-xs">{{$customer -> address}}</div>

        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class=" font-bold  text-[#0F628B] text-xs">Risk Location Address:</div>
            <div class="text-gray-500 text-xs">{{$quote -> risk_location}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Risk Occupancy:</div>
            <div class="text-gray-500 text-xs">{{$riskOccupancy -> riskOccupancy}}</div>
        </div>

        <div class="w-full px-4 mb-3 max-md:w-full">
            <div class=" font-bold  text-[#0F628B] text-xs">Policy Type:</div>
            <div class="text-gray-500 text-xs">{{$quote -> policy_type}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Claim since last 36 months</div>
            <div class="text-gray-500 text-xs">
                {{$quote->claim_status === 1 ? 'Yes' : 'No'}}
            </div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Year:</div>
            <div class="text-gray-500 text-xs">{{$quote->year_of_claim ?? 'NA'}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Cause Of loss:</div>
            <div class="text-gray-500 text-xs">{{$quote -> cause_of_loss ?? 'NA'}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Claim Amount:</div>
            <div class="text-gray-500 text-xs">{{$quote -> claim_amount ?? 'NA'}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Building & other structural works:</div>
            <div class="text-gray-500 text-xs">{{$quote -> buildings_and_other_structural_work}}</div>

        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs"> Plant & machines:</div>
            <div class="text-gray-500 text-xs">{{$quote -> plants_and_machines}}</div>

            <div class="w-full italic justify-end mb-1 max-md:w-full">
                <span class="font-bold text-orange-500	 text-xs">MBD:</span>
                <span class="text-gray-500 text-xs ">{{$quote -> mbd}}</span>
            </div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Electrical Fittings:</div>
            <div class="text-gray-500 text-xs">{{$quote -> electrical_fittings}}</div>

            <div class="w-full italic justify-end mb-1 max-md:w-full">
                <span class="font-bold text-orange-500 text-xs">EEI:</span>
                <span class="text-gray-500 text-xs ">{{$quote -> eei}}</span>
            </div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Computer & all movables:</div>
            <div class="text-gray-500 text-xs">{{$quote -> computer_and_all_movables}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs"> furniture fixtures & Fittings:</div>
            <div class="text-gray-500 text-xs">{{$quote -> furniture_and_fittings}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">stocks in process:</div>
            <div class="text-gray-500 text-xs">{{$quote -> stock_in_process}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">finished good:</div>
            <div class="text-gray-500 text-xs">{{$quote -> finished_good}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Fassade glaces:</div>
            <div class="text-gray-500 text-xs">{{$quote -> fassade_glasses}}</div>

            <div class="w-full italic justify-end mb-1 max-md:w-full">
                <span class="font-bold text-orange-500 text-xs">PGI:</span>
                <span class="text-gray-500 text-xs ">{{$quote -> pgi}}</span>
            </div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs"> Loss of Rent:</div>
            <div class="text-gray-500 text-xs">{{$quote -> loss_of_rent}}</div>

            <div class="w-full italic justify-end mb-1 max-md:w-full">
                <span class="font-bold text-orange-500 text-xs">No Of Months:</span>
                <span class="text-gray-500 text-xs ">{{$quote -> no_of_months_loss}}</span>
            </div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Business interuption:</div>
            <div class="text-gray-500 text-xs">{{$quote -> business_interuption}}</div>

            <div class="w-full italic justify-end mb-1 max-md:w-full">
                <span class="font-bold text-orange-500 text-xs">No Of Months:</span>
                <span class="text-gray-500 text-xs ">{{$quote -> bi_no_of_months}}</span>
            </div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Basement risk:</div>
            <div class="text-gray-500 text-xs">{{$quote -> basement_risk === 1 ? 'Yes' : 'No' }}</div>
        </div>




        <!-- <div class="flex justify-center  flex-row">
            <a href="{{ route('exportCustomer', ['id' => $quote->id]) }}" class="inline px-6 py-2 mt-3 border text-green-500 border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                <i class="fa fa-file-excel mr-2"></i>Export to Excel
            </a>
            <a href="{{ route('notificationForm', ['id' => $quote->id]) }}" class="inline px-6 py-2 mt-3 border border-solid rounded-2xl  bg-white text-xs text-[#0F628B] hover:no-underline ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                <i class="fas fa-envelope mr-2"></i>Send Mail
            </a>

            <a href="{{ route('finalize-quote', ['id' => $quote->id]) }}" class="inline px-6 py-2 mt-3 border border-solid rounded-2xl  bg-white text-xs text-[#0F628B] hover:no-underline ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                <i class="fa fa-flag-checkered mr-2" aria-hidden="true"></i>Finalize
            </a>

            <a href="{{ route('convert-quote', ['id' => $quote->id]) }}" class="inline px-6 py-2 mt-3 border border-solid rounded-2xl  bg-white text-xs text-[#0F628B] hover:no-underline ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                <i class="fas fa-exchange-alt mr-2"></i>Convert
            </a>

            <a href="{{ route('closer-quote', ['id' => $quote->id]) }}" class="inline px-6 py-2 mt-3 border border-solid rounded-2xl  bg-white text-xs text-[#0F628B] hover:no-underline ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                <i class="fa fa-lock mr-2"></i> Closer
            </a>

        </div> -->



    </div>
</div>



@endsection