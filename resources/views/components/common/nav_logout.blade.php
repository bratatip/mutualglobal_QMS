<div>
    <div class="mb-2 text-[#0F628B] text-xs flex justify-end md:w-[100%] max-md:w-full">
        <div class="flex items-center mr-2">

            <p class="font-bold ">
                {{ Auth::user()->name }}
            </p>
        </div>
        <div class="text-center md-w[15%]">

            <button
                    class="logout_button block px-6  py-2 border border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                Logout
            </button>
        </div>

    </div>





    <div class="modal z-50 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center"
         id="modal_logout">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div
             class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto modal_604px border_bg mob_350px">

            <!-- Modal content -->
            <div class="modal-content py-4 text-left px-6">

                <div class="flex justify-end">
                    <img class="modal-close cursor-pointer"
                         src="{{ config('app.url') }}/images/icons/cross.svg">
                </div>
                <div class="mt-[50px] max-md:mt-[10px]"></div>
                <div class="flex justify-center items-center pb-3">
                    <p class="text-2xl font-bold text-[#0F628B] text-center max-md:text-xl">Are you sure you want to
                        logout?
                    </p>
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

                <div class="mb-4">
                    <p class="text-lg font-medium text-[#777777] text-center max-md:text-sm">By submitting in you agree
                        to
                        our <strong><a href="#">Terms of
                                Service</a></strong> and <br>
                        are hereby bound to them.</p>
                </div>
                <div class="mt-[50px] max-md:mt-[10px]"></div>
                <div class="flex justify-center pt-2">

                    <a href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="m-1 
                    rounded-full px-4 py-1
                border-[#E25E14]
                border 
                border-solid
                bg-mgibq-orange-gradient
                text-white
                text-lg
                font-bold
                w-[192px] h-[34px] flex justify-center items-center">
                        Logout
                    </a>
                    <form id="logout-form"
                          action="{{ route($logoutRouteName) }}"
                          method="POST"
                          style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script>
        $('.logout_button').click(function(e) {
            e.preventDefault();
            $('#modal_logout').addClass('opacity-100 pointer-events-auto');
        });


        $('.modal-close, .modal-overlay').click(function() {
            $('.modal').removeClass('opacity-100 pointer-events-auto');
        });
    </script>
    <style>
        .modal_604px {
            width: 100%;
            max-width: 604px;
            margin-top: 3rem !important;
            /* margin: 6rem auto; */

        }

        /* .create_btn {
        position: relative;
        top: 46px;
        z-index: 1;
    } */

        .border_bg {
            border: 0.2px solid transparent;
            box-shadow: 0px 2px 4px rgb(0 0 0 / 25%);
            border-radius: 15px;
        }

        @media (max-width:768px) {
            .mob_350px {
                width: 100%;
                max-width: 350px;
                margin: 0 auto;
            }

        }

        @media (max-width:767px) {
            .mob_relative {
                position: relative;

            }

            .create_btn {
                position: relative;
                top: 47px;
            }

            div.dataTables_wrapper {
                position: relative;
                /* top: 35px; */
            }

            .hamburger_icon,
            .hamburger_icon:after,
            .hamburger_icon:before {
                background: #0F628B;

            }

        }

        @media (max-width:640px) {
            .create_btn {
                position: absolute;
                top: 57px;
                width: 100%;

            }
        }
    </style>
