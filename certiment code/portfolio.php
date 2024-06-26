<?php
include('config.php');
include('header.php');
include('sidebar.php');

// Check if a user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

// Fetch user's portfolios
$user_email = $_SESSION['user_email'];
$portfolioQuery = "SELECT * FROM portfolio WHERE user_email = '$user_email'";
$portfolioResult = $conn->query($portfolioQuery);

// Check if any portfolios found
if ($portfolioResult->num_rows > 0) {
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio List</title>
    <style>
    .header {
        display: block !important;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    table {
        width: 80%;
        border-collapse: collapse;
        margin-top: 20px;
        margin-left: 270px;
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

    button {
        background-color: #456ba0;
        color: #fff;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 5px;
        margin: 0 auto;
    }

    #viewButton {
        position: fixed;
        bottom: 50px;
        right: 50px;
        padding: 10px;
        background-color: #456ba0;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 15px;
    }

    button.hide {
        background-color: #e74c3c;
    }

    button:hover {
        background-color: #314d78;
    }
    </style>
</head>

<body>
    <div class="header">
        <h1>Portfolio List</h1>
    </div>

    <form action="viewPortfolio.php" method="post">
        <table>
            <tr>
                <th>Select</th>
                <th>Portfolio Name</th>
                <th>Portfolio Details</th>
                <th>Year</th>
                <th>Portfolio Status</th>
            </tr>
            <?php while ($row = $portfolioResult->fetch_assoc()) { ?>
            <tr>
                <td>
                    <input type="radio" name="selectedPortfolio" required>
                </td>
                <td><?php echo $row['portfolio_name']; ?></td>
                <td><?php echo $row['portfolio_details']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td><?php echo $row['portfolio_status']; ?></td>
            </tr>
            <?php } ?>
        </table>
        <button id="viewButton" name="view">View Portfolio</button>
    </form>
</body>

</html>

<?php
} else {
    echo '<script> alert("No portfolios created.") 
    window.location.href ="upload.php";</script>';
}

$conn->close();
?>