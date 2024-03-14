@if ($errors->any())
    <div class="text-red-500 text-xs mt-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('success'))
    <div class="text-green-500 text-xs mt-2">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="bg-transparent text-center py-4 lg:px-4">
        <div class="p-2 bg-red-600 items-center text-indigo-100 leading-none lg:rounded-md flex lg:inline-flex"
             role="alert">
            {{-- <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">Alert</span> --}}
            <span class="font-semibold mr-2 text-left flex-auto">{{ Session::get('error') }}</span>
        </div>
    </div>
@endif

<script src="https://cdn.tailwindcss.com"></script>


<div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="sm:mx-auto sm:w-full sm:max-w-md flex justify-center">
            <img class="w-64 cursor-pointer"
                 src="/images/brand.png"
                 alt="...">
        </div>
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6"
                  action="{{ route('doLogin') }}"
                  method="POST">
                @csrf
                @method('post')

                <div>
                    <label for="email"
                           class="block text-sm font-medium text-gray-700">
                        Email address
                    </label>
                    <div class="mt-1">
                        <input id="email"
                               name="email"
                               type="email"
                               autocomplete="email"
                               required
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Enter your email address">
                    </div>
                </div>

                <div>
                    <label for="password"
                           class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1">
                        <input id="password"
                               name="password"
                               type="password"
                               autocomplete="current-password"
                               required
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Enter your password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me"
                               name="remember_me"
                               type="checkbox"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember_me"
                               class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#"
                           class="font-medium text-blue-600 hover:text-blue-500">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign in
                    </button>
                </div>
            </form>
            <div class="mt-6">
            </div>
        </div>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-sm font-extrabold text-blue-900">
            Mutual Global Insurance Broking Pvt Ltd
        </h2>
    </div>
</div>


<script>
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            location.reload();
        }
    });
</script>
