@extends('layouts.master')

@section('content')

    {!! Breadcrumbs::render('customer') !!}

    <div class="flex justify-start ml-5 flex-row w-full">
        <div class="w-1/2 mt-3">
            <a href="{{ route('customer.add') }}"
               class="inline px-6 py-2 mt-3 ml-5 border border-solid rounded-sm bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">
                <span class="ml-1 mr-2"> +</span>Add Customer
            </a>
        </div>

        <div class="w-1/2 mr-0 justify-end mt-3">
            <input type="search"
                   id="searchInput"
                   class="h-8 w-1/3 ml-[300px] bg-white border-b-1 border-t-0 border-x-0 border-indigo-500  overflow-hidden focus:outline-0 focus:ring-0 sm:rounded-sm text-gray-500 text-xs italic"
                   placeholder="Search Customer">
        </div>

    </div>



    <div class=" p-3 justify-center mb-20">
        <div id="customer-table-container">
            @include('customer-table')
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var delayTimer;

            function performSearch() {
                var searchValue = $('#searchInput').val().trim();
                // var sortOption = $('#sort').val();
                // var available = $('#available').is(':checked') ? 5 : 10;



                $.ajax({
                    url: '{{ route('customer.index') }}',
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    data: {
                        keyword: searchValue,
                        // category: selectedCategories,
                        // location: selectedLocations,
                        // sort: sortOption,
                        // available: available,
                        // dates: selectedDates,
                        // totalDays: totalDays
                    },
                    success: function(response) {
                        $('#customer-table-container').html(response);
                    }
                });
            }

            $('#searchInput').on('input', function() {
                clearTimeout(delayTimer);
                delayTimer = setTimeout(performSearch, 1000);
            });



        });

        $(document).on('click', 'tbody tr', function() {
            const customerId = $(this).data('customerId');
            if (customerId) {
                window.location.href = "/view/" + customerId;
            }
        });
    </script>
@endsection
