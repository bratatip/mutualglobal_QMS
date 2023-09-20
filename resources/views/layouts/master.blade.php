<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">

    <!-- custome css -->
    <link href="{{ asset('css/quote.css') }}" rel="stylesheet">


    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

    <!--  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.11.0/dist/toastify.min.js"></script>

    <!-- select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- multi select with drop down -->
    <!-- pdf viewer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

    

    @vite('resources/css/app.css')

</head>
<!--  from-[#fbc2eb] to-[#a6c1ee] -->

<!-- <body class="font-[Poppins] bg-gradient-to-t from-[#e4e4e7] to-[#4b5563] min-h-screen flex flex-col"> -->

<body class="font-[Poppins] bg-[#fff]  to- min-h-screen flex flex-col overflow-x-hidden">

    <header class="bg-[#151515] fixed top-0 left-0 w-full z-50">
        <nav class="flex justify-between items-center w-[92%]  mx-auto relative">
            <div>
                <a href="/">
                    <img class="w-46 h-[70px] p-3 cursor-pointer" src="/images/logo_mg1.png" alt="...">
                </a>
            </div>

            <div class="nav-links duration-500 md:static absolute bg-[#151515] md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto  w-full flex items-center px-5">
                <ul class="flex md:flex-row flex-col items-end md:items-center md:gap-[2vw] gap-8">
                    <li class="relative group">
                        <a class="hover:text-[#ffc451] text-white" href="#">Customer</a>
                        <ul class="absolute hidden bg-neutral-700 text-white mt-2 py-2 rounded-md w-[150px] top-[50%] group-hover:block transition-opacity duration-300 ease-in-out">
                            <li><a href="/customers" class="hover:text-[#ffc451]">Customer List</a></li>
                            <li><a href="#" class="hover:text-[#ffc451]">Customer .. </a></li>
                            <!-- Add more sub-menu items here -->
                        </ul>
                    </li>

                    <li class="relative group">
                        <a class="text-white hover:text-[#ffc451]" href="">Quote Generate</a>
                        <ul class="absolute hidden bg-neutral-700 text-white mt-2 py-2 rounded-md w-[100px] top-[50%] group-hover:block transition-opacity duration-300 ease-in-out">
                            <li><a href="{{ route('quoteList') }}" class="hover:text-[#ffc451]">Products</a></li>
                            <!-- Add more sub-menu items here -->
                        </ul>
                        <!-- Sub-menu for "Products" under "Quote Generate" -->
                        <ul class="absolute hidden bg-neutral-700 text-white mt-2 py-2 rounded-md w-[150px] top-[50%] left-[70%] transition-opacity duration-300 ease-in-out" id="productsSubMenu">
                            <li><a href="/quote">FIRE</a></li>
                            <li><a href="#">CAR</a></li>
                            <li><a href="#">EAR</a></li>

                        </ul>

                    </li>
                    <li>
                        <a class="hover:text-[#ffc451]  text-white" href="#">Resource</a>
                    </li>
                    <li>
                        <a class="hover:text-[#ffc451]  text-white" href="#">Developers</a>
                    </li>
                    <li>
                        <a class="hover:text-[#ffc451]  text-white" href="{{ route('importView') }}">Import</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-6">
                <a href="{{ route('logOut') }}" class="bg-[#ffc451] text-white px-5 py-2 rounded-full hover:bg-[#87acec]">Log Out</a>
                <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
            </div>
        </nav>
    </header>

    <main class="flex-grow mt-[100px]">
        <!-- Content of individual pages will be placed here -->
        @yield('content')

    </main>

    <footer class="footer h-5 bottom-0 left-0 z-20 w-full p-4 bg-[#292929] border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600">
        <div class="mx-auto text-sm text-gray-500 sm:text-center text-white">
            © Copyright <a href="https://MutualGlobal.com/" class="hover:underline" target="new">MutualGlobal.com</a>. All Rights Reserved.
        </div>
    </footer>



    <script>
        const navLinks = document.querySelector('.nav-links')

        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu'
            navLinks.classList.toggle('top-[9%]')
        }


        // JavaScript to show/hide the "Products" sub-menu on hover
        const productsSubMenu = document.getElementById("productsSubMenu");
        const productsLink = document.querySelector(".relative.group a[href='{{ route('quoteList') }}']");
        const parentLI = productsLink.parentElement;

        parentLI.addEventListener("mouseenter", () => {
            productsSubMenu.style.display = "block";
        });

        parentLI.addEventListener("mouseleave", () => {
            productsSubMenu.style.display = "none";
        });

        // Handle mouse events for sub-menu to prevent it from disappearing when hovering over it
        productsSubMenu.addEventListener("mouseenter", () => {
            productsSubMenu.style.display = "block";
        });

        productsSubMenu.addEventListener("mouseleave", () => {
            productsSubMenu.style.display = "none";
        });
    </script>
</body>

</html>