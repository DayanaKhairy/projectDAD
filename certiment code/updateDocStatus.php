<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the document_id and new_status from the AJAX request
    $documentId = $_POST['document_id'];
    $newStatus = $_POST['new_status'];

    // Update the document_status in the documents table
    $updateSql = "UPDATE documents SET document_status = '$newStatus' WHERE document_id = '$documentId'";
    if ($conn->query($updateSql) === TRUE) {
        // If the status is set to private, insert the document into the archive table
        if ($newStatus === 'private') {
            $archiveSql = "INSERT INTO archive_documents SELECT * FROM documents WHERE document_id = '$documentId'";
            if ($conn->query($archiveSql) === TRUE) {
                // Return a JSON response indicating success
                echo json_encode(array('success' => true));
            } else {
                // Return a JSON response indicating failure
                echo json_encode(array('success' => false, 'message' => 'Error archiving document'));
            }
        } else {
            // Return a JSON response indicating success
            echo json_encode(array('success' => true));
        }
    } else {
        // Return a JSON response indicating failure
        echo json_encode(array('success' => false, 'message' => 'Error updating status'));
    }
}

$conn->close();
?>