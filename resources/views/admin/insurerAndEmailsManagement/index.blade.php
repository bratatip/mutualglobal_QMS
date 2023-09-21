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
                                class=" text-[#0F628B] text-sm">Insurer Name <span
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
                                class="text-[#0F628B] text-sm">Primary Emails<span
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

@endsection