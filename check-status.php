<?php
// Include database connection file
include('db_connection.php'); 

// Query the open-ticket table for the required ticket data
$query_open = "SELECT Ticketid, assetid, Problemdescription, Department, Priority, Phonenumber FROM openticket";
$result_open = mysqli_query($conn, $query_open);

// Check for query success
if (!$result_open) {
    die("Query failed: " . mysqli_error($conn));
}

// Query the close-ticket table for the required ticket data
$query_close = "SELECT Ticketid, Closingdescription, Status FROM closeticket";
$result_close = mysqli_query($conn, $query_close);

// Check for query success
if (!$result_close) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ticket Status</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            flex-direction: column; /* Changed from center alignment to top */
            height: calc(100vh - 40px); /* Adjusted to fit within the viewport, considering padding */
            overflow-y: auto; /* Ensures scroll if content is too long */
        }

        /* Content box style */
        .container {
            display: flex;
            flex-direction: column;
            width: 100%;
            padding-top: 20px; /* Adjusted padding to be at the top */
        }

        /* Table styles */
        .table-container {
            width: 100%;
            max-height: 400px; /* Set max height for scrollable table */
            overflow-y: auto;
            border: 1px solid #ddd;
        }

        .table th {
            position: sticky;
            top: 0;
            background-color:#a8e8de;
            z-index: 1;
        }

        .table {
            width: 100%;
            table-layout: fixed;
        }

        /* For mobile responsiveness */
        @media (max-width: 768px) {
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
        <a href="close-ticket.php">Close Ticket</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2 style-align:center>Ticket Status</h2>
            <div class="table-container">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Asset ID</th>
                            <th>Problem Description</th>
                            <th>Department</th>
                            <th>Priority</th>
                            <th>Phone Number</th>
                            <th>Closing Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display open tickets
                        while ($ticket = mysqli_fetch_assoc($result_open)) {
                            echo "<tr id='ticket-{$ticket['Ticketid']}'>";
                            echo "<td>{$ticket['Ticketid']}</td>";
                            echo "<td>{$ticket['assetid']}</td>";
                            echo "<td>{$ticket['Problemdescription']}</td>";
                            echo "<td>{$ticket['Department']}</td>";
                            echo "<td>{$ticket['Priority']}</td>";
                            echo "<td>{$ticket['Phonenumber']}</td>";
                            echo "<td>-</td>";  // No closing description for open tickets
                            echo "<td>-</td>";  // No status for open tickets
                            echo "</tr>";
                        }

                        // Display closed tickets
                        while ($ticket = mysqli_fetch_assoc($result_close)) {
                            echo "<tr id='ticket-{$ticket['Ticketid']}'>";
                            echo "<td>{$ticket['Ticketid']}</td>";
                            echo "<td>-</td>";  // No asset ID for closed tickets
                            echo "<td>-</td>";  // No problem description for closed tickets
                            echo "<td>-</td>";  // No department for closed tickets
                            echo "<td>-</td>";  // No priority for closed tickets
                            echo "<td>-</td>";  // No phone number for closed tickets
                            echo "<td>{$ticket['Closingdescription']}</td>";
                            echo "<td>{$ticket['Status']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
