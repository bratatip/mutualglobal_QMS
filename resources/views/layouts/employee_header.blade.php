<header class="bg-[#151515] fixed top-0 left-0 w-full z-50">
    <nav class="flex justify-between items-center w-[92%]  mx-auto relative">
        <div>
            <a href="/">
                <img class="w-46 h-[70px] p-3 cursor-pointer"
                    src="/images/logo_mg1.png"
                    alt="...">
            </a>
        </div>

        <!-- component -->
        <div class="group ml-[30%] inline-block">
            <button
                class="outline-none focus:outline-none mx-1 py-1 bg-transparent text-white rounded-sm flex items-center min-w-32">
                <span class="pr-1 font-semibold"><a href="{{ route('quoteList') }}">Quote</a></span>
                <span>
                    <svg class="fill-current h-4 w-4 transform group-hover:-rotate-180
          transition duration-150 ease-in-out"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </span>
            </button>
            <ul
                class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute 
        transition duration-150 ease-in-out origin-top min-w-32">
                @foreach ($navbarData as $category)
                    <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                        <button class="w-full text-left flex items-center outline-none focus:outline-none">
                            <span class="pr-1 flex-1">{{ $category->name }}</span>
                            <span class="mr-auto">
                                <svg class="fill-current h-4 w-4
              transition duration-150 ease-in-out"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </span>
                        </button>
                        <ul
                            class="bg-white border rounded-sm absolute top-0 right-0 
        transition duration-150 ease-in-out origin-top-left
        min-w-32
        ">
                            @foreach ($category->products as $product)
                                @php
                                    // Remove leading and trailing spaces, then convert product name to CamelCase if it has more than one word
                                    $productName = str_word_count(trim($product->name)) > 1 ? str_replace(' ', '', ucwords($product->name)) : strtolower($product->name);
                                @endphp
                                @if (Route::has("$productName.quoteGenerate"))
                                    <li class="px-3 py-1"><a
                                            href="{{ route("$productName.quoteGenerate", ['uuid' => $product->uuid]) }}">{{ $product->name }}</a>
                                    </li>
                                @else
                                    <!-- Handle the case where the route does not exist -->
                                    <li class="px-3 py-1">{{ $product->name }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>


        <div class="group inline-block">
            <button
                class="outline-none focus:outline-none text-white mx-1 py-1 bg-transparent rounded-sm flex items-center min-w-32">
                <span class="pr-1 font-semibold"><a href="{{ route('customer.index') }}">Customer</a></span>
                <span>
                    <svg class="fill-current h-4 w-4 transform group-hover:-rotate-180
          transition duration-150 ease-in-out"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </span>
            </button>
            <ul
                class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute 
        transition duration-150 ease-in-out origin-top min-w-32">
                <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                    <button class="w-full text-left flex items-center outline-none focus:outline-none">
                        <span class="pr-1 flex-1">Test</span>
                        <span class="mr-auto">
                            <svg class="fill-current h-4 w-4
              transition duration-150 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </button>
                </li>
            </ul>
        </div>




        <div class="flex items-center gap-6">
            <a href="{{ route('logOut') }}"
                class="bg-[#ffc451] text-white px-5 py-2 rounded-full hover:bg-[#87acec]">Log Out</a>
            <ion-icon onclick="onToggleMenu(this)"
                name="menu"
                class="text-3xl cursor-pointer md:hidden"></ion-icon>
        </div>
    </nav>

</header>

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


<style>
    /* since nested groupes are not supported we have to use
       regular css for the nested dropdowns
    */
    li>ul {
        transform: translatex(100%) scale(0)
    }

    li:hover>ul {
        transform: translatex(101%) scale(1)
    }

    li>button svg {
        transform: rotate(-90deg)
    }

    li:hover>button svg {
        transform: rotate(-270deg)
    }

    /* Below styles fake what can be achieved with the tailwind config
       you need to add the group-hover variant to scale and define your custom
       min width style.
         See https://codesandbox.io/s/tailwindcss-multilevel-dropdown-y91j7?file=/index.html
         for implementation with config file
    */
    .group:hover .group-hover\:scale-100 {
        transform: scale(1)
    }

    .group:hover .group-hover\:-rotate-180 {
        transform: rotate(180deg)
    }

    .scale-0 {
        transform: scale(0)
    }

    .min-w-32 {
        min-width: 8rem
    }
</style>
