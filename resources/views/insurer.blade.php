<!DOCTYPE html>
<html>

<head>
    <title>Customer Add</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
        }

        .tftable {
            font-size: 12px;
            color: #333333;
            width: 100%;
            border-width: 1px;
            border-color: #729ea5;
            border-collapse: collapse;
        }

        .tftable th {
            font-size: 12px;
            background-color: #acc8cc;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #729ea5;
            text-align: left;
        }

        .tftable tr {
            background-color: #d4e3e5;
        }

        .tftable td {
            font-size: 12px;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #729ea5;
        }

        .tftable tr:hover {
            background-color: #ffffff;
        }


        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
        }

        .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
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

    <div class="container justify-content-end mt-3">
        <button id="openModalBtn" class="btn btn-secondary btn-sm">Add Insurer</button>
    </div>
    <div class="container">

        <table class="tftable mt-3" border="1">
            <tr>
                <th>Sl No.</th>
                <th>Insurer</th>
                <th>Branch</th>
            </tr>
            <tr>
                <td>01</td>
                <td>The Hartford Business Insurance</td>
                <td>Hartford, CT</td>
            </tr>
            <tr>
                <td>02</td>
                <td> Hiscox Business Insurance</td>
                <td> Boston, MA</td>
            </tr>
            <tr>
                <td>03</td>
                <td> Travelers Business Insurance</td>
                <td>Atlanta, GA</td>
            </tr>
            <tr>
                <td>04</td>
                <td>AIG Travel Insurance</td>
                <td> Milwaukee, WI</td>
            </tr>
            <tr>
                <td>06</td>
                <td>Prudential Life Insurance</td>
                <td>Springfield, MA</td>
            </tr>
            <tr>
                <td>07</td>
                <td> Northwestern Mutual Life Insurance</td>
                <td>Charlotte, NC</td>
            </tr>
        </table>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="insurerName" class="text-secondary">Insurer Name <span class="required-field">*</span> </label>
                    <input type="text" class="form-control underline-input" id="customerName">
                </div>
                <div class="form-group col-md-6">
                    <label for="insurerBranch" class="text-secondary">Branch <span class="required-field">*</span></label>
                    <input type="text" class="form-control underline-input" id="customerAddress">
                </div>
            </div>

            <div class="form-row justify-content-end">
                <button type="submit" class="btn btn-sm btn-secondary">Confirm</button>
            </div>
        </div>
    </div>
    <!-- <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="justify-content-end mr-3 p-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center text-danger">
                    Are you excluding Basement Risk
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
                <button type="button" class="btn btn-modal btn-sm btn-secondary mb-3 mt-3" value="false" onclick="toggleBasementRisk(false); $('#confirmationModal').modal('hide');">Confirm</button>
            </div>
        </div>
    </div> -->



</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const openModalBtn = document.getElementById("openModalBtn");
        const modal = document.getElementById("myModal");
        const closeModalBtn = modal.querySelector(".close");

        openModalBtn.addEventListener("click", function() {
            modal.style.display = "block";
        });

        closeModalBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        // Close modal if user clicks outside of it
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
</script>

</html>