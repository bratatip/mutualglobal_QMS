<div class="overflow-x-auto w-11/12 content-center bg-zinc-100 border border-solid rounded-2xl shadow-2xl mx-auto">

    <!-- <table class="ml-6 mb-6 p-8 max-md:p-2 bg-zinc-100 border border-solid rounded-2xl shadow-2xl "> -->
    <table class="mb-6 p-6 max-md:p-2 bg-zinc-100 border border-solid  rounded-2xl w-full">
        <thead class="bg-red">
            <tr>
                <!-- <th class="px-2 py-3 text-center font-semibold">sl no</th> -->
                <th class="px-2 py-3 text-center font-semibold">Id</th>
                <th class="px-2 py-3 text-center font-semibold">Date</th>
                <th class="px-2 py-3 text-center font-semibold">Client Name</th>
                <th class="px-2 py-3 text-center font-semibold">Insurer</th>
                <th class="px-2 py-3 text-center font-semibold">Policy</th>
                <th class="px-2 py-3 text-center font-semibold">Policy Number</th>
                <th class="px-2 py-3 text-center font-semibold">Status</th>
                <!-- Add other columns if needed -->
            </tr>
        </thead>
        <tbody class="bg-zinc-100 divide-y divide-gray-300">
            @foreach ($quotes as $quote)
            <tr class="border-t border-gray-200" data-quote-id="{{ $quote->id }}">
                <!-- <td class="text-gray-500 text-sm text-center px-2 py-3">{{ ($quotes->currentPage() - 1) * $quotes->perPage() + $loop->iteration }}</td> -->
                <td class="text-gray-500 text-sm text-center px-2 py-3 text-green-500" title="Green Is PL & Red Is Ed !">{{$quote->quote_no}}</td>
                <td class="text-gray-500 text-sm text-center px-2 py-3">
                    <?php
                    $currentYear = date('Y');
                    $randomTimestamp = mt_rand(strtotime("{$currentYear}-01-01"), strtotime("{$currentYear}-12-31"));
                    $randomDate = date('Y-m-d', $randomTimestamp);
                    echo $randomDate;
                    ?>
                </td>
                <td class="text-gray-500 text-sm text-center px-2 py-3">{{$quote->customer->name}}</td>
                <td class="text-gray-500 text-sm text-center px-2 py-3">
                    @if ($quote->insurer_name)
                    {{$quote->insurer_name}}
                    @else
                    <span class="text-red-500">Quote Not Converted Yet ! </span>
                    @endif
                </td>
                <td class="text-gray-500 text-sm text-center px-2 py-3"></td>
                <td class="text-gray-500 text-sm text-center px-2 py-3">
                    @if ($quote->policy_number)
                    {{ $quote->policy_number }}
                    @else
                    <span class="text-red-500">Policy Not Generated </span>
                    @endif
                </td>
                <td class="flex flex-wrap sm:justify-end p-2">
                    <div class="flex justify-center mt-2 align-items-center">
                        <!-- <a href="{{ route('quote.view', $quote->id) }}" class="inline-block px-6 py-1  md:mb-2 border border-solid rounded-2xl  text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">View</a> -->
                        <a href="#" class="inline-block px-6 py-1  md:mt-2 border border-solid rounded-2xl  text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">Initiated</a>
                    </div>
                </td>
                <!-- Display other columns here -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $quotes->links() }}
</div>