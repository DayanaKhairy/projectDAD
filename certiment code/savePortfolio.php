<?php
include('config.php');

// Check if a user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

// Check if the expected keys are set in $_POST
if (!isset($_POST['portfolio_name'], $_POST['portfolio_details'], $_POST['selectedDocuments'])) {
    echo "Error: Missing POST data.";
    exit;
}

// Retrieve portfolio details from POST data
$portfolioName = $_POST['portfolio_name'];
$portfolioDetails = $_POST['portfolio_details'];
$selectedDocuments = json_decode($_POST['selectedDocuments']);

// Get user email from the session
$userEmail = $_SESSION['user_email'];

// Insert portfolio details into the portfolio table
$insertPortfolioQuery = "INSERT INTO portfolio (user_email, portfolio_name, portfolio_details, year, portfolio_status)
                        VALUES ('$userEmail', '$portfolioName', '$portfolioDetails', YEAR(CURDATE()), 'active')";

if ($conn->query($insertPortfolioQuery) === TRUE) {
    // Get the portfolio ID of the inserted record
    $portfolioId = $conn->insert_id;

    // Check if selectedDocuments is an array before using foreach
    if (is_array($selectedDocuments) || is_object($selectedDocuments)) {
        // Insert document associations into the portfolio_documents table
        foreach ($selectedDocuments as $documentId) {
            $insertAssociationQuery = "INSERT INTO portfolio_documents (portfolio_id, document_id)
                                    VALUES ('$portfolioId', '$documentId')";
            $conn->query($insertAssociationQuery);
        }
    } else {
        echo "Error: selectedDocuments is not an array or object.";
    }

    // Clear session variables
    unset($_SESSION['portfolioName']);
    unset($_SESSION['portfolioDetails']);
    unset($_SESSION['selectedDocuments']);

    echo "Portfolio created successfully.";
} else {
    echo "Error creating portfolio: " . $conn->error;
}

$conn->close();
?>