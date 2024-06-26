<div class='flex justify-between items-center'>

    <x-datatable.view-button url="#"
                             label="View" />

    <x-datatable.edit-button url="#"
                             label="Edit" />


    <button id="desktop_delete"
            class="delete_button m-1 
    rounded-full px-3 py-1
border-[#E25E14]
border 
border-solid
bg-mgibq-orange-gradient
text-white
text-sm
w-[87px] h-[27px] flex justify-center items-center"
            data-uuid="{{ $id }}">
        Delete
    </button>

    <!-- Approve modal -->
    {{-- <div class="modal opacity-0 pointer-events-none fixed w-full z-50 h-full top-0 left-0 flex items-center justify-center"
         id="modal_{{ $id }}">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div
             class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto modal_650px border_bg ">

            <!-- Modal content -->
            <div class="modal-content py-4 text-left px-6">

                <div class="flex justify-end">
                    <img class="modal-close"
                         src="{{ config('app.url') }}/images/icons/cross.svg">
                </div>
                <div class="mt-[150px] max-md:mt-[50px]"></div>
                <div class="flex justify-center items-center pb-3">
                    <p class="text-2xl font-bold text-[#0F628B] text-center max-md:text-xl">Are you sure you want to
                        delete <br> the
                        agency?</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black"
                             xmlns="http://www.w3.org/2000/svg"
                             width="18"
                             height="18"
                             viewBox="0 0 18 18">
                            <path d="M1.5 1.5l15 15M16.5 1.5l-15 15"></path>
                        </svg>
                    </div>
                </div>

                <div class="mb-4 ">
                    <p class="text-lg break-all font-medium text-[#777777] text-center max-md:text-sm">By submitting in
                        you agree to Terms &
                        Service
                        and <br> are hereby bound to them.</p>
                </div>
                <div class="mt-[100px] max-md:mt-[50px]"></div>
                <div class="flex justify-center pt-2">
                    <button class="delete_confirm_btn
                         m-1 
                        rounded-full px-4 py-1
                    border-[#E25E14]
                    border 
                    border-solid
                    bg-mgibq-orange-gradient
                    text-white
                    text-lg
                    font-bold
                    w-[192px] h-[34px] flex justify-center items-center max-md:text-sm	max-md:w-[100px]"
                            id="delete_id_{{ $id }}"
                            class="">Delete</button>
                </div>
            </div>
        </div>
    </div> --}}
</div>


<script>
    $('.delete_button').click(function(e) {
        e.preventDefault();
        var uuid = $(this).data('uuid');
        $('#delete_id_' + uuid).attr('data-uuid', uuid);
        $('#modal_' + uuid).addClass('opacity-100 pointer-events-auto');

        console.log(uuid);
    });

    $('.delete_confirm_btn').click(function(e) {
        e.preventDefault();
        var uuid = $(this).data('uuid');
        $.ajax({
            type: 'POST',
            url: "",
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    location.reload();
                }
            }
        });
    });

    $('.modal-close, .modal-overlay').click(function() {
        $('.modal').removeClass('opacity-100 pointer-events-auto');
    });
</script>


<style>
    @media (max-width: 767px) {
        .delete_confirm_btn {
            width: 160px;
        }

        .modal_650px {
            width: 100%;
            max-width: 350px !important;
            margin: 0 auto;

        }
    }

    @media only screen and (max-width: 365px) {
        #mobile_delete {
            display: block;
        }

    }

    .delete_btn:hover {
        background: linear-gradient(#fff, #fff);
        color: #000;
    }

    .approve_btn:hover {
        background: linear-gradient(#fff, #fff);
        color: #E25E14 !important;
    }

    .modal_650px {
        width: 100%;
        max-width: 650px;
        margin: 0 auto;

    }

    .border_bg {
        border: 0.2px solid transparent;
        box-shadow: 0px 2px 4px rgb(0 0 0 / 25%);
        border-radius: 15px;
    }

    #modal_20 {
        z-index: 99;
    }
</style>
