<!DOCTYPE html>
<html>

<head>
    <title>Customer Add</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: white;
        }

        .navbar-brand img {
            max-height: 50px;
            margin-left: 30px;
        }

        .center-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 112px);
            background: #f2ebeb;
            /* background: radial-gradient(circle, rgba(0, 0, 0, 1) 0%, rgba(195, 195, 195, 1) 48%, rgba(0, 1, 1, 1) 100%); */
        }

        .custom-card {
            border: 1px solid #bec1c4;
            margin-top: 20px;
            margin-bottom: 20px;
            width: 90%;
            max-width: 90%;
            border-radius: 5px;
            background-color: whitesmoke;
            padding: 30px;
            color: black;
        }

        .underline-input {

            border-radius: 2;
            padding: 5px 0;
            width: 100%;
            background-color: transparent;
            color: black;
            padding: 0 10px 0 10px;
        }

        .underline-input:focus {
            box-shadow: none;
            background-color: transparent;
            color: black;
            border-radius: 2;
            outline: none;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .footer p {
            margin-bottom: 10px;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .required-field {
            color: red;
            margin-left: 2px;
        }

        .btn {
            max-width: 25%;
        }

        .custom-textarea {
            /* resize: none; */
            width: 100%;
            max-height: 60px;
            min-height: 60px;
            font-size: 12px;
            overflow: hidden;

        }

        .form-row {
            margin-bottom: -15px;
            /* Adjust this value to control the space between rows */
        }

        .text-secondary {
            margin-bottom: -10px;
        }

        @media (max-width: 576px) {
            .center-screen {
                min-height: calc(100vh - 96px);
            }

            .custom-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">

        <a class="navbar-brand" href=" ">
            <img src="/images/logo_mg1.png" alt="Brand Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    @if ($errors->any())
    <div class="text-red-500 text-xs mt-2">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="center-screen w-100">
        <div class="flex flex-wrap -mx-4 mb-6 p-6 max-md:p-2 bg-zinc-100 border border-solid shadow-2xl rounded-2xl">
            <form action="{{ route('customer.update' , $customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="customerName" class=" text-[#0F628B]">Customer Name <span class="required-field">*</span> </label>
                        <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs" name="name" id="customerName" value="{{ $customer->name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="customerAddress" class="text-[#0F628B]">Customer Mailing Address <span class="required-field">*</span></label>
                        <textarea class="h-8 underline-input custom-textarea bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs" name="address" id="customerAddress" rows="2" cols="50">{{$customer->address}}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pin" class="text-[#0F628B]">Pin <span class="required-field">*</span></label>
                        <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs" name="zip_code" id="pin" value="{{ $customer->zip_code }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email" class="text-[#0F628B]">Email <span class="required-field">*</span></label>
                        <input type="email" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs" name="email" id="email" value="{{ $customer->email }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="contact" class="text-[#0F628B]">Contact No. <span class="required-field">*</span></label>
                        <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs" name="contact_person_phone" id="contact" value="{{ $customer->contact_person_phone }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contactPerson" class="text-[#0F628B]">Contact Person <span class="required-field">*</span></label>
                        <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs" name="contact_person_name" id="contactPerson" value="{{ $customer->contact_person_name }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pan" class="text-[#0F628B]">PAN</label>
                        <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs" name="pan" id="pan" value="{{ $customer->pan }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="gst" class="text-[#0F628B]">GSTIN</label>
                        <input type="text" class="h-8 underline-input bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg text-gray-500 text-xs" name="gst" id="gst" value="{{ $customer->gst }}">
                    </div>
                </div>
                <button type="submit" class="logout_button block px-6  py-2 mt-3 border border-solid rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ">
                    Update Customer
                </button>

            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; Copyright MutualGlobal.com. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>