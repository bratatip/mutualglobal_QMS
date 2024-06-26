<header class="container mx-auto px-4  flex items-center justify-between shadow-2xl z-10">
    <a href="{{ route('admin.dashboard') }}"
       class="font-bold text-white text-xl"><img class=" w-48 h-[80px] p-3 cursor-pointer"
             src="/images/brand.png"
             alt="..."></a>
    <nav>
        <ul class="flex items-center justify-center font-semibold">
            <li class="relative group px-3 py-2">
                <button class="hover:opacity-50 cursor-pointer p-1">Products</button>
                <div
                     class="absolute top-4 -left-[20rem] transition group-hover:translate-y-5 translate-y-0 opacity-0 hidden group-hover:opacity-100 group-hover:block duration-500 ease-in-out group-hover:transform z-50 min-w-[1200px] transform">
                    <div class="relative top-6 p-6 bg-white rounded-xl shadow-xl w-full">
                        <div
                             class="w-10 h-10 bg-white transform rotate-45 absolute top-0 -z-10 translate-x-0 transition-transform group-hover:translate-x-[12rem] duration-500 ease-in-out rounded-sm shadow-xl">
                        </div>

                        <div class="relative z-10">
                            <div class="grid grid-cols-4 gap-6">
                                @foreach ($navbarData as $category)
                                    <div>
                                        <p class="uppercase tracking-wider text-gray-700 font-semibold text-[13px]">
                                            {{ $category->name }}</p>
                                        <ul class="mt-3 text-[15px]">
                                            @foreach ($category->products as $product)
                                                @php
                                                    // Remove leading and trailing spaces, then convert product name to CamelCase if it has more than one word
                                                    $productName =
                                                        str_word_count(trim($product->name)) > 1
                                                            ? str_replace(' ', '', ucwords($product->name))
                                                            : strtolower($product->name);

                                                    $categoryName =
                                                        str_word_count(trim($category->name)) > 1
                                                            ? str_replace(' ', '', ucwords($category->name))
                                                            : strtolower($category->name);
                                                @endphp

                                                @if (Route::has("$categoryName.quoteGenerate"))
                                                    <li>
                                                        <a href="{{ route("$categoryName.quoteGenerate", ['uuid' => $product->uuid]) }}"
                                                           class="block p-1 -mx-2 rounded-lg hover:bg-gradient-to-br hover:from-indigo-50 hover:to-pink-50 hover:via-blue-50 transition ease-in-out duration-300 text-gray-500 font-normal hover:text-indigo-600">
                                                            {{ $product->name }}
                                                        </a>
                                                    </li>
                                                @else
                                                    <!-- Handle the case where the route does not exist -->
                                                    <li
                                                        class="block p-1 -mx-2 rounded-lg hover:bg-gradient-to-br hover:from-indigo-50 hover:to-pink-50 hover:via-blue-50 transition ease-in-out duration-300 text-gray-500 font-normal hover:text-indigo-600">
                                                        {{ $product->name }}</li>
                                                @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="relative group px-3 py-2">
                <button class="hover:opacity-50 cursor-pointer p-1">Quotes</button>
                <div
                     class="absolute top-4 -left-2 transition group-hover:translate-y-5 translate-y-0 opacity-0 hidden group-hover:opacity-100 group-hover:block duration-500 ease-in-out group-hover:transform z-50 min-w-[260px] transform">
                    <div class="relative top-6 p-6 bg-white rounded-xl shadow-xl w-full">
                        <div
                             class="w-10 h-10 bg-white transform rotate-45 absolute top-0 z-0 -translate-x-4 transition-transform group-hover:translate-x-3 duration-500 ease-in-out rounded-sm">
                        </div>
                        <div class="relative z-10">
                            <p class="uppercase tracking-wider text-gray-500 font-medium text-[13px]">....</p>
                            <ul class="mt-3 text-[15px]">
                                <li>
                                    <a href="{{ route('quoteList') }}"
                                       class="bg-transparent bg-clip-text text-transparent bg-gradient-to-br from-indigo-400 to-pink-700 via-blue-500 font-semibold hover:from-blue-600 hover:to-indigo-600 hover:via-pink-400 py-1 block">
                                        View
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="relative group px-3 py-2">
                <button class="hover:opacity-50 cursor-pointer p-1">Employees</button>
                <div
                     class="absolute top-4 -left-48 transition group-hover:translate-y-5 translate-y-0 opacity-0 hidden group-hover:opacity-100 group-hover:block duration-500 ease-in-out group-hover:transform z-50 min-w-[560px] transform">
                    <div class="relative top-6 p-6 bg-white rounded-xl shadow-xl w-full">
                        <div
                             class="w-10 h-10 bg-white transform rotate-45 absolute top-0 z-0 translate-x-0 transition-transform group-hover:translate-x-[12.65rem] duration-500 ease-in-out rounded-sm">
                        </div>

                        <div class="relative z-10">
                            <a href="#"
                               class="block p-2 -mx-2 rounded-lg hover:bg-gradient-to-br hover:from-indigo-50 hover:to-pink-50 transition ease-in-out duration-300 text-gray-800 font-semibold hover:text-indigo-600">
                                Documentation
                                <p class="text-gray-500 font-normal">Start integrating in no time</p>
                            </a>
                            <div class="mt-6 grid grid-cols-2 gap-6">
                                <div>
                                    <p class="uppercase tracking-wider text-gray-500 font-medium text-[13px]">CRUD</p>
                                    <ul class="mt-3 text-[15px]">
                                        <li>
                                            <a href="{{ route('admin.employeeList') }}"
                                               class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                                Employee List
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.createEmployee') }}"
                                               class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                                Add Employee
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <div>
                                    <p class="uppercase tracking-wider text-gray-500 font-medium text-[13px]">Guides
                                    </p>
                                    <ul class="mt-3 text-[15px]">
                                        <li>
                                            <a href="#"
                                               class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                                Accept online payments
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                                Editing video like a pro
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                                Automation techniques
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                               class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                                Create stunning effects
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="relative group px-3 py-2">
                <button class="hover:opacity-50 cursor-pointer p-1">Customers</button>
                <div
                     class="absolute top-4 -left-2 transition group-hover:translate-y-5 translate-y-0 opacity-0 hidden group-hover:opacity-100 group-hover:block duration-500 ease-in-out group-hover:transform z-50 min-w-[200px] transform">
                    <div class="relative top-6 p-6 bg-white rounded-xl shadow-xl w-full">
                        <div
                             class="w-10 h-10 bg-white transform rotate-45 absolute top-0 z-0 -translate-x-4 transition-transform group-hover:translate-x-3 duration-500 ease-in-out rounded-sm">
                        </div>
                        <div class="relative z-10">
                            <ul class="text-[15px]">
                                <li>
                                    <a href="{{ route('customer.index') }}"
                                       class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                        Customer Index
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>

            <li class="relative group px-3 py-2">
                <button class="hover:opacity-50 cursor-pointer p-1">Setting</button>
                <div
                     class="absolute top-4 -left-2 transition group-hover:translate-y-5 translate-y-0 opacity-0 hidden group-hover:opacity-100 group-hover:block duration-500 ease-in-out group-hover:transform z-50 min-w-[200px] transform">
                    <div class="relative top-6 p-6 bg-white rounded-xl shadow-xl w-full">
                        <div
                             class="w-10 h-10 bg-white transform rotate-45 absolute top-0 z-0 -translate-x-4 transition-transform group-hover:translate-x-3 duration-500 ease-in-out rounded-sm">
                        </div>
                        <div class="relative z-10">
                            <ul class="text-[15px]">
                                <li>
                                    <a href="{{ route('importView') }}"
                                       class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                        Terms Adn Conditions
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.add-riskoccupancy') }}"
                                       class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                        Risk Occupancy
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.manageProducts') }}"
                                       class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                        Manage Products
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.manageInsurersAndEmails') }}"
                                       class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                        Manage Insurers
                                    </a>
                                </li>
                            </ul>


                        </div>
                    </div>
                </div>
            </li>
            <li class="relative group px-3 py-2">
                <a href="#"
                   class="hover:opacity-50 cursor-pointer p-1">Pricing
                </a>
            </li>
        </ul>
    </nav>
    <nav>
        <ul>
            <li>
                <a href="{{ route('logOut') }}"
                   class="rounded-full px-3 py-2 font-semibold bg-white bg-opacity-10 flex items-center group hover:text-red-600 text-decoration-none">
                    <span class="mr-2">Log Out</span>
                    <svg class="stroke-current"
                         width="10"
                         height="10"
                         stroke-width="2"
                         viewBox="0 0 10 10"
                         aria-hidden="true">
                        <g fill-rule="evenodd">
                            <path class="opacity-0 group-hover:opacity-100 transition ease-in-out duration-200"
                                  d="M0 5h7"></path>
                            <path class="opacity-100 group-hover:transform group-hover:translate-x-1 transition ease-in-out duration-200"
                                  d="M1 1l4 4-4 4"></path>
                        </g>
                    </svg>
                </a>

                {{-- @component('components.common.nav_logout', [
    'logoutRouteName' => 'logOut',
    'route' => 'logOut',
])
                @endcomponent --}}
            </li>
        </ul>
    </nav>
</header>

<div
     class="fixed top-auto bottom-0 h-full w-full backdrop-blur opacity-0 pointer-events-none transition-opacity duration-300">
</div>

<style>
    /* Additional CSS classes */
    .backdrop-show {
        opacity: 1;
        pointer-events: auto;
    }
</style>
<script>
    $(document).ready(function() {
        $('.group').hover(
            function() {
                $('.backdrop-blur').addClass('backdrop-show');
            },
            function() {
                $('.backdrop-blur').removeClass('backdrop-show');
            }
        );
    });
</script>
