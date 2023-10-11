<div id="notification-container">

    @if (Session::has('success'))
        <div class="bg-transparent text-center py-4 lg:px-4">
            <div class="p-2 bg-green-600 items-center text-indigo-100 leading-none lg:rounded-md flex lg:inline-flex"
                role="alert">
                <span class="font-semibold mr-2 text-left flex-auto">{{ Session::get('success') }}</span>
            </div>
        </div>
    @endif


    @if (Session::has('error'))
        <div class="bg-transparent text-center py-4 lg:px-4">
            <div class="p-2 bg-red-600 items-center text-indigo-100 leading-none lg:rounded-md flex lg:inline-flex"
                role="alert">
                <span class="font-semibold mr-2 text-left flex-auto">{{ Session::get('error') }}</span>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="container mx-auto mt-4">
            <div class="bg-red-500 text-white py-2 px-4 rounded-lg">
                <h4 class="font-semibold">Error!</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button"
                    class="close">×</button>
            </div>
        </div>
    @endif
</div>

