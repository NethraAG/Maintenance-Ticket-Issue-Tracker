<?php
// Database connection settings
$servername = "localhost";  // Replace with your database server if it's not localhost
$username = "root";         // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "main";           // Database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Function to generate random ticket ID
function generateTicketid() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $ticketId = '';
    for ($i = 0; $i < 6; $i++) {
        $ticketId .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $ticketId;
}

// Success message
$msg = "";

// Check if the form is submitted
if (isset($_POST['submitForm'])) {
    // Fetch form data
    $Assetid = $_POST["Assetid"];
    $Problemdescription = $_POST["Problemdescription"];
    $Department = $_POST["Department"];
    $Priority = $_POST["Priority"];
    $Phonenumber = $_POST["Phonenumber"];

    // Generate ticket ID
    $ticketid = generateTicketid();

    // Insert ticket into database
    $query1 = "INSERT INTO `Openticket` ( `Assetid`, `Problemdescription`, `Department`, `Priority`, `PhoneNumber`,`Ticketid`) 
                VALUES ('$Assetid', '$Problemdescription', '$Department', '$Priority', '$Phonenumber','$ticketid')";



if (!mysqli_query($con, $query1)) {
    $msg = "<script>alert('Error: " . mysqli_error($con) . "');</script>";
} else {
    $msg = "<script>alert('Ticket submitted successfully! Your Ticket ID is: $ticketid');</script>";
}
//mysqli_close($con);

    // Execute the query and check for errors
    mysqli_close($con); // Close the database connection


}
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
            box-sizing: border-box;
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
                <h2 class="text-center">Create New Ticket</h2>
                <?php if ($msg): ?>
            <script>
                alert <?php echo $msg; ?>
            </script>
        <?php endif; ?>


                <!-- Display success or error message -->
                <?php if ($msg): ?>
                    <div class="alert alert-info"><?= $msg ?></div>
                <?php endif; ?>

                <form action="open-ticket1.php" method="post">
                    <div class="mb-3">
                        <label for="Assetid" class="form-label">Asset Id </label>
                        <input type="text" class="form-control" id="Assetid" name="Assetid" required>
                    </div>
                    <div class="mb-3">
                        <label for="Problemdescription" class="form-label">Problem Description</label>
                        <input type="text" class="form-control" id="Problemdescription" name="Problemdescription" required>
                    </div>
                    <div class="form-group">
                        <label for="Department">Department</label>
                        <select class="form-control" id="Department" name="Department" required>
                            <option value="Mng">Management (Mng)</option>
                            <option value="IS">Information Science (IS)</option>
                            <option value="CS">Computer Science (CS)</option>
                            <option value="EE">Electrical Engineering (EE)</option>
                            <option value="EC">Electronics Engineering (EC)</option>
                            <option value="MC">Mechanical Engineering (MC)</option>
                            <option value="CV">Civil Engineering (CV)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Priority">Priority</label>
                        <select class="form-control" id="Priority" name="Priority" required>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                            <option value="emergency">Emergency</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Phonenumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="Phonenumber" name="Phonenumber" required>
                    </div>

                    <button type="submit" name="submitForm" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php';">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
