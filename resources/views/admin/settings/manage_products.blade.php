@extends('layouts.master')

@section('content')


    @if (Session::has('success'))
        <div class="bg-transparent text-center py-4 lg:px-4">
            <div class="p-2 bg-green-600 items-center text-indigo-100 leading-none lg:rounded-md flex lg:inline-flex"
                role="alert">
                {{-- <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">Alert</span> --}}
                <span class="font-semibold mr-2 text-left flex-auto">{{ Session::get('success') }}</span>
            </div>
        </div>
    @endif
    @if (Session::has('errors'))
        <div class="container mx-auto mt-4">
            <div class="bg-red-500 text-white py-2 px-4 rounded-lg">
                <h4 class="font-semibold">Error!</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button"
                    class="close">×</button>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto flex mx-auto w-11/12 mb-6 ">
        <div class="w-3/4 overflow-auto">
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
        </div>

        <div class="w-1/4 fixed right-10 top-20 border border-slate-400 border-solid shadow rounded mx-auto"
            style="border-color: #CCCCCC !important;">
            <div class="flex flex-wrap w-full justify-center bg-transparent py-3 px-3">
                <form action="{{ route('admin.storeCategory') }}"
                    method="POST"
                    class="w-full">
                    @csrf
                    <div class="flex-col md:items-start align-top mb-6">
                        <div class="w-full">
                            <div>
                                <label class=" text-[#0F628B] text-sm">Category Name <span
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
                            Add Category
                        </button>
                    </div>

                </form>
            </div>
            <hr class="my-3 border-t-1  border-[#9ca3af]">

            <div class="flex flex-wrap w-full justify-center bg-transparent py-3 px-3">
                <form action="{{ route('admin.storeProducts') }}"
                    method="POST"
                    class="w-full">
                    @csrf
                    <div class="flex-col md:items-start align-top mb-6">
                        <div class="w-full mb-1">
                            <div>
                                <label class="text-[#0F628B] text-sm">Category <span
                                        class="text-red-600"><strong>*</strong></span></label>
                            </div>
                            <div>
                                <select id="category_id"
                                    name="category_name"
                                    class="h-8 p-1 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="w-full">
                            <div>
                                <label class=" text-[#0F628B] text-sm">Product Name <span
                                        class="text-red-600"><strong>*</strong></span> </label>
                            </div>
                            <div>
                                <input type="text"
                                    class="h-8 w-11/12 bg-white border-[#CCCCCC] dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs"
                                    id="product_name"
                                    name="name"
                                    placeholder="Enter Employee Name">
                            </div>
                        </div>

                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="block px-6  py-2 mt-3 border border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                            Add Products
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
