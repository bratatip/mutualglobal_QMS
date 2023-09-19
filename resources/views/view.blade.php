@extends('layouts.master')

@section('content')
<div class="flex p-5 pt-0 justify-center max-md:pt-[40px]">
    <div class="flex flex-wrap w-1/2 -mx-4 mb-6 p-6 max-md:p-2 bg-zinc-100 border border-solid shadow-2xl rounded-2xl">

        <div class="w-full items-start  px-4 mt-3 mb-6">
            <div class="text-base font-bold  text-[#0F628B] underline">Customer Data</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class=" font-bold text-[#0F628B] text-xs">Name:</div>
            <div class="text-gray-500 text-xs">{{$customer->name}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class=" font-bold  text-[#0F628B] text-xs">Address:</div>
            <div class="text-gray-500 text-xs">{{$customer->address}}</div>

        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class=" font-bold  text-[#0F628B] text-xs">Email:</div>
            <div class="text-gray-500 text-xs">{{$customer->email}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">Contact No:</div>
            <div class="text-gray-500 text-xs">{{$customer->phone_no}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class=" font-bold  text-[#0F628B] text-xs">PAN:</div>
            <div class="text-gray-500 text-xs">{{$customer->pan}}</div>
        </div>

        <div class="w-1/2 px-4 mb-3 max-md:w-full">
            <div class="font-bold  text-[#0F628B] text-xs">GSTIN:</div>
            <div class="text-gray-500 text-xs">{{$customer->gst}}</div>
        </div>

    </div>
</div>

@endsection