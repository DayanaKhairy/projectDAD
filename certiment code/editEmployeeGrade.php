<?php
// Include necessary files (config.php, header.php, etc.)
include('config.php');
include('header.php');
include('sidebarEmp.php');

// Check if a user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

// Fetch user details from the URL parameter
$user_email = $_GET['user_email'] ?? null;

// Check if user_email is set
if (!$user_email) {
    echo "User not found.";
    exit;
}

// Retrieve user information from the database based on the provided email
$userQuery = "SELECT * FROM user WHERE user_email = ?";
$stmt = $conn->prepare($userQuery);

if ($stmt) {
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $userResult = $stmt->get_result();

    if ($userResult->num_rows > 0) {
        $user = $userResult->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error in preparing the statement: " . $conn->error;
    exit;
}

// Handle update user_grade form submission
if (isset($_POST['update_details'])) {
    $new_group = $_POST['new_group'];
    $new_grade = $_POST['new_grade'];

    // Update user_group and user_grade in the database
    $updateQuery = "UPDATE user SET user_serviceGroup = ?, user_grade = ? WHERE user_email = ?";
    $updateStmt = $conn->prepare($updateQuery);

    if ($updateStmt) {
        $updateStmt->bind_param("sss", $new_group, $new_grade, $user_email);
        $updateStmt->execute();

        // Close the statement
        $updateStmt->close();
    } else {
        echo "Error in preparing the update statement: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Grade</title>
    <style>
    .update-grade,
    .update-serviceGroup {
        margin-top: 20px;
    }

    .user-profile p {
        margin-bottom: 10px;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 70%;
        margin: 20px auto;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-left: 270px;
        position: relative;
    }

    img {
        border-radius: 8px;
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-bottom: 10px;
        margin-top: 10px;
        position: absolute;
        top: 10px;
        /* Adjusted top value */
        right: 10px;
        /* Added right value */
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    select {
        width: calc(100% - 16px);
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input {
        width: calc(100% - 16px);
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    button {
        background-color: #456ba0;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #314d78;
    }

    .user-profile {
        margin-top: 5px;
        justify-content: space-between;

    }

    .user-profile h2 {
        margin-bottom: 10px;
    }

    .update-grade {
        margin-top: 20px;
    }
    </style>

</head>

<body>
    <div class="header">
        <h1>Edit Employee Grade</h1>
    </div>

    <div>
        <div class="container">
            <div class="user-profile">
                <h2>User Profile</h2>
                <img src="<?php echo $user['user_pic']; ?>" alt="User Picture">
                <p><strong>Name:</strong> <?php echo $user['user_Fname'] . ' ' . $user['user_Lname']; ?></p>
                <p><strong>Email:</strong> <?php echo $user['user_email']; ?></p>
                <p><strong>Position:</strong> <?php echo $user['user_position']; ?></p>
                <p><strong>Grade:</strong> <?php echo $user['user_grade']; ?></p>
                <p><strong>Service Group:</strong> <?php echo $user['user_serviceGroup']; ?></p>

            </div>
            <!-- Form to update user_grade -->
            <div class="update-serviceGroup">
                <h2>Update User Details</h2>
                <form action="" method="post">
                    <label for="new_group">Service Group:</label>
                    <select id="new_group" name="new_group" required>
                        <option value="Managerial/Professional"
                            <?php echo ($user['user_serviceGroup'] == 'Managerial/Professional') ? 'selected' : ''; ?>>
                            Managerial/ Professional
                        </option>
                        <option value="Top Management"
                            <?php echo ($user['user_serviceGroup'] == 'Top Management') ? 'selected' : ''; ?>>
                            Top Management
                        </option>
                        <!-- Add more options as needed -->
                    </select>
                    <label for="new_grade">Grade:</label>
                    <select id="new_grade" name="new_grade" required>
                        <?php
                        $grades = [
                            '41' => '41',
                            '44' => '44',
                            '48' => '48',
                            '52' => '52',
                            '54' => '54',
                            '56' => '56',
                            'Jusa A' => 'Jusa A',
                            'Jusa B' => 'Jusa B',
                            'Jusa C' => 'Jusa C',
                            'Turus I' => 'Turus I',
                            'Turus II' => 'Turus II',
                            'Turus III' => 'Turus III'
                        ];

                        $selectedGrade = $user['user_grade'];

                        foreach ($grades as $key => $value) {
                            $selected = ($key == $selectedGrade) ? 'selected' : '';
                            echo "<option value=\"$key\" $selected>$value</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" name="update_details">Update User</button>
                </form>
            </div>
        </div>


</body>

</html>

<?php
// Close the database connection
$conn->close();
?>