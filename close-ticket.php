<?php
include('connect.php');  // Include the connection file to access the database
?>

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
            height: 100%; /* Ensures full height of the viewport */
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

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
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
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 40px); /* Adjusted to fit within the viewport, considering padding */
        }

        /* Content box style */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .content-box {
            background-color: #a8e8de;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin-top: 0;
            max-height: 90vh;
            overflow-y: auto;
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
            background-color: #f467cc;
            color: white;
        }

        .btn-primary:hover {
            background: #4e73df;
        }

        @media (max-width: 768px) {
            .content-box {
                padding: 25px;
                width: 100%;
                margin: 0 15px;
            }

            .btn-custom {
                font-size: 1rem;
                padding: 10px 20px;
            }

            .container {
                max-width: 100%;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2 class="text-center">Maintenance</h2>
    <a href="index.php">Home</a>
    <a href="open-ticket.php">Open New Ticket</a>
    <a href="check-status.php">Check Ticket Status</a>
    <a href="close-ticket.php">Closing Ticket</a>
  </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container mt-5">
            <!-- Ticket Form -->
            <div class="content-box">
                <h2 class="text-center">Closing Ticket</h2>

                <?php
                // Initialize message variable
                $msg = "";

                if (isset($_POST['submitForm'])) {
                    // Fetch form data
                    $Ticketid = $_REQUEST["Ticketid"];
                    $Closingdescription = $_REQUEST["Closingdescription"];
                    $Status = $_REQUEST["Status"];

                    // Check if Ticketid exists in 'openticket' table
                    $check_query = "SELECT * FROM `openticket` WHERE `Ticketid` = '$Ticketid'";
                    $result = mysqli_query($con, $check_query);

                    if (mysqli_num_rows($result) > 0) {
                        // If ticket ID exists in openticket table, insert into closeticket table
                        $insert_query = "INSERT INTO `closeticket` (`Ticketid`, `Closingdescription`, `Status`) 
                                         VALUES ('$Ticketid', '$Closingdescription', '$Status')";

                        // Execute insert query and check for errors
                        if (!mysqli_query($con, $insert_query)) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            $msg = "Successfully inserted the ticket closure details.";
                        }
                    } else {
                        $msg = "Ticket ID not found in the system. Please check and try again.";
                    }

                    // Close the connection
                    mysqli_close($con);
                }
                ?>

                <!-- Form Display -->
                <form action="close-ticket.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="Ticketid" class="form-label">Ticket ID</label>
                        <input type="text" class="form-control" id="Ticketid" name="Ticketid" required>
                    </div>
                    <div class="mb-3">
                        <label for="Closingdescription" class="form-label">Closing Description</label>
                        <input type="text" class="form-control" id="Closingdescription" name="Closingdescription" required>
                    </div>
                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control" id="Status" name="Status" required>
                            <option value="Completed">Completed</option>
                            <option value="Pending">Pending</option>
                            <option value="Processing">Processing</option>
                        </select>
                    </div>
                    <button type="submit" name="submitForm" class="btn btn-primary">Submit</button>
                </form>

                <!-- Display Message -->
                <?php
                if ($msg != "") {
                    echo "<div class='alert alert-info mt-3'>$msg</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
