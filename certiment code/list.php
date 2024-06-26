<?php
include('config.php');
include('header.php');
include ('sidebar.php');

// Check if a user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

// Fetch user's uploaded documents
$user_email = $_SESSION['user_email'];
$sql = "SELECT * FROM documents WHERE user_email = '$user_email'";
$result = $conn->query($sql);

// Check if any documents found
if ($result->num_rows > 0) {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document List</title>
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

    #compileButton {
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
        <h1>Document List</h1>
    </div>

    <form action="createPortfolio.php" method="post" id="portfolioForm">
        <table>
            <tr>
                <th>Select</th>
                <th>Document Name</th>
                <th>Document Status</th>
                <th>Date Uploaded</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td>
                    <input type="checkbox" name="selectedDocuments[]">
                </td>
                <td><?php echo $row['document_name']; ?></td>
                <td>
                    <button type="button" class="status-toggle"
                        data-document-id="<?php echo $row['document_status']; ?>"
                        data-status="<?php echo $row['document_status']; ?>">
                        <?php echo $row['document_status']; ?>
                    </button>
                </td>
                <td><?php echo $row['date']; ?></td>
            </tr>
            <?php } ?>
        </table>
        <input type="selectedDocuments[]" name="selectedDocuments" id="selectedDocuments" value="">
        <button type="button" id="compileButton" name="compile">Create Portfolio</button>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add click event listener to status buttons
        var statusButtons = document.querySelectorAll('.status-toggle');
        statusButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                toggleStatus(button);
            });
        });

        // Function to toggle document status
        function toggleStatus(button) {
            var documentId = button.getAttribute('data-document-id');
            var currentStatus = button.getAttribute('data-status');
            var newStatus = (currentStatus === 'public') ? 'private' : 'public';

            // Create FormData object and append data
            var formData = new FormData();
            formData.append('document_id', documentId);
            formData.append('new_status', newStatus);

            // Make an AJAX request to update the status in the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'updateDocumentStatus.php', true);
            xhr.setRequestHeader('Content-Type',
                'application/x-www-form-urlencoded'); // Set the correct content type

            // Define the callback function to handle the response
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the button text and attributes based on the response
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        button.textContent = newStatus;
                        button.setAttribute('data-status', newStatus);
                        button.classList.toggle('private', newStatus === 'private');
                    } else {
                        alert('Error updating document status');
                    }
                }
            };

            // Send the request with FormData
            xhr.send(new URLSearchParams(formData)); // Send data as URL-encoded form data
        }

        // Add click event listener to compileButton
        document.getElementById('compileButton').addEventListener('click', function() {
            // Get selected document IDs
            var selectedDocuments = document.querySelectorAll(
                'input[name="selectedDocuments[]"]:checked');

            // Extract IDs and set the hidden input value
            var selectedDocumentIds = Array.from(selectedDocuments).map(function(checkbox) {
                return checkbox.value;
            }).join(',');

            document.getElementById('selectedDocuments').value = selectedDocumentIds;

            // Submit the form
            document.getElementById('portfolioForm').submit();
        });
    });
    </script>
</body>

</html>
<?php
} else {
    echo '<script>
        alert("No documents uploaded.");
        window.location.href ="upload.php"; // Replace with your desired URL
    </script>';
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if documents are selected
    if (isset($_POST['document_id']) && !empty($_POST['document_id'])) {
        // Get selected document IDs
        $selectedDocuments = $_POST['document_id'];

        // Process the selected document IDs (for demonstration, let's print them)
        echo "Selected Document IDs: ";
        foreach ($selectedDocuments as $documentID) {
            echo $documentID . " ";
            // You can perform further operations like adding these IDs to a portfolio in a database
        }
    } else {
        echo "No documents selected.";
    }
}

$conn->close();
?>