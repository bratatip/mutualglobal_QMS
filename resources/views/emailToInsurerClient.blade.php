@extends('layouts.master')

@section('content') 

<div class="overflow-x-auto mb-5 w-11/12 border border-[#CCCCCC] border-1 rounded mx-auto">
    <div class="flex flex-wrap justify-center bg-zinc-100 py-3 px-3">
    <form action="{{ isset($emailData) && !empty($emailData) ? route('email-send') : route('email-send-to-customer') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ isset($emailData) && !empty($emailData) ? json_encode($emailData) : '' }}" name="emailData">
            <input type="hidden" value=1 name="productId">
            <input type="hidden" value="{{ $quoteId }}" name="quoteId">
            <div class="flex-block w-full">
                <div class="flex items-center my-3">
                    <label class="mr-2">To</label>
                    <textarea type="text" id="toEmails" name="toEmails" readonly class="h-20 w-[500px] underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs resize-none">{{ isset($alltoEmails) && !empty($alltoEmails) ? $alltoEmails : '' }}</textarea>
                </div>

                <div class="flex items-center">
                    <label class="mr-2">Cc</label>
                    <textarea type="text" id="ccEmails" name="ccEmails" readonly class="h-20 w-[500px] underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs resize-none"> {{ isset($allCcEmails) && !empty($allCcEmails) ? $allCcEmails : '' }}</textarea>
                </div>
            </div>
            <button type="submit" class="inline px-6 py-2 mt-3 border text-dark border-solid focus:outline-0 rounded-2xl bg-[#e5e7eb] text-xs  ml-2  dark:text-gray-200 hover:text-[#0F628B] font-bold hover:no-underline">
                Send
            </button>
        </form>
    </div>
</div>

@endsection