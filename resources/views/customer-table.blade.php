<div class="overflow-x-auto shadow-2xl w-11/12 border border-solid  rounded mx-auto">
    <table class="p-6 max-md:p-2 bg-zinc-100 border border-solid  rounded w-full">
        <thead class="bg-red">
            <tr>
                <th class="px-2 py-3 text-center font-semibold">ID</th>
                <th class="px-2 py-3 text-center font-semibold">Name</th>
                <th class="px-2 py-3 text-center font-semibold">Contact Person Name</th>
                <th class="px-2 py-3 text-center font-semibold">Address</th>
                <th class="px-2 py-3 text-center font-semibold">Email</th>
                <th class="px-2 py-3 text-center font-semibold">Contact Number</th>
                <th class="px-2 py-3 text-center font-semibold">Action</th>
            </tr>
        </thead>
        <tbody class="bg-zinc-100 divide-y divide-gray-300">
            @if ($customers->isEmpty())
            <tr class="border-t border-gray-200">
                <td class="text-red-500 text-sm text-center px-2 py-3" colspan="7"><strong>No Record(s) Found !</strong></td>
            </tr>

            @else
            @foreach ($customers as $customer)
            <tr class="border-t border-gray-200" data-customer-id="{{ $customer->id }}">
                <td class="text-gray-500 text-sm text-center px-2 py-3">{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                <td class="text-gray-500 text-sm text-center px-2 py-3">{{ $customer->name }}</td>
                <td class="text-gray-500 text-sm text-center px-2 py-3">{{ $customer->contact_person_name }}</td>
                <td class="text-gray-500 text-sm text-center px-2 py-3">{{ $customer->address }}</td>
                <td class="text-gray-500 text-sm text-center px-2 py-3">{{ $customer->email }}</td>
                <td class="text-gray-500 text-sm text-center px-2 py-3">{{ $customer->contact_person_phone }}</td>

                <td class="flex flex-wrap justify-start sm:justify-end gap-2">
                    <div class="flex content-center">
                        <a href="{{ route('customer.edit', $customer->id) }}" class="inline-block px-6 py-1  md:mt-2 border border-solid rounded-2xl  text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">Edit</a>
                        <form action="{{ route('customer.destroy', $customer->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" id="deleteCustomer" class="inline-block px-6 py-1  md:mt-2 border border-solid rounded-2xl  text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
<div class="flex justify-center mt-3 flex-row">
    {{ $customers->links() }}
</div>
