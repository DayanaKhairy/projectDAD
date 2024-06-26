<?php
include('config.php');
include('sidebar.php');
include('header.php');

//session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Check if a user is logged in
    if (isset($_SESSION['user_email'])) {
        // Use the user information stored in the session
        $user_email = $_SESSION['user_email'];
        $documentName = $_POST['document_name'];
        
        // Get user ID based on the logged-in user's email
        $getUserIDQuery = "SELECT user_email FROM user WHERE user_email = '$user_email'";
        $getUserIDResult = $conn->query($getUserIDQuery);

        if ($getUserIDResult->num_rows > 0) {
            $userData = $getUserIDResult->fetch_assoc();
            $useremail = $userData['user_email'];

            $documentStatus = isset($_POST['document_status']) ? $_POST['document_status'] : 'unhide';

            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            if ($fileError === 0) {
                $fileContent = file_get_contents($fileTmpName);
                $fileContent = mysqli_real_escape_string($conn, $fileContent);

                $documentPath = "uploads/" . $fileName; // You might want to store files in a folder

                // Set the date attribute to the current system date and time
                $date = date('Y-m-d H:i:s');

                $sql = "INSERT INTO documents (user_email, document_name, document_status, date, document_path, document_type) 
                        VALUES ('$useremail', '$documentName', '$documentStatus', '$date', '$documentPath', '$fileType')";

                if ($conn->query($sql) === TRUE) {
                    move_uploaded_file($fileTmpName, $documentPath);
                    echo '<script>
                            if (confirm("File uploaded successfully.")) {
                                window.location.href = "list.php";
                            } else {
                                window.location.reload();
                            }
                          </script>';
                } else {
                    echo '<script>
            if (confirm("Error: ' . $sql . '<br>' . $conn->error . '")) {
                window.location.href = "upload.php";
            } else {
                window.location.reload();
            }
          </script>';
                }
            } else {
                echo '<script>
                            if (confirm("Error Uploading file!")) {
                                window.location.href = "upload.php";
                            } else {
                                window.location.reload();
                            }
                          </script>';
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "User not logged in. Please log in to upload a document.";
    }
}
?>


<?php
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Upload</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    form {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input[type="text"],
    input[type="date"],
    input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="checkbox"] {
        margin-bottom: 16px;
    }

    button {
        background-color: #456ba0;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: #314d78;
    }
    </style>
</head>

<body>
    <div class="header">
        <h1>Upload Document</h1>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="document_name">Document Name:</label>
        <input type="text" name="document_name" required>

        <label for="date">Date:</label>
        <input type="date" name="date" required>

        <label for="file">Choose File:</label>
        <input type="file" name="file" accept=".pdf" required>

        <button type="submit" name="submit">Upload</button>
    </form>
</body>

</html>