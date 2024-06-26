<?php
// Include necessary files (config.php, header.php, etc.)
include('config.php');
include('header.php');
include('sidebarEmp.php');

// Retrieve documents from the database
$documentQuery = "SELECT * FROM searched_documents";
$documentResult = $conn->query($documentQuery);

if ($documentResult === false) {
    echo "Error in fetching data: " . $conn->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document List</title>
    <style>
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
        <h1>Document List</h1>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Document Name</th>
                    <th>Document Status</th>
                    <th>User Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($document = $documentResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $document['document_name'] . '</td>';
                    echo '<td>' . $document['document_status'] . '</td>';
                    echo '<td>' . $document['user_email'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>