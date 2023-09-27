@extends('layouts.master')

@section('content')
    @include('common.partials._messages')
    <div class="overflow-x-auto flex mx-auto w-11/12 mb-6 ">
        {{-- <div class="w-3/4 overflow-auto">
            <div>
                <label class=" text-[#0F628B] ml-28 text-md">Category & Products <span class="text-red-600"></span>
                </label>
            </div>
            @foreach ($categories as $category)
                <div class="py-3 px-3 w-3/4 border border-slate-400 border-solid rounded mx-auto relative">
                    <div class="flex justify-start items-center ">
                        <span class="mr-2 text-red-600 text-md">{{ $category->name }}</span>
                        <button type="submit"
                            class="block px-6  py-2 focus:outline-0 absolute right-20 top-0 ">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('admin.destroyCategory', $category->id) }}"
                            method="POST"
                            class="mr-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="block px-6 py-2 focus:outline-0 absolute right-10 top-0  ">
                                <i class="fa fa-trash text-red-600"
                                    aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>

                    @if ($category->products)
                        @foreach ($category->products as $product)
                            <div class="flex ml-5 my-1 justify-start items-center relative">
                                <span class="mr-2 text-dark text-sm">{{ $product->name }}</span>
                                <div class="flex">
                                    <button type="submit"
                                        class="block px-6  py-2 focus:outline-0 absolute right-40 top-0 ">
                                        <i class="far fa-edit"></i>

                                    </button>
                                    <form action="{{ route('admin.destroyProducts', $product->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="block px-6 py-2 focus:outline-0 absolute right-28 top-0  ">
                                            <i class="fa fa-minus text-red-600"
                                                aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            @endforeach
        </div> --}}

        <div class="w-1/4 right-10 border border-slate-400 border-solid shadow rounded mx-auto"
            style="border-color: #CCCCCC !important;">
            <div class="flex flex-wrap w-full justify-center bg-transparent py-3 px-3">
                <form action="{{ route('admin.storeInsurers') }}"
                    method="POST"
                    class="w-full">
                    @csrf
                    <div class="flex-col md:items-start align-top mb-6">
                        <div class="w-full">
                            <div>
                                <label class=" text-[#0F628B] text-sm">Insurer Name<span
                                        class="text-red-600"><strong>*</strong></span> </label>
                            </div>
                            <div>
                                <input type="text"
                                    class="h-8 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs"
                                    id="category_name"
                                    name="name"
                                    placeholder="Enter Employee Name">
                            </div>
                        </div>

                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="block px-6  py-2  border border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                            Add Insurer
                        </button>
                    </div>

                </form>
            </div>
            <hr class="my-3 border-t-1  border-[#9ca3af]">

            <div class="flex flex-wrap w-full justify-center bg-transparent py-3 px-3">
                <form action="{{ route('admin.storeEmails') }}"
                    method="POST"
                    class="w-full">
                    @csrf
                    <div class="flex-col md:items-start align-top mb-6">
                        <div class="w-full mb-1">
                            <div>
                                <label class="text-[#0F628B] text-sm">Insurer <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <select id="category_id"
                                    name="insurer_name"
                                    class="h-8 p-1 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs">
                                    <option value="">Select Insurer</option>
                                    @php
                                        $sortedInsurers = $insurers->sortBy('name');
                                    @endphp
                                    @foreach ($sortedInsurers as $insurer)
                                        <option value="{{ $insurer->name }}">{{ $insurer->name }}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="w-full mb-1">
                            <div>
                                <label class="text-[#0F628B] text-sm">Product <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <select id="product_id"
                                    name="product_name"
                                    class="h-8 p-1 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs">
                                    <option value="">Select Product</option>
                                    @php
                                        $sortedProducts = $products->sortBy('name');
                                    @endphp
                                    @foreach ($sortedProducts as $product)
                                        <option value="{{ $product->name }}">{{ $product->name }}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="w-full">
                            <div>
                                <label class=" text-[#0F628B] text-sm">Primary Email <span
                                        class="text-red-600"><strong>*</strong></span> </label>
                            </div>
                            <div>
                                <input type="text"
                                    class="h-8 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs"
                                    id="primary_email"
                                    name="primary_email"
                                    placeholder="Enter Primary Email">
                            </div>
                        </div>

                        <div class="w-full mb-1">
                            <div>
                                <label class="text-[#0F628B] text-sm">Cc Emails <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <select id="Cc_email"
                                    name="Cc_emails[]"
                                    multiple="multiple"
                                    class="h-8 p-1 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-x-wrap shadow text-gray-500 text-xs">
                                    <option value=""
                                        disabled
                                        hidden
                                        selected>Select Emails</option>
                                    @php
                                        $CcEmails = $CcEmails->sortBy('name');
                                    @endphp
                                    @foreach ($CcEmails as $CcEmail)
                                        <option value="{{ $CcEmail }}">{{ $CcEmail }}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <div class="w-full">
                            <div>
                                <label class=" text-[#0F628B] text-sm">Cc Emails <span
                                        class="text-red-600"><strong>*</strong></span> </label>
                            </div>
                            <div>
                                <textarea type="text"
                                    class="h-8 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs"
                                    id="custome_cc_emails"
                                    name="custome_cc_emails"
                                    placeholder="Enter Cc Emails (comma-separated)"> </textarea>
                            </div>
                        </div>

                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="block px-6  py-2 mt-3 border border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                            Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="/assets/multiselect-js/BsMultiSelect.bs4.min.js"></script>

    <script>
        $(function() {
            $("#Cc_email").bsMultiSelect();
        });
    </script>
@endsection
