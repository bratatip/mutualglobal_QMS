@extends('layouts.master')
@section('content')
    <div class="p-5">
        <x-common.card>
            @slot('card_content')
                <div class="overflow-x-auto">

                    <table id="employees"
                           class="table table-bordered ">
                        <thead class="bg-mgibq-blue-gradient text-white mgibq-box-shadow">
                            <tr>
                                <th>SL NO:</th>
                                <th>Name:</th>
                                <th>Manager:</th>
                                <th>Email:</th>
                                <th>Phone:</th>
                                <th>Action:</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                <script type="text/javascript">
                    $(function() {
                        var table = $('#employees').DataTable({
                            order: [
                                [2, "desc"]
                            ],
                            dom: 'Blfrtip',
                            processing: true,
                            serverSide: true,
                            responsive: true,

                            lengthChange: false,
                            pageLength: 10,

                            'language': {
                                "emptyTable": "No data available",
                                "loadingRecords": "&nbsp;",
                                "processing": "<div>Processing...</div>"
                            },
                            "destroy": true,
                            "scrollX": false,
                            "ajax": {
                                "type": "GET",
                                "headers": {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                "url": "{{ route('employeeJson') }}",
                                "dataType": "json",
                                "contentType": 'application/jsondt; charset=utf-8',
                            },
                            columns: [{
                                    data: null,
                                    render: function(data, type, row, meta) {
                                        return meta.row + 1; // Adding 1 to start counting from 1 instead of 0
                                    }
                                },
                                {
                                    data: 'name',
                                    name: 'name',

                                },
                                {
                                    data: 'manager.name',
                                    name: 'manager.name', // This is the key for sorting and filtering
                                    render: function(data, type, row) {
                                        return data ? data :
                                        'N/A'; // Display N/A if manager name is not available
                                    }
                                },
                                {
                                    data: 'email',
                                    name: 'email',
                                    render: function(data, type, row) {
                                        return truncateString(data);
                                    }
                                }, {
                                    data: 'phone',
                                    name: 'phone',
                                    render: function(data, type, row) {
                                        return truncateString(data);
                                    }
                                }, {
                                    data: 'action',
                                    name: 'action',
                                    "width": "120px",
                                    "targets": 'no-sort',
                                    "orderable": false,
                                    'printable': false,
                                    // responsivePriority: 0,
                                },
                            ]
                        });


                        // Function to truncate a string to a specific length
                        function truncateString(str, length = 50) {
                            if (str) {
                                if (str.length > length) {
                                    return str.substring(0, length - 3) + '...';
                                }
                                return str;
                            } else {
                                return null;
                            }
                        }

                    });
                </script>
            @endslot
        </x-common.card>
    </div>
@endsection
