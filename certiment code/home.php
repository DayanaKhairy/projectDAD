<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    .profile-container p {
        margin-bottom: 10px;
    }

    .wrapper-content>.container {
        margin-right: 20px;
    }

    .name-label .profile-picture {
        display: inline-block;
    }

    .profile-picture {
        text-align: right;
        margin-bottom: 20px;
        margin-right: 20px;
        margin-top: 20px;
        /* Adjust the right margin as needed */
    }

    img {
        margin-top: 30px;
        margin-bottom: 10px;
        width: 150px;
        /* Adjust the width as needed */
        height: 170px;
        /* Adjust the height as needed */
        border-radius: 8px;
        /* Add border-radius for a rounded rectangle effect */
        object-fit: cover;
        border: 2px solid #456ba0;
        position: right;
        /* Add a border if desired */
        float: right;
    }

    .container {
        margin-top: 20px;
        text-align: center;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px 50px;
        margin-left: 5px;
        margin-right: 5px;
        width: 110px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-direction: column;
        margin-bottom: 40px;

    }

    .container i {
        margin-bottom: 10px;
        font-size: 24px;
        height: 50px;
        min-width: 78px;
        margin-top: 5px;
    }

    button {
        background-color: #D1E1E9;
        color: black;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 50%;
        justify-content: center;
    }

    button:hover {
        background-color: #456ba0;
    }

    .label {
        text-align: center;
        text-decoration: solid;
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 15px;
        /* Adjust the margin-top as needed */
    }

    .profile-container {
        margin-top: 30px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px 50px;
        margin-left: 290px;
        width: 70%;
        height: 50%;
        align-items: left;
        cursor: pointer;
        flex-direction: column;
        justify-content: space-between;
    }

    .home-container {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px 50px;
        margin-right: 70%;
        margin-top: 20px;
        width: 70%;
        height: 50%;
        display: flex;
        align-items: left;
        cursor: pointer;
        flex-direction: column;
        justify-content: space-between;

    }

    .wrapper-content {
        display: flex;
        margin-left: 45%;
        margin-top: 20px;
    }

    .wrapper-profile {
        display: row;
        justify-content: space-between;
        align-items: center;
        margin-top: 0px;
        display: inline-block;
    }
    </style>
</head>

<body>
    <?php
    include('config.php');
    include('header.php');
    include ('sidebar.php');
    
    // Assuming you have a session or some way to identify the user, e.g., using $_SESSION['user_id'
    $user_email = $_SESSION['user_email'];
    // Check if the user is logged in
    if (!isset($_SESSION['user_email'])) {
        //Redirect to the login page if not logged in
        header("Location: login.php");
        exit;
    }

    // Continue rendering the content for the logged-in use

    $user_email = isset($_GET['email']) ? $_GET['email'] : '';
    $user_pass = isset($_GET['password']) ? $_GET['password'] : '';
    $user_Fname = isset($_GET['firstName']) ? $_GET['firstName'] : '';
    $user_Lname = isset($_GET['lastName']) ? $_GET['lastName'] : '';
    $user_phoneNo = isset($_GET['phoneNo']) ? $_GET['phoneNo'] : '';
    $user_position = isset($_GET['position']) ? $_GET['position'] : '';
    $user_grade = isset($_GET['grade']) ? $_GET['grade'] : '';
    $user_pic = isset($_GET['profilepic']) ? $_GET['profilepic'] : '';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stmt = $conn->prepare("SELECT user_id, user_email, user_Fname, user_Lname, user_pass, user_pic, user_type, user_phoneNo, user_position, total_Doc, user_grade FROM user WHERE user_email = ?");
    $stmt->bind_param("s", $_SESSION['user_email']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $userData = $result->fetch_assoc();

        if ($userData) {
            // Update user session data
            $_SESSION['user_id'] = $userData['user_id'];
            $_SESSION['user_Fname'] = $userData['user_Fname'];
            $_SESSION['user_Lname'] = $userData['user_Lname'];
            $_SESSION['user_email'] = $userData['user_email'];
            $_SESSION['user_phoneNo'] = $userData['user_phoneNo'];
            $_SESSION['user_position'] = $userData['user_position'];
            $_SESSION['user_grade'] = $userData['user_grade'];
            $_SESSION['total_Doc'] = $userData['total_Doc'];
            $_SESSION['user_pic'] = $userData['user_pic'];
        } else {
            echo "No user data found.";
        }
    } else {
        echo "Query error: " . $conn->error;
    }

    $stmt->close();
}


$conn->close();
?>
    <div class="header">
        <h1>Welcome Back</h1>
    </div>
    <div class="profile-container">
        <div class="name-label">
            <h2><?php echo $_SESSION['user_Fname'] . ' ' . $_SESSION['user_Lname']; ?></h2>
        </div>
        <img src="<?php echo $_SESSION['user_pic']; ?>" alt="Profile Picture">
        <form id="editProfileForm" class="home-container" method="post" onsubmit="return submitForm()"
            enctype="multipart/form-data">

            <p><strong>First Name:</strong>
                <label
                    for="firstName"><?php echo isset($_SESSION['user_Fname']) ? $_SESSION['user_Fname'] :''; ?></label>
            </p>

            <p><strong>Last Name:</strong>
                <label
                    for="LastName"><?php echo isset($_SESSION['user_Lname']) ? $_SESSION['user_Lname'] :''; ?></label>
            </p>

            <p><strong>Email:</strong>
                <label for="email"><?php echo $_SESSION['user_email']; ?></label>
            </p>

            <p><strong>Phone Number:</strong>
                <label
                    for="phoneNumber"><?php echo isset($_SESSION['user_phoneNo']) ? $_SESSION['user_phoneNo'] : ''; ?></label>
            </p>
            <p><strong>Current Position:</strong>
                <label
                    for="position"><?php echo isset($_SESSION['user_position']) ? $_SESSION['user_position'] : ''; ?></label>
            </p>

            <p><strong>Grade:</strong>
                <label for="Grade"><?php echo isset($_SESSION['user_grade']) ? $_SESSION['user_grade'] :''; ?></label>
            </p>

            <div class="button-container">
                <button type="submit">Edit Profile</button>
            </div>

        </form>
    </div>
    <div class="wrapper-content">
        <div id="total-doc" class="container">
            <label>Total Documents</label>
            <i class='bx bx-file'></i>
        </div>
        <div id="portfolio" class="container">
            <label>Portfolio</label>
            <i class='bx bx-book-open'></i>
        </div>
    </div>
    </div>
    <script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            let arrowParent = e.target.parentElement.parentElement;
            console.log(arrowParent);
            arrowParent.classList.toggle("showMenu");
        });
    }

    function showPage(pageId) {
        //  visibility of the container
        var container = document.getElementById(pageId);
        container.style.display = container.style.display === 'none' || container.style.display === '' ? 'block' :
            'none';
    }

    document.getElementById('total-doc').addEventListener('click', function() {
        // Redirect to another page for "Total Documents"
        window.location.href = 'List.php';
    });

    document.getElementById('portfolio').addEventListener('click', function() {
        // Redirect to another page for "Portfolio"
        window.location.href = 'portfolio.php';
    });

    document.getElementById('editProfileForm').addEventListener('submit', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Redirect to the updateProfile.php page
        window.location.href = 'updateProfile.php';
    });


    document.getElementById('profilePicture').addEventListener('change', function(event) {
        // Display the selected file name (optional)
        var fileName = event.target.files[0].name;
        document.querySelector('.container span').innerText = fileName;
    });
    </script>

</body>