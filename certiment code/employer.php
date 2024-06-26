<?php
// Include necessary files (config.php, header.php, etc.)
include('config.php');
include('header.php');
include('sidebarEmp.php');

// Check if a user is logged in and is an employer
//if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'employer') {
    //header("Location: login.php");
   // exit;
//}

// Fetch user details
$user_email = $_SESSION['user_email'] ?? null;

// Check if user_email is set
if (!$user_email) {
    echo "User not found.";
    exit;
}

// Retrieve user information from the database
$role = 'employee'; // Set the desired role
$employeeQuery = "SELECT * FROM user WHERE user_type = ?";
$stmt = $conn->prepare($employeeQuery);

if ($stmt) {
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $employeeResult = $stmt->get_result();

    // Close the statement
    $stmt->close();
} else {
    echo "Error in preparing the statement: " . $conn->error;
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Page</title>
    <style>
    /* Your existing styles here */

    table {
        width: 75%;
        border-collapse: collapse;
        margin-top: 20px;
        margin-left: 300px;
        position: center;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #456ba0;
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="header">
        <h1>Employer List</h1>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($employee = $employeeResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $employee['user_Fname'] . '</td>';
                    echo '<td>' . $employee['user_phoneNo'] . '</td>';
                    echo '<td>' . $employee['user_email'] . '</td>';
                    echo '<td>' . $employee['user_position'] . '</td>';
                    echo '<td>' . $employee['user_grade'] . '</td>';
                    echo '<td><a href="editEmployeeGrade.php?user_email=' . $employee['user_email'] . '">Edit Grade</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add additional details or sections as needed -->

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>