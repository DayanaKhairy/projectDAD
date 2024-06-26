<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Details</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    .popup-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    input {
        width: 100%;
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
    </style>
</head>

<body>
    <div class="popup-container">
        <h2>Portfolio Details</h2>
        <form id="portfolioForm" action="savePortfolio.php" method="post">
            <label for="portfolioName">Portfolio Name:</label>
            <input type="text" id="portfolioName" name="portfolioName" required>

            <label for="portfolioDetails">Portfolio Details:</label>
            <input type="text" id="portfolioDetails" name="portfolioDetails" required>

            <!-- Add a hidden input field for selectedDocuments -->
            <input type="hidden" id="selectedDocuments" name="selectedDocuments">

            <button type="button" onclick="submitPortfolio()">Submit</button>
        </form>
    </div>

    <script>
    function submitPortfolio() {
        // Retrieve values from the form
        var portfolioName = document.getElementById('portfolioName').value;
        var portfolioDetails = document.getElementById('portfolioDetails').value;

        // Get selected documents from sessionStorage
        var selectedDocuments = JSON.parse(sessionStorage.getItem('selectedDocuments'));

        // Perform any additional validation if needed

        // Store values in session storage for later use
        sessionStorage.setItem('portfolioName', portfolioName);
        sessionStorage.setItem('portfolioDetails', portfolioDetails);

        // Set the value of the hidden input field
        document.getElementById('selectedDocuments').value = JSON.stringify(selectedDocuments);

        // Submit the form
        document.getElementById('portfolioForm').submit();
    }
    </script>

</body>

</html>