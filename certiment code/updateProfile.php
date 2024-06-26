<?php
include('config.php');
include('header.php');
include('sidebar.php');

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'profilePicture' key exists in $_FILES
    if (isset($_FILES['profilePicture'])) {
        // Handle file upload
         $uploadDir = 'profile/'; // specify your upload directory
        $uploadFile = $uploadDir . basename($_FILES['profilePicture']['name']);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadFile)) {
            // File upload success, update user profile in the database
            $user_email = $_SESSION['user_email'];
            $user_pic = $uploadFile;

        // Update user profile in the database
       $stmt = $conn->prepare("UPDATE user SET user_pic = ?, user_Fname = ?, user_Lname = ?, user_phoneNo = ?, user_position = ? WHERE user_email = ?");
$stmt->bind_param("ssssss", $user_pic, $_POST['firstName'], $_POST['lastName'], $_POST['phoneNo'], $_POST['position'], $user_email);

        if ($stmt->execute()) {
            $_SESSION['user_Fname'] = $_POST['firstName'];
            $_SESSION['user_Lname'] = $_POST['lastName'];
            $_SESSION['user_phoneNo'] = $_POST['phoneNo'];
            $_SESSION['user_position'] = $_POST['position'];
            $_SESSION['user_pic'] = $user_pic; // Update with the correct session variable

            echo '<script>
                    if (confirm("File uploaded successfully.")) {
                        window.location.href = "home.php";
                    } else {
                        window.location.reload();
                    }
                  </script>';
        } else {
            echo '<script>
                    if (confirm("Error updating profile: ' . $stmt->error . '")) {
                        window.location.href = "updateProfile.php";
                    } else {
                        window.location.reload();
                    }
                  </script>';
        }

        $stmt->close();
    } else {
        echo '<script> alert("Error uploading file. No file selected.") </script>';
    }
}
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    .profile-picture img {
        width: 150px;
        /* Adjust the width as needed */
        height: 170px;
        /* Adjust the height as needed */
        border-radius: 8px;
        /* Add border-radius for a rounded rectangle effect */
        object-fit: cover;
        border: 2px solid #456ba0;
        margin-bottom: 10px;
    }


    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }


    .form-container {
        max-width: 900px;
        margin: 10px auto;
        margin-left: 270px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        background-color: #D1E1E9;
        color: black;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 50%;
        margin-top: 15px;
    }

    button:hover {
        background-color: #456ba0;
    }
    </style>
</head>

<body>
    <div class="header">
        <h1>Update Profile</h1>
    </div>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="profilePicture" class="container">Profile Picture:</label>
            <input type="file" id="profilePicture" name="profilePicture" accept=".jpeg, .png, .jpg"
                style="display: none;">
            <label for="profilePicture" class="container" style="cursor: pointer;">
                <i class='bx bx-camera'></i>
                <span>Change Profile Picture</span>
            </label>
            <div class="profile-picture">
                <img id="currentProfilePicture" src="profile/<?php echo $_SESSION['user_pic']; ?>"
                    alt="Profile Picture">
            </div>
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" value="<?php echo $_SESSION['user_Fname']; ?>" required>

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" value="<?php echo $_SESSION['user_Lname']; ?>" required>

            <label for="phoneNo">Phone Number:</label>
            <input type="text" name="phoneNo" value="<?php echo $_SESSION['user_phoneNo']; ?>">

            <label for="position">Current Position:</label>
            <input type="text" name="position" value="<?php echo $_SESSION['user_position']; ?>">

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
<script>
// JavaScript to handle the file input change event
document.getElementById('profilePicture').addEventListener('change', function(event) {
    // Display the selected file name (optional)
    var fileName = event.target.files[0].name;
    document.querySelector('.container span').innerText = fileName;

    // Display the selected image
    var imgPreview = document.querySelector('.profile-picture img');
    var reader = new FileReader();

    reader.onload = function(e) {
        imgPreview.src = e.target.result;
    };

    reader.readAsDataURL(event.target.files[0]);
});
</script>

</html>