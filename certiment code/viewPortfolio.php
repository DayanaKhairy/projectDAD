<?php
include('config.php');
include('header.php');
//include('sidebar.php');

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['view']) && isset($_POST['selectedPortfolio'])) {
    $selectedPortfolioId = $_POST['selectedPortfolio'];

    // Retrieve the details of the selected portfolio
    $user_email = $_SESSION['user_email'];
    $portfolioQuery = "SELECT * FROM portfolio WHERE portfolio_id = ? AND user_email = ?";
    $stmt = $conn->prepare($portfolioQuery);

    // Bind parameters
    $stmt->bind_param("is", $selectedPortfolioId, $user_email);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $portfolioResult = $stmt->get_result();

    if ($portfolioResult->num_rows > 0) {
        $selectedPortfolio = $portfolioResult->fetch_assoc();
        // Rest of your code...
    } else {
        echo "No portfolio found.";
    }

    // Close the statement
    $stmt->close();
}

        // Display the details in a list form
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Portfolio</title>

</head>

<body>
    <div class="header">
        <h1>View Portfolio</h1>
    </div>

    <ul>
        <li><strong>Portfolio Name:</strong> <?php echo $selectedPortfolio['portfolio_name']; ?></li>
        <li><strong>Portfolio Details:</strong> <?php echo $selectedPortfolio['portfolio_details']; ?></li>
        <li><strong>Year:</strong> <?php echo $selectedPortfolio['year']; ?></li>
        <li><strong>Portfolio Status:</strong> <?php echo $selectedPortfolio['portfolio_status']; ?></li>
    </ul>


</body>

</html>
<?php
   
?>