<!DOCTYPE html>
<html lang="en">
<?php
$conn = new mysqli('localhost', 'root', '', 'certimentdb');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_Fname = $_POST['user_Fname'];
    $user_Lname = $_POST['user_Lname'];
    $user_email = $_POST['email'];
    $user_pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
   /*$confirm_pass = $_POST['confirm_pass'];*/ // Get the confirmation password
    $user_type = $_POST['userType'];

    // Check if passwords match
    //if ($user_pass !== $confirm_pass) {
        //ie('Error: Passwords do not match');
  //  }

    $stmt = $conn->prepare("INSERT INTO user (user_Fname, user_Lname, user_email, user_pass, user_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_Fname, $user_Lname, $user_email, $user_pass, $user_type);

    if ($stmt->execute()) {
       echo '<script>
                    if (confirm("Registered Successfully!")) {
                        window.location.href = "login.php";
                    } else {
                        window.location.reload();
                    }
                  </script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0">

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
        background: #354B97;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: url(bg.png);
        background-size: cover;
        background-position: center;
    }

    .wrapper .form-box {
        width: 450px;
        height: 450px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        color: #fff;
        border-radius: 10px;
        padding: 30px 40px;
    }

    .wrapper h1 {
        font-size: 36px;
        text-align: center;
    }

    .wrapper .form-input-box {
        width: 100%;
        height: 50px;
        margin: 30px 0;
        position: relative;
        justify-content: space-between;
    }

    .form-input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .form-input-box input::placeholder {
        color: #fff;
    }

    .form-input-box i {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .wrapper .remember-forgot {
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        margin: -15px 0 15px;

    }

    .remember-forgot label input {
        accent-color: #fff;
        margin-right: none;
    }

    .remember-forgot a {
        color: #fff;
        text-decoration: none;
    }

    .remeber-forgot a:hover {
        text-decoration: underline;
    }

    .wrapper .btn {
        width: 100%;
        height: 40px;
        background: #fff;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        cursor: pointer;
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }

    .wrapper .register-link {
        font-size: 14.5px;
        text-align: center;
        margin: 20px 0 15px;
    }

    .register-link p a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link p a:hover {
        text-decoration: underline;
    }

    .wrapper .reg-form-box {
        width: 450px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        color: #fff;
        border-radius: 10px;
        padding: 30px 30px;
    }

    .wrapper .reg-input-box {
        width: 100%;
        height: 50px;
        margin: 30px 0;
        position: relative;
        justify-content: space-between;
    }

    .reg-input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .reg-input-box input::placeholder {
        color: #fff;
    }

    .wrapper .drop-down {
        width: 100%;
        height: 70px;
        margin: 30px 0;
        position: relative;
        justify-content: space-between;
    }

    .drop-down option {
        font-size: 16px;
    }

    .drop-down {
        width: 100%;
        height: 50px;
        margin: 30px 0;
        position: relative;
    }

    .drop-down select {
        width: calc(100% - 10px);
        height: 80%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 10px 30px 10px 20px;
    }

    .drop-down input {
        width: 100%;
        height: 100%;
        position: absolute;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 30px;
    }

    .drop.down input::placeholder {
        color: #fff;
    }

    .drop-down option {
        background-color: transparent;
        color: black;
    }

    .reg-input-box {
        position: relative;
    }

    .reg-input-box input {
        width: calc(100% - 10px);
        /* Adjusted width to accommodate the icon */
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .reg-input-box input::placeholder {
        color: #fff;
    }

    .reg-input-box i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: #fff;
        cursor: pointer;
        margin-right: 30px;
        /* Add margin for space */
    }

    .reg-input-box i:hover {
        color: #ccc;
    }

    .reg-input-box input[type="checkbox"] {
        display: none;
        /* Hide the checkbox */
    }
    </style>
    <title>Register CertiMent</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <form action="register.php" method="post">
            <div class="reg-form-box">
                <h1>Register</h1>
                <div class="reg-input-box">
                    <input type="text" id="FirstName" name="user_Fname" placeholder="First name" required>
                </div>
                <div class="reg-input-box">
                    <input type="text" id="LastName" name="user_Lname" placeholder="Last name" required>
                </div>
                <div class="reg-input-box">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="reg-input-box">
                    <input type="phoneNumber" id="phoneNo" name="phoneNo" placeholder="Phone number" required>
                </div>
                <div class="reg-input-box">
                    <input type="position" id="position" name="position" placeholder="Current Position">
                </div>
                <div class="reg-input-box">
                    <input type="password" id="password" name="password" placeholder="Password" required
                        oninput="validatePassword()">
                    <label>
                        <input type="checkbox" id="showPassword" onclick="togglePassword()">
                        <i class='bx bx-hide'></i><i class='bx bx-show'></i>
                    </label>
                    <div id="passwordError" style="color: red; margin-top: 5px; font-size: 14px;"></div>
                </div>

                <div class="drop-down">
                    <select type="text" id="user_type" name="userType">
                        <option value="employee">Employee</option>
                        <option value="employer">Employer</option>
                    </select>
                </div>
                <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>
<script>
function togglePassword() {
    var passwordInput = document.getElementById("password");
    var passwordVisibilityCheckbox = document.getElementById("showPassword");

    if (passwordVisibilityCheckbox.checked) {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

function validatePassword() {
    var passwordInput = document.getElementById("password");
    var password = passwordInput.value;

    // Define the regular expression for password validation
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/;

    // Check if the password matches the regex
    if (!passwordRegex.test(password)) {
        document.getElementById("passwordError").textContent =
            "Password must be 8 characters long and include at least one uppercase letter and numbers.";
    } else {
        document.getElementById("passwordError").textContent = "";
    }
}
</script>

</html>