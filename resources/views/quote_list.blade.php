@extends('layouts.master')

@section('content')

<div class="flex justify-end ml-5 flex-row w-full">
    <div class="w-1/2 mr-0 justify-end mt-3">
        <input type="search" id="searchInput" class="h-8 w-1/3 ml-[300px] bg-white border-b-1 border-t-0 border-x-0 border-indigo-500  overflow-hidden focus:outline-0 focus:ring-0 sm:rounded-sm text-gray-500 text-xs italic" placeholder="Search Customer">
    </div>

</div>

<div class="p-3 justify-center">
    <div id="quote-table-container">
        @include('quote.common.quote_table')
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
                url: '{{ route('quoteList') }}',
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
                    $('#quote-table-container').html(response);
                }
            });
        }

        $('#searchInput').on('input', function() {
            clearTimeout(delayTimer);
            delayTimer = setTimeout(performSearch, 1000);
        });



    });

    $(document).on('click', 'tbody tr', function() {
        const quoteId = $(this).data('quoteId');
        if (quoteId) {
            window.location.href = "/quote_view/" + quoteId;
        }
    });


    // document.addEventListener("DOMContentLoaded", function() {
    //     const rows = document.querySelectorAll("tbody tr");

    //     rows.forEach(row => {
    //         row.addEventListener("click", function() {
    //             const quoteId = row.dataset.quoteId;
    //             if (quoteId) {
    //                 window.location.href = "/quote_view/" + quoteId;
    //             }
    //         });
    //     });
    // });
</script>

@endsection