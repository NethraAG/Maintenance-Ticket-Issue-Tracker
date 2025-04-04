<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maintenance Ticket Issue Tracker</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Body and overall layout */
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-direction: column;
            overflow: hidden; /* Prevent scrolling */
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #4e73df;
            color: white;
            padding-top: 50px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            margin: 10px 0;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #ffd700;
            color: #003366;
        }

        /* Main content area */
        .main-content {
            margin-left: 250px;
            padding: 10px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1; /* Ensures that it takes the remaining space */
            min-height: calc(100vh - 50px); /* Accounts for the height of the header */
            padding-top: 30px; /* To ensure content is not hidden behind the fixed sidebar */
            padding-bottom: 30px; /* To ensure the content is not hidden by the footer */
            padding-left:30px;
            padding-right:30px;
        }   

        /* Container for centering content */
        .content-box {
            background-color: #a8e8de;
            padding: 20px; /* Equal padding on all sides */
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px; /* Limit the maximum width */
            box-sizing: border-box;
            margin-top: 0; /* Remove margin-top to position it near the header */
            max-height: 90vh; /* Allow content box to take up maximum 80% of the viewport height */
            overflow-y: scroll; /* Enable vertical scrolling */
            -ms-overflow-style: none; /* Internet Explorer 10+ */
            scrollbar-width: none; /* Firefox */
        }

        /* Hero Section with Background Box */
        .hero-section {
            background-color: #bb1717;
            padding: 50px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            width: 100%; /* Ensures the content box takes full width */
            max-width: 800px; /* Optional: Sets a max-width for the box */
        }

        .hero-section h1 {
            font-size: 2.2rem;
            font-weight: bold;
            color: #003366;
        }

        .hero-section p {
            font-size: 1.1rem;
            color: #555;
            font-weight: 300;
        }

        .content-box {
            background-color: #a8e8de;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .btn-custom {
            font-size: 1rem;
            padding: 10px 25px;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: 500;
            border: 1px solid #000000;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color:#f467cc;
            color: white;
        }

        .btn-primary:hover {
            background: #4e73df;
        }

        .btn-success {
            background-color: #5fb85c;
            color: white;
        }

        .btn-success:hover {
            background-color: #4e73df;
        }

        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding-top: 60px; /* Adjust padding for smaller screens */
            }

            .hero-section h1 {
                font-size: 1.8rem;
            }

            .hero-section p {
                font-size: 1rem;
            }

            .btn-custom {
                font-size: 1rem;
                padding: 10px 20px;
            }

            .content-box {
                padding: 40px;
            }
        }

        /* Extra small screens */
        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 1.6rem;
            }

            .hero-section p {
                font-size: 0.9rem;
            }

            .content-box {
                padding: 30px;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2 class="text-center">Maintenance</h2>
        <a href="index.php">Home</a> <!-- Corrected path for home page inside tracker folder -->
        <a href="open-ticket.php">Open New Ticket</a> <!-- Corrected path for open new ticket page inside tracker folder -->
        <a href="check-status.php">Check Ticket Status</a> <!-- Corrected path for check ticket status page inside tracker folder -->
        <a href="close-ticket.php">Closing Ticket</a> <!-- Corrected path for close ticket page inside tracker folder -->
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">

            <!-- Hero Section with Background Box -->
            <div class="content-box hero-section">
                <div class="row text-center">
                    <div class="col-12">
                        <h1 class="display-4">Track Your Support Tickets Easily</h1>
                        <p class="lead">Open a new ticket or check the status of your existing requests with just a few clicks!</p>
                    </div>
                </div>

                <div class="row mt-4 text-center">
                    <div class="col-12 description">
                        <p>Effortlessly manage your tickets with our system. Stay updated on your requests anytime, anywhere.</p>
                    </div>
                </div>

                <!-- Two Buttons: Open New Ticket and Check Status -->
                <div class="row mt-4 text-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <a href="open-ticket.php" class="btn btn-primary btn-custom">
                            <i class="fas fa-plus-circle"></i> Open a New Ticket
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="check-status.php" class="btn btn-success btn-custom">
                            <i class="fas fa-search"></i> Check Ticket Status
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
