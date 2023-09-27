@extends('layouts.master')

@section('content')

@if ($errors->any())
<div class="text-red-500 text-xs mt-2">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="overflow-x-auto mb-5 w-11/12 border border-dark border-solid  rounded mx-auto">
    <div class="flex flex-wrap justify-center bg-zinc-100 py-3 px-3">
        <form action="{{ route('send-attachment-email') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex-block w-full">
                <div class="flex justify-center w-full">
                    <lable class=" w-1/4">Select Insurer</lable>
                    <select id="insuranceCompanySelect" class="js-example-basic-multiple w-full bg-white dark:bg-gray-800 border border-gray-300 shadow-sm rounded-lg py-2 px-4 text-gray-700 text-sm focus:outline-none focus:ring focus:border-blue-300" name="insurer[]" multiple="multiple" readonly>
                        <option value="" disabled>Select an insurance company...</option>
                        @foreach ($insurers as $insurer)
                        <option value="{{ $insurer->id }}" data-product=8 class="text-gray-700 text-sm">{{ $insurer->name }}</option>
                        @endforeach
                    </select>

                </div>

                <input type="hidden" value="{{ $customerInfo }}" name="customerInfo">
                <input type="hidden" value=8 name="productId">


                <div class="flex-block  w-full">
                    <input type="hidden" id="emailData" name="emailData">

                    <div class="flex justify-center my-3">
                        <label class="w-1/4">To</label>
                        <textarea type="text" id="toEmails" name="toEmails" readonly class="h-20 w-[500px]  underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs resize-none"> </textarea> <br><br>
                    </div>

                    <div class="flex justify-center my-3">
                        <label class="w-1/4">To (Customize)</label>
                        <textarea type="text" name="toMails" class="h-10 w-[500px]  underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs resize-none"> </textarea> <br><br>
                    </div>
                    <div class="flex justify-center ">
                        <label class=" w-1/4">Cc</label>
                        <textarea type="text" id="ccEmails" name="ccEmails" readonly class="h-20 w-[500px]  underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs resize-none"> </textarea>
                    </div>
                    <!-- <input type="text" id="toEmailsInput" name="toEmails[]" />
                    <input type="text" id="ccEmailsInput" name="ccEmails[]" /> -->

                    <div class="flex justify-center mt-3">
                        <label class="w-1/4">Subject</label>
                        <input type="text" id="subject" name="subject" class="w-1/4 h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm text-gray-500 text-xs @error('subject') border-red-500 @enderror" />
                    </div>

                </div>



                <div class="flex-block justify-center w-10/12">
                    <label class="mt-3">Message:</label>
                    <textarea id="message" name="message" class="h-20 w-1/4 ml-[100px] underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs resize-none">{{$template}}</textarea>
                </div>
            </div>
            <button type="submit">Send</button>
        </form>
    </div>
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.js"></script>

<!-- 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<script>
    $(document).ready(function() {
        $('#insuranceCompanySelect').select2();

        new SimpleMDE({
            element: document.getElementById("message"),
        });


        $('#insuranceCompanySelect').change(function() {
            var selectedInsurerIds = $(this).val();
            var productId = $(this).find(':selected').data('product');

            if (selectedInsurerIds.length > 0 && productId) {
                $.ajax({
                    url: '/get-emails',
                    type: 'GET',
                    data: {
                        insurerIds: selectedInsurerIds,
                        productId: productId
                    },
                    success: function(response) {
                        $('#toEmails').val(response.toEmails);
                        $('#ccEmails').val(response.ccEmails);
                        $('#emailData').val(JSON.stringify(response.emailData));
                        // $('#toEmails').val(response.toEmails.join(', ')); 
                        // $('#ccEmails').val(response.ccEmails.join(', '));

                        // $('#toEmailsInput').val(response.toEmails.join(','));
                        // $('#ccEmailsInput').val(response.ccEmails.join(','));

                        // $('#toEmailsInput').val(JSON.stringify(response.toEmails));
                        // $('#ccEmailsInput').val(JSON.stringify(response.ccEmails));
                    }
                });
            } else {
                $('#toEmails').val('');
                $('#ccEmails').val('');

                // $('#toEmailsInput').val('');
                // $('#ccEmailsInput').val('');
            }
        });

    });
</script>


@endsection